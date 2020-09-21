<?php

namespace App\Http\Controllers\Category;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::simplePaginate(1);
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'category' => "required|max:15|unique:categories",
            "description" => "required|string",
            "image" => "required|mimes:png,jpg,jpeg|max:10240"
        ]);

        $file = $request->file('image');
        $image = $file->store('category/image');

        $validasi['category'] = ucwords($validasi["category"]);

        Category::create([
            'category' => $validasi['category'],
            'image' => $image,
            'description' => $validasi['description']
        ]);

        return back()->with('success',"Category has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $categories = Category::with('posts')->where('id',$category->id)->first();
        return view("category.show",compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        $result=Category::find($category);
        return view('category.edit', ['category'=>$result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        $validasi = $request->validate([
            'category' => "required|max:15|unique:categories",
            "description" => "required|string",
            "image" => "required|mimes:png,jpg,jpeg|max:10240"
        ]);
        
        Category::where('id', $category->id)->update($validasi);
        $request->session()->flash('pesan',"Data berhasil diperbaharui");
        return redirect()->route("category.show",compact('categories'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')
        ->with('pesan',"Data berhasil dihapus");
    }
}
