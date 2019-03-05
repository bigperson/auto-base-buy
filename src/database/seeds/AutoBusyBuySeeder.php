<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AutoBusyBuySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables = [
            'car_type',
            'car_mark',
            'car_model',
            'car_generation',
            'car_serie',
            'car_modification',
        ];

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
     * Collect data from a given CSV file and return as array.
     *
     * @param $filename
     * @param string $delimitor
     * @param string $enclosure
     *
     * @return array|bool
     *
     * @internal param string $deliminator
     */
    private function seedFromCSV($filename, $delimitor = ',', $enclosure = "'")
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = [];

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimitor, $enclosure)) !== false) {
                if (!$header) {
                    $header = $this->replaceArrayValues($row, [
                        'date_create' => 'created_at',
                        'date_update' => 'updated_at',
                    ]);
                } else {
                    $row = array_combine($header, $row);

                    $row = $this->replaceNullString($row);
                    $row = $this->timestampsToDatetime($row, ['created_at', 'updated_at']);

                    $data[] = $row;
                }
            }
            fclose($handle);
        }

        return $data;
    }

    /**
     * Replace array values.
     *
     * @param array $array
     * @param array $replacement
     *
     * @return array
     */
    private function replaceArrayValues($array, $replacement)
    {
        $result = [];

        foreach ($array as $key => $value) {
            if (isset($replacement[$value])) {
                $result[$key] = $replacement[$value];
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Replace timestamp fields in array to datetime.
     *
     * @param array $array
     * @param array $timestampFields
     *
     * @return array
     */
    private function timestampsToDatetime($array, $timestampFields)
    {
        $result = [];

        foreach ($array as $key => $value) {
            if ((!empty($value)) && in_array($key, $timestampFields)) {
                $result[$key] = date('Y-m-d H:i:s', $value);
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Replace NULL sting value with type null.
     *
     * @param array $array
     * @param array $timestampFields
     *
     * @return array
     */
    private function replaceNullString($array)
    {
        $result = [];

        foreach ($array as $key => $value) {
            if ($value == 'NULL') {
                $result[$key] = null;
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
