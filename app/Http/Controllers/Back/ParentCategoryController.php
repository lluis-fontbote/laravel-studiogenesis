<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ParentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('is_parent', true)->paginate(10);
        return view('back.parentCategory.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.parentCategory.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_parent' => true
        ]);

        $category->children()->attach($request->parents);

        return view('back.parentCategory.form', compact('category'))->with('actionOnCategory', 'Categoría creada correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('back.parentCategory.form', compact('category'));
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
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->is_parent = true;
        $category->save();

        $category->children()->sync($request->children);

        return view('back.parentCategory.form', compact('category'))->with('actionOnCategory', 'Categoría actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('back.parentCategory.index')->with('actionOnCategory', 'Categoría eliminada correctamente');
    }
    
    public function confirmDestruction($id)
    {
        $category = Category::where('id', $id)->with('children')->get();
        if ($category->children->total() > 0) {
            foreach ($category->children as $child) {
                $child->parents()->detach($id);
            }
        }
        Category::destroy($id);

        return redirect()->route('back.parentCategory.index')->with('actionOnCategory', 'Categoría eliminada correctamente');
    }

    public function filter(Request $request)
    {
        $name = '%'.$request->term.'%';
        $categories = Category::where('is_parent', true)->select('id', 'name as text')
                    ->where('name', 'LIKE', $name)->limit(10)->get();
        return ["results" => $categories];
    }
}
