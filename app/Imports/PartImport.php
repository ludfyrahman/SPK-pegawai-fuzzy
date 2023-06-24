<?php

namespace App\Imports;

use App\Models\Part;
use Maatwebsite\Excel\Concerns\WithStartRow;

use Maatwebsite\Excel\Concerns\ToModel;

class PartImport implements ToModel,WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Part([
            //
            'gudang_id'     => $row[0],
            'no_part'       => $row[1],
            'sap'           => $row[2],
            'cat'           => $row[3],
            'deskripsi'     => $row[4],
            'satuan'        => $row[5],
            'lokasi'        => $row[6],
            'keterangan'    => $row[7],
            'stok'          => $row[8],
            'barcode'       => $row[9],
        ]);
    }
}
