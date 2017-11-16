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
        $posts = $this->post->where('user_id',Auth::id())->orderby('id','desc')->Paginate(9);
        return response()->json(['posts', $posts],200);
    }

    
    public function store(PostRequest $request)
    {
        $crateing_posts_fields = $request->inputs();
        $crateing_posts_fields['user_id'] = Auth::user()->id;
        $result = $this->post->create($crateing_posts_fields);
        if($result) {
            return response()->json(['post' => $result, 'success' => 'fafa'], 201);
        } 
        return response()->json(['error' => 'Something went wrong!!!'], 400);
    }

    
    public function show($id)
    {
        $posts=$this->post->where('id',$id)->get();
        return response()->json(['post' => $posts], 200);
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

        $result = $this->post->where('id', $id)->where('user_id',Auth::id())->update($inputs);

        if($result) {
            $get_posts = $this->post->where('id', $id)->get();
            return response()->json([$get_posts], 200);
        } 
        return response()->json(['error'], 400);
        
     
    }

    
    public function destroy($id)
    {
        $this->post->where('id',$id)->where('user_id',Auth::user()->id)->delete();
        return response()->json(['post delete'], 200);
    }
}
