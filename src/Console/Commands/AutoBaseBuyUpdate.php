<?php

namespace Bigperson\AutoBaseBuy\Console\Commands;

use basebuy\basebuyAutoApi\BasebuyAutoApi;
use Bigperson\AutoBaseBuy\Models\CarMark;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AutoBaseBuyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto-base-buy:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update auto-base-buy cars';
    /**
     * @var BasebuyAutoApi
     */
    private $api;

    /**
     * Create a new command instance.
     *
     * @param BasebuyAutoApi $api
     */
    public function __construct(BasebuyAutoApi $api)
    {
        parent::__construct();

        $this->api = $api;
    }

    /**
     * Execute the console command.
     * @return void
     */
    public function handle()
    {
        $this->api->typeGetDateUpdate();

        // get database file
        $idType = 1; // Легковые автомобили (полный список можно получить через $basebuyAutoApi->typeGetAll())

//        $downloadedFilePath = $this->api->typeGetAll(BasebuyAutoApi::FORMAT_CSV, false);

        $marksCSV = $this->api->markGetAll($idType, BasebuyAutoApi::FORMAT_CSV, false);
        $this->updateMarks($marksCSV);

//        dd($downloadedFilePath);
    }

    private function updateMarks(string $marksCSV)
    {
        $data = $this->dataFromCsv($marksCSV, ',');

//        CarMark::updateOrCreate([''], )

    }

    /**
     * Collect data from a given CSV string and return as array.
     *
     * @param string $csv
     * @param string $delimitor
     * @param string $enclosure
     *
     * @return array|bool
     *
     * @internal param string $deliminator
     */
    private function dataFromCsv(string $csv, $delimitor = ',', $enclosure = "'")
    {
        $header = null;
        $csvData = str_getcsv($csv, $delimitor, $enclosure);
        dd($csvData);
        $data = [];
//
//        foreach ($csvData as $row) {
//            if (!$header) {
//                $header = $this->replaceArrayValues($row, [
//                    'date_create' => 'created_at',
//                    'date_update' => 'updated_at',
//                ]);
//            } else {
//                $row = array_combine($header, $row);
//
//                $row = $this->replaceNullString($row);
//                $row = $this->timestampsToDatetime($row, ['created_at', 'updated_at']);
//
//                $data[] = $row;
//            }
//        }

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
