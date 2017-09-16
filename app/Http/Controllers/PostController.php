<?php

namespace App\Http\Controllers;

use Request as Req;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Post;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }
    public function index()
    {
      //  $category_post = $this->post->where('category_title',)->get();
       // return view('category', ['category_post'=>$category_post]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCategories=$this->category->where('user_id',Auth::id())->get();
        $categories = $this->category->get();
        $category_post = $this->post->where('user_id',Auth::id())->get();
        return view('category', ['category_post'=>$category_post , 'categories'=>$categories, 'allCategories'=>$allCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        $photo =Req::file('photo')->getClientOriginalName();
        if($this->post->create(['title'=>$request->input('title'), 'text'=>$request->input('text'), 'image'=>$photo,'category_title'=>$request->input('select'), 'user_id'=>Auth::id()]))
        {
            return redirect()->back()->with('status','Post Created');
        }
        else
        {
            return redirect()->back()->with('status','Something went wrong!!!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $categories = $this->category->get();
        $allCategories=$this->category->where('user_id',Auth::id())->get();
        return view('category',['categories'=>$categories, 'allCategories'=>$allCategories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
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
      	// 
     }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
       //
    }


}
