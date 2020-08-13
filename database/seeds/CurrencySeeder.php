<?php

use Illuminate\Database\Seeder;
use Orchestra\Parser\Xml\Facade as XmlParser;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $request_url = 'http://www.cbr.ru/scripts/XML_daily.asp';
        $xml = XmlParser::load($request_url);
        $data = $xml->parse([
            'Currencies' => ['uses' => 'Valute[NumCode,CharCode,Name]'],
        ]);
        if ($data['Currencies']){
            foreach ($data['Currencies'] as $currency) {
                \App\Models\Currency::create([
                    \App\Models\Currency::FIELD_NUMCODE => $currency['NumCode'],
                    \App\Models\Currency::FIELD_CHARCODE => $currency['CharCode'],
                    \App\Models\Currency::FIELD_NAME => $currency['Name'],
                ]);
            }
        }
    }
}
