<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth; // Importa Auth se necessario

class ArticleController extends Controller
{
    // Costruttore per applicare il middleware
    public function __construct()
    {
        $this->middleware('auth')->only('create'); // Applica il middleware 'auth' solo al metodo 'create'
    }

    // Metodo per visualizzare il modulo di creazione dell'articolo
    public function create()
    {
        return view('article.create');
    }

    public function index()
    {
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(10);
        return view('article.index', compact('articles'));
    }



    public function show(Article $article)

    {
        return view('article.show', compact('article'));
    }

    public function byCategory(Category $category)
    {
        $articles = $category->articles->where('is_accepted', true);
        return view('article.byCategory', ['articles' => $category->articles, 'category' => $category]);
    }
}
