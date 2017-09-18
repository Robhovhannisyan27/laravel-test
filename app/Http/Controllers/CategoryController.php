<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function index()
    {
         $categories = $this->category->get();
         return view('home', ['categories' => $categories]);

    }

    public function allCategories()
    {
        $allCategories=$this->category->where('user_id',Auth::id())->get();
        $categories = $this->category->get();
        return view('myCategory', ['allCategories' => $allCategories, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->get();
        return view('category', ['categories' => $categories]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->category->create(['category_title'=>$request->input('category_title'),'user_id'=>Auth::id()])){
            return redirect()->back()->with('success', 'Category created!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->category->find($id);
        $categories = $this->category->get();
        return view('category', ['category' => $category, 'categories' => $categories]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        // dd($id, $request->all());
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        unset($inputs['_method']);
        if($inputs['category_title']=='')
        {
            return redirect()->back()->with('error', 'Error');
        }
        if($this->category->where('id', $id)->update($inputs)){
             return redirect()->back()->with('success', 'Category name changed');
        }
        else{
             return redirect()->back()->with('error', 'Error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
       //dd($request->all());
        $this->category->where('id',$id)->delete();
        return redirect('/categories');
    }


}
