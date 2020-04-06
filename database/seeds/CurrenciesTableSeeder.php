<?php

use Illuminate\Database\Seeder;
use App\Currency;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->delete();
        $json = File::get("database/data/currencies.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
          Currency::create(array(
            'symbol' => $obj->symbol,
            'name' => $obj->name,
            'code' => $obj->code,
          ));
        }
    }
}
