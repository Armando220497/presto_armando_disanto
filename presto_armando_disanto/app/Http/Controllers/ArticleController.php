<?php

namespace App\Http\Controllers;

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
}
