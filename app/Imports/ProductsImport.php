<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {   
        foreach ($rows as $row) {
            $category_arr = explode(',',$row['category']);
            foreach($category_arr as $key => $category){
                $ct_obj = Category::updateOrCreate([
                    'ct_title' => $category
                ],[
                    'ct_title' => $category
                ]);

                Product::updateOrCreate([
                    'code' => $row['code'],
                    'category_id' => $ct_obj->id
                ],[
                    'title' => $row['title'],
                    'code' => $row['code'],
                    'description' => $row['description'],
                    'price' => $row['price'],
                    'quantity' => $row['quantity'],
                    'category_id' => $ct_obj->id
                ]);
            }
        }
    }
}
