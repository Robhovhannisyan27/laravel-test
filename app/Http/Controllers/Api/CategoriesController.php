<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Post;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $categories = Category::get();
        return response()->json(['categories' => $categories], 200);
    }

    public function myCategories()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return response()->json(['MyCategories' => $categories], 200);
    }
    
    
    public function store(Request $request)
    {
    	$category = Category::create(['category_title'=>$request->get('category_title'), 'user_id'=>Auth::id()]);
        if($category) {
            return response()->json(['category' => $category], 200);
        }
        	return response()->json(['message'=> 'error'], 400);
        
    }

    
    public function show($id, Post $post)
    {
        $category_posts = $post->where('category_id',$id)->orderby('id','desc')->Paginate('9');
        if($category_posts){
        	return response()->json([$category_posts],200);
        }
        return response()->json(['error'], 400);
    }

    
    
    public function update(Request $request, $id)
    {
        $category_title = $request->input('category_title');
       	$result = Category::where('id', $id)->where('user_id', Auth::id())->update(['category_title' => $category_title]);
       	$category = Category::where('id', $id)->get();
        if($result) {
            return response()->json([$category], 201);
        }
            return response()->json(['error'=>'Error'], 400);
        
    }

    
    public function destroy($id)
    {
        Category::where('id',$id)->where('user_id', Auth::id())->delete();
        return response()->json(['success'], 200);
    }
}
