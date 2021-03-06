<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $parentCategories = Category::where('is_parent', true)
                                    ->with('children')->get();

        $products = Product::with([
            'categories', 'photos', 
            'prices' => function($q) {
                $q->where('start_date', '<=', now())
                  ->where('end_date', '>=', now());
        }])->paginate(9);

        return view('front.index', compact('products', 'parentCategories'));
    }

    public function filter(Request $request)
    {
        if ($request->categories_id == null) {
            return redirect()->route('index');
        }

        $parentCategories = Category::where('is_parent', true)
                                    ->with('children')->get();

        $products = Product::with([
            'categories', 'photos', 
            'prices' => function($q) {
                $q->where('start_date', '<=', now())
                  ->where('end_date', '>=', now());
        }])->whereHas('categories', function($q) use ($request) {
            $q->whereIn('categories.id', $request->categories_id);
        })->paginate(9)->withQueryString();

        return view('front.index', compact('products', 'parentCategories'));
    }
}
