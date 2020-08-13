<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\History;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mockery\Exception;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ImportDailyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rates:import {--from-date=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing daily rates from "cbr.ru".  You can use --from-date=Y/m/d to parse period from date till now';
    /**
     * @var string
     */
    private $baseBankUrl;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->baseBankUrl = 'http://www.cbr.ru/scripts/XML_daily.asp';
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $fromDate = $this->option('from-date');
        $date = Carbon::tomorrow();

        if($fromDate) {
            try {
                $date = Carbon::create($fromDate);
            } catch (\Exception $exception) {
                echo 'Wrong date format. ' . $exception->getMessage() . PHP_EOL;
                return 0;
            }
        }
        //cbr gives date +1 working day
        $now = Carbon::tomorrow();

        $bar = $this->output->createProgressBar( $date->diffInDays($now)+1);

        $bar->start();

        while (!$now->equalTo($date)){
            $bar->advance();
            $this->importHandle($date);
            $date->addDay();
        }
        return 0;
    }

    private function formatValue($value)
    {
        $value = str_replace(',', '.', $value);

        return $value * History::FACTOR;
    }

    private function importHandle(Carbon $date)
    {
        $xml = XmlParser::load($this->baseBankUrl . '?date_req=' . $date->format('d/m/Y'));
        $data = $xml->parse([
            'ValCursDate' => ['uses' => '::Date'],
            'Currencies' => ['uses' => 'Valute[NumCode,CharCode,Name,Nominal,Value,::ID>curr_id]'],
        ]);

        $date =  Carbon::create($data['ValCursDate']);
        $count = History::where(History::FIELD_DATE, $date->toDateString())->count();
        if ($count > 0){
            echo 'Db has already data rates by date: ' . $data['ValCursDate'] . '. Skipping...' . PHP_EOL;
            return 0;
        }

        foreach ($data['Currencies'] as $currency) {
            //find current currency in db
            try {
                $currencyModel = Currency::query()->where(Currency::FIELD_NUMCODE, $currency['NumCode'])->firstOrFail();

            } catch (\Exception $exception) {
                $currencyModel = Currency::create([
                    Currency::FIELD_NUMCODE => $currency['NumCode'],
                    Currency::FIELD_CHARCODE => $currency['CharCode'],
                    Currency::FIELD_NAME => $currency['Name'],
                ]);
            }

            History::create([
                History::FIELD_CURRENCY_ID => $currencyModel->id,
                History::FIELD_VALUE => $this->formatValue($currency['Value']),
                History::FIELD_DATE => $date->toDateString(),
                History::FIELD_NOMINAL => $currency['Nominal'],
            ]);
        }
    }
}
