<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $myCategories=$this->category->where('user_id',Auth::id())->get();
        $categories = $this->category->get();
        return view('myCategory', ['myCategories' => $myCategories, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($id, Post $post)
    {
        $category = $this->category->find($id);
        $category_posts=$post->where('category_id',$id)->Paginate('9');
        $categories = $this->category->get();
        return view('category', ['category_posts'=>$category_posts, 
                                 'category' => $category,
                                 'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        $this->category->where('id',$id)->delete();
        return redirect('/categories');
    }
}
