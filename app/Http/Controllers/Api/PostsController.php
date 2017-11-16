<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Post;
use App\Category;
use Illuminate\Validation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    
    public function __construct(Post $post, Category $category)
    {
        $this->middleware('auth');
        $this->post = $post;
        $this->category = $category;
    }



    public function index()
    {
        // dd(Auth::user());
        $my_posts = $this->post->where('user_id',Auth::user()->id)->orderby('id','desc')->Paginate(9);
        return response()->json(['posts', $my_posts],200);
    }

    
    public function store(PostRequest $request)
    {
        $inputs = $request->inputs();
        $inputs['user_id'] = Auth::user()->id;
        $create_post = $this->post->create($inputs);
        if($create_post) {
            return response()->json(['post' => $create_post, 'success' => 'fafa'], 201);
        } 
        return response()->json(['error' => 'Something went wrong!!!'], 400);
    }

    
    public function show($id)
    {
        $my_posts=$this->post->where('id',$id)->get();
        return response()->json(['post' => $my_posts], 200);
    }

    
    public function update(Request $request, $id)
    {
        
        $inputs = $request->except(['_token', '_method']);
        if(strlen($inputs['longtext'])<20) {
            $inputs['text']=$inputs['longtext'];
        } else {
            $inputs['text']=substr($inputs['longtext'],0,20).'...';
        }
        foreach($inputs as $key => $value) {
            if($value==null) {
                unset($inputs[$key]);
            }
            if($value=='undefined'){
                unset($inputs[$key]);
            }
        }

        $update_post = $this->post->where('id', $id)->where('user_id',Auth::user()->id)->update($inputs);

        if($update_post) {
            $get_post = $this->post->where('id', $id)->get();
            
            return response()->json([$get_post], 200);
        } 
        return response()->json(['error'], 400);
        
     
    }

    
    public function destroy($id)
    {
        $this->post->where('id',$id)->where('user_id',Auth::user()->id)->delete();
        return response()->json(['post delete'], 200);
    }
}
