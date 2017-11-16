<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    
    public function __construct(Category $category)
    {
        $this->category = $category;
    }


    public function index()
    {
        $my_categories = $this->category->where('user_id',Auth::id())->get();
        $categories = $this->category->get();
        return view('my_category', ['my_categories' => $my_categories, 'categories' => $categories]);
    }

    
    
    public function store(Request $request)
    {
        if($this->category->create(['category_title'=>$request->input('category_title'), 'user_id'=>Auth::id()])) {
            return redirect()->back()->with('success', 'Category created!');
        } 
        return redirect()->back()->with('error', 'Something went wrong!!!');
    }

    
    public function show($id, Post $post)
    {
        $my_categories = $this->category->where('user_id',Auth::id())->get();
        $category = $this->category->find($id);
        $category_posts = $post->where('category_id',$id)->orderby('id','desc')->Paginate('9');
        $categories = $this->category->get();
        return view('category', [
            'category_posts' => $category_posts, 
            'category' => $category,
            'categories' => $categories,
            'my_categories' => $my_categories
            ]);
    }

    
    
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        unset($inputs['_method']);
        if($inputs['category_title']=='') {
            return redirect()->back()->with('error', 'Error');
        }
        if($this->category->where('id', $id)->update($inputs)) {
             return redirect()->back()->with('success', 'Category name changed');
        } 
        return redirect()->back()->with('error', 'Error');
    }

    
    public function destroy($id)
    {
        $this->category->where('id',$id)->delete();
        return redirect('/categories');
    }
}
