<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(){
        $collect = Product::with('category')->get()->toArray();
        // dd($collect);
        // $data['title'] = $collect->pluck('title');
        $field['title'] = array_unique(array_column($collect,'title'));
        $field['code'] = array_unique(array_column($collect,'code'));
        $field['description'] = array_unique(array_column($collect,'description'));
        $field['price'] = array_unique(array_column($collect,'price'));
        $field['quantity'] = array_unique(array_column($collect,'quantity'));
        $data['details'] = $collect;
        $data['fields'] = $field;
        return view('index',$data);
    }

    public function importData() 
    {
        Excel::import(new ProductsImport,request()->file('file'));
        return redirect(route('index'));
    }
}
