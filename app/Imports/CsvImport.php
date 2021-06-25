<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Contacts;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CsvImport implements ToModel, WithStartRow
{
    /**
    * @param Collection $collection
    */
//    public function collection(Collection $collection)
//    {
//        return $collection; //add this line
//    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Contacts([
            //
            'first_name'     => @$row[0],
            'last_name'    => @$row[1],
            'company_name'    => @$row[2],
            'home_phone'    => @'+1'.(int)str_replace("-", "", $row[3]),
            'work_phone'    => @'+1'.(int)str_replace("-", "", $row[4]),
            'mobile_phone'    => @'+1'.(int)str_replace("-", "", $row[5]),
            'email'    => @$row[6],
            'compaign_id'    => 1,
            'created_by_id'    => 1,
            'list_id'    => 1
        ]);
    }





    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    public function columnFormats(): array
    {
        return [
            'A' => Te::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_NUMBER,
            'E' => NumberFormat::FORMAT_NUMBER,
            'F' => NumberFormat::FORMAT_NUMBER,
        ];
    }













}
