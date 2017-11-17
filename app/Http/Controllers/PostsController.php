<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Category;
use Illuminate\Validation;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    
    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }



    public function index()
    {
        $my_categories = $this->category->where('user_id',Auth::id())->get();
        $categories = $this->category->get();
        $category_posts = $this->post->where('user_id',Auth::id())->orderby('id','desc')->Paginate('9');
        return view('my_posts', [
            'category_posts'=>$category_posts, 
            'categories'=>$categories, 
            'my_categories'=>$my_categories
            ]);
    }

    
    public function store(PostRequest $request)
    {
        $result = $this->post->create($request->inputs());
        if($result) {
            return response()->json(['post' => $result, 'success' => 'fafa'], 200);
        }
        return response()->json(['error' => 'Something went wrong!!!'], 400);
    }

    
    public function show($id)
    {
        $my_posts = $this->post->where('user_id',Auth::id())->where('id',$id)->get();
        $posts = $this->post->where('id',$id)->get();
        return view('post',['posts'=>$posts, 'my_posts'=>$my_posts]);
    }

    
    public function update(Request $request, $id)
    {
        $inputs = $request->except(['_token', '_method']);
        foreach($inputs as $key => $value) {
            if($value == null) {
                unset($inputs[$key]);
            }
        }
        
        if($this->post->where('id', $id)->update($inputs)) {
             return redirect()->back()->with('success', 'Post changed');
        } 
        return redirect()->back()->with('error', 'Error');
        
     
    }

    
    public function destroy($id)
    {
        $this->post->where('id',$id)->delete();
        return redirect('/posts/');
    }
}
