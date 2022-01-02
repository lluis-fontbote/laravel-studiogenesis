<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ApiController extends Controller
{
    public function getCategories()
    {
        $categories = Category::all()->toJson();
        return $categories;
    }

    public function getProducts()
    {
        $products = Product::with([
            'categories', 'photos', 
            'prices' => function($q) {
                $q->where('start_date', '<=', now())
                  ->where('end_date', '>=', now())
                  ->first();
        }])->get()->toJson();
        
        return $products;
    }
}
