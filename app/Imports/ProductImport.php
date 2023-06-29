<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name' => $row[0],
            'category_id' => $row[1],
            'supplier_id' => $row[2],
            'code' => $row[3],
            'garage' => $row[4],
            'image' => $row[5],
            'image_url' => $row[6],
            'store' => $row[7],
            'buying_date' => $row[8],
            'expire_date' => $row[9],
            'buying_price' => $row[10],
            'selling_price' => $row[11]
        ]);
    }
}
