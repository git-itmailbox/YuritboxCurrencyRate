<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $currencies = \App\Models\Currency::all();
        $dateFrom = Carbon::today()->subYear();
        $now = Carbon::today()->subMonth();

        while (!$now->equalTo($dateFrom)){
            foreach ($currencies as $currency) {
                factory(\App\Models\History::class)->create([
                    \App\Models\History::FIELD_CURRENCY_ID => $currency->id,
                    \App\Models\History::FIELD_DATE=> $dateFrom->toDateString(),

                ]);
            }
            $dateFrom->addDay();
        }
    }
}
