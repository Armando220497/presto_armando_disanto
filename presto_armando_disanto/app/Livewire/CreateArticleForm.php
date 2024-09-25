<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category; // Assicurati di importare il modello Category
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class CreateArticleForm extends Component
{
    #[Validate('required|min:5')]
    public $title;
    #[Validate('required|min:10')]
    public $description;
    #[Validate('required|numeric')]
    public $price;
    #[Validate('required')]
    public $category;
    public $article;

    // Aggiungi il metodo mount
    public function mount()
    {
        $this->category = null; // Imposta a null per avere l'opzione predefinita
    }

    public function store()
    {
        $this->validate();
        $this->article = Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category,
            'user_id' => Auth::id()
        ]);

        $this->reset(['title', 'description', 'price', 'category']);
        session()->flash('success', 'Articolo creato correttamente');
    }

    public function render()
    {
        $categories = Category::all(); // Carica le categorie
        return view('livewire.create-article-form', compact('categories')); // Passa le categorie alla vista
    }
}
