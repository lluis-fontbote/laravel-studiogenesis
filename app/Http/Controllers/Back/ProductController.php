<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('back.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('back.product.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        
        $product->categories()->attach($request->categories);

        $product->prices()->delete();
        if (isset($request->amount)) {
            for ($i = 0;  $i < count($request->amount);  $i++) {
                $price = Price::create([
                    'amount' => $request->amount[$i],
                    'start_date' => $request->startDate[$i],
                    'end_date' => $request->endDate[$i],
                    'product_id' => $product->id
                ]);
            }
        }

        if (isset($request->delete_product_photo)) {
            Photo::destroy(array_keys($request->delete_product_photo));
        }
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                Storage::putFileAs('public/productPhotos', $photo, $photo->getClientOriginalName());
                Photo::create([
                    'filename' => basename($photo->getClientOriginalName()),
                    'product_id' => $product->id
                ]);
            }
        }

        return view('back.product.form', compact('product'))->with('actionOnProduct', 'Producto creado correctamente');
    }

    // public function show(Request $request) 
    // {
    //     dd($request);
    //     return 'adeu';
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)
                          ->with('categories')
                          ->withCount('categories')->first();
        return view('back.product.form', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        $product->categories()->sync($request->categories);

        $product->prices()->delete();
        if (isset($request->amount)) {
            for ($i = 0;  $i < count($request->amount);  $i++) {
                $price = Price::create([
                    'amount' => $request->amount[$i],
                    'start_date' => $request->startDate[$i],
                    'end_date' => $request->endDate[$i],
                    'product_id' => $product->id
                ]);
            }
        }

        if (isset($request->delete_product_photo)) {
            Photo::destroy(array_keys($request->delete_product_photo));
        }
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                Storage::putFileAs('public/productPhotos', $photo, $photo->getClientOriginalName());
                Photo::create([
                    'filename' => basename($photo->getClientOriginalName()),
                    'product_id' => $product->id
                ]);
            }
        }


        return view('back.product.form', compact('product'))->with('actionOnProduct', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('back.product.index')->with('actionOnProduct', 'Producto eliminado correctamente');
    }
}
