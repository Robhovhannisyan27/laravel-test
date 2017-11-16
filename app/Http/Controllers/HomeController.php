<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(Category $category)
    {
    	// dd(\Auth::user());
        $categories = $category->get();
        return view('home', ['categories' => $categories]);
    }
}
