<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Category;
use Illuminate\Validation;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;

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
        $myCategories=$this->category->where('user_id',Auth::id())->get();
        $categories = $this->category->get();
        $category_post = $this->post->where('user_id',Auth::id())->orderby('id','desc')->Paginate('9');
        return view('my-posts', ['category_post'=>$category_post , 'categories'=>$categories, 'myCategories'=>$myCategories]);
    }

    public function errors(Request $request){
        if($request->ajax()) {
            return view('my-posts');
        }
        dd('ok');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $inputs=$request->all();
        $inputs['user_id'] = Auth::id();
        unset($inputs['_token']);
        if(strlen($inputs['longtext'])<20)
        {
            $inputs['text']=$inputs['longtext'];
        }
        else{
            $inputs['text']=substr($inputs['longtext'],0,20).'...';
        }
        if($request->hasFile('image')){   
            $image = $request->file('image');
            $inputs['image'] = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/image'), $inputs['image']);
        }
         $post = $this->post->create($inputs);
        if($post)
        {
            return response()->json(['post' => $post], 200);
        }
        else
        {
            return response()->json(['error' => 'Something went wrong!!!'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $myPosts=$this->post->where('user_id',Auth::id())->where('id',$id)->get();
        $posts=$this->post->where('id',$id)->get();
        return view('post',['posts'=>$posts, 'myPosts'=>$myPosts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        unset($inputs['_method']);
        foreach($inputs as $key => $value){
            if($value==null)
            {
                unset($inputs[$key]);
            }
        }
        
        if($this->post->where('id', $id)->update($inputs)){
             return redirect()->back()->with('success', 'Post changed');
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
        $this->post->where('id',$id)->delete();
        return redirect('/posts/');
    }
}
