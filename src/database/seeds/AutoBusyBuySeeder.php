<?php

use Illuminate\Database\Seeder;

class AutoBusyBuySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tables = array(
            'car_type',
            'car_mark',
            'car_model',
            'car_generation',
            'car_serie',
            'car_modification'
        );

        foreach ($tables as $table) {
            DB::table($table)->delete();
            $seedData = $this->seedFromCSV(database_path('csv/'.$table.'.csv'), ',');

            $seedData = array_chunk($seedData, 20);

            foreach ($seedData as $data) {
                DB::table($table)->insert($data);
            }
        }

    }

    /**
     * Collect data from a given CSV file and return as array
     *
     * @param $filename
     * @param string $delimitor
     * @param string $enclosure
     * @return array|bool
     * @internal param string $deliminator
     */
    private function seedFromCSV($filename, $delimitor = ",", $enclosure = "'")
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = array();

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimitor, $enclosure)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        return $data;
    }
}
