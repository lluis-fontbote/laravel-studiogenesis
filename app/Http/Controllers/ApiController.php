<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class ApiController extends Controller
{
    public function getCategories(Request $request)
    {
        if ($request->token == JWTAuth::attempt([
            'email' => $request->email, 
            'password' => $request->password
        ])) {
            $categories = Category::all()->toJson();
            return $categories;
        } else {
            return 'Credencials incorrectes';
        }
    }

    public function getProducts(Request $request)
    {
        if ($request->token == JWTAuth::attempt([
            'email' => $request->email, 
            'password' => $request->password
        ])) {
            $products = Product::with([
                'categories', 'photos', 
                'prices' => function($q) {
                    $q->where('start_date', '<=', now())
                      ->where('end_date', '>=', now())
                      ->first();
            }])->get()->toJson();
            
            return $products;
        } else {
            return 'Credencials incorrectes';
        }
    }
}
