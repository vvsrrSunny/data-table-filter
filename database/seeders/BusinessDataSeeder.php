<?php

namespace Database\Seeders;

use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = Reader::createFromPath(database_path('seeds\csvs\business-data.csv'), 'r');
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords(); //returns all the CSV records as an Iterator object

        foreach ($records as $record) {
            $name = $priceVal = $officesVal = $tablesVal = $sqmVal = null;

            foreach ($record as $x => $x_value) {
                $x = trim($x);

                switch ($x) {
                    case (strcasecmp('Name', $x) == 0):
                        $name = $x_value;
                        break;

                    case (strcasecmp('Price', $x) == 0):
                        $priceVal = $x_value;
                        break;

                    case (strcasecmp('Offices', $x) == 0):
                        $officesVal = $x_value;
                        break;

                    case (strcasecmp('Tables', $x) == 0):
                        $tablesVal = $x_value;
                        break;

                    case (strcasecmp('Sqm', $x) == 0):
                        $sqmVal = $x_value;
                        break;
                }
            }

            DB::table('business_data')->insert([
                'name' => $name,
                'price' => $priceVal,
                'offices' => $officesVal,
                'tables' => $tablesVal,
                'Square_meters' => $sqmVal,
            ]);
        }
    }
}
