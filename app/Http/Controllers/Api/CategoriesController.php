<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Post;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::get();
        return response()->json(['categories' => $categories], 200);
    }

    public function myCategories($id)
    {
        $my_categories=Category::where('user_id',$id)->get();
        return response()->json(['MyCategories' => $my_categories], 200);
    }
    
    
    public function store(Request $request, $id)
    {
    	$create_category = Category::create(['category_title'=>$request->get('category_title'), 'user_id'=>$id]);
        if($create_category) {
            return response()->json(['category' => $create_category], 200);
        }
        	return response()->json(['message'=> 'error'], 400);
        
    }

    
    public function show($id, Post $post)
    {
        $category_posts=$post->where('category_id',$id)->orderby('id','desc')->Paginate('9');
        if($category_posts){
        	return response()->json([$category_posts],200);
        }
        return response()->json(['error'], 400);
    }

    
    
    public function update(Request $request,$user_id, $id)
    {
        $category_title = $request->input('category_title');
       	$update_category = Category::where('id',$id)->where('user_id',$user_id)->update(['category_title'=>$category_title]);
       	$my_categories = Category::where('id', $id)->get();
        if($update_category) {
            return response()->json([$my_categories], 201);
        }
            return response()->json(['error'=>'Error'], 400);
        
    }

    
    public function destroy($user_id, $id)
    {
        Category::where('id',$id)->where('user_id',$user_id)->delete();
        return response()->json(['success'], 200);
    }
}
