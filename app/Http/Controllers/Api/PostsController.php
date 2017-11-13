<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Post;
use App\Category;
use Illuminate\Validation;
use App\Http\Controllers\Controller;
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



    public function index($id)
    {
        // $my_categories=$this->category->where('user_id',$id)->get();
        // $categories = $this->category->get();
        $post = $this->post->where('user_id',$id)->orderby('id','desc')->Paginate('9');
        return response()->json(['posts', $post],200);
    }

    
    public function store(PostRequest $request, $id)
    {
        $inputs = $request->inputs();
        $inputs['user_id'] = $id;
        $post = $this->post->create($inputs);
        if($post) {
            return response()->json(['post' => $post, 'success' => 'fafa'], 200);
        } else {
            return response()->json(['error' => 'Something went wrong!!!'], 400);
        }
    }

    
    public function show($id)
    {
        $posts=$this->post->where('id',$id)->get();
        //dd($posts);
        return response()->json(['post' => $posts], 200);
    }

    
    public function update($id, Request $request)
    {
        //dd($id, $request->all());
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

        $post = $this->post->where('id', $id)->update($inputs);

        if($post) {
            $updatePost = $this->post->where('id', $id)->get();
            
            return response()->json([$updatePost], 200);
        } 
        return response()->json(['error'], 403);
        
     
    }

    
    public function destroy($id)
    {
        $this->post->where('id',$id)->delete();
        return response()->json(['post delete'], 200);
    }
}
