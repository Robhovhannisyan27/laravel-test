<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Post;
use App\Category;
use App\Http\Controllers\Controller;
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
        $categories = $this->category->get();
        return response()->json(['categories' => $categories], 200);
    }

    public function myCategories($id)
    {
        $my_categories=$this->category->where('user_id',$id)->get();
        return response()->json(['MyCategories' => $my_categories], 200);
    }
    
    
    public function store(Request $request, $id)
    {
    	$category = $this->category->create(['category_title'=>$request->get('category_title'), 'user_id'=>$id]);
        if($category) {
            return response()->json(['category' => $category], 200);
        }
        	return response()->json(['message'=> 'error'], 403);
        
    }

    
    public function show($id, Post $post)
    {
        $category_posts=$post->where('category_id',$id)->orderby('id','desc')->Paginate('9');
        if($category_posts){
        	return response()->json([$category_posts],200);
        }
        return response()->json(['error'], 403);
    }

    
    
    public function update(Request $request, $id)
    {
        $inputs = $request->input('category_title');
       	$edit = $this->category->where('id', $id)->update(['category_title'=>$inputs]);
       	$category = $this->category->where('id', $id)->get();
        if($edit) {
            return response()->json([$category]);
        } else {
            return response()->json(['error'=>'Error'], 403);
        }
    }

    
    public function destroy($id)
    {
        $this->category->where('id',$id)->delete();
        return response()->json(['success']);
    }
}
