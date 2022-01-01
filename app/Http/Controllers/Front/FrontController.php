<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with([
            'categories', 'photos', 
            'prices' => function($q) {
                $q->where('start_date', '<=', now())
                  ->where('end_date', '>=', now())
                  ->first();
        }])->paginate(10);
        // dd($products);
        return view('front.index', compact('products'));
    }
}
