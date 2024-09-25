<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    public function homepage()
    {
        $articles = Article::with('category')->orderBy('created_at', 'desc')->take(6)->get();
        return view('welcome', compact('articles'));
    }
}
