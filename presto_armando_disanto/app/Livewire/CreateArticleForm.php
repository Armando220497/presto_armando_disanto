<?php

namespace App\Livewire;

use App\Jobs\ResizeImage;
use App\Models\Article;
use App\Models\Category; // Assicurati di importare il modello Category
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class CreateArticleForm extends Component
{
    use WithFileUploads;



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
        $this->images = [];
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

        if (count($this->images) > 0) {
            foreach ($this->images as $image) {
                $newFilename = "articles/{$this->article->id}";
                $newImage =   $this->article->images()->create(['path' => $image->store($newFilename, 'public')]);
                dispatch(new ResizeImage($newImage->path, 300, 300));
            }
            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        session()->flash('success', 'Articolo creato correttamente');
        $this->reset(['title', 'description', 'price', 'category', 'images']);
    }

    public function render()
    {
        $categories = Category::all(); // Carica le categorie
        return view('livewire.create-article-form', compact('categories')); // Passa le categorie alla vista
    }

    public $images = [];
    public $temporary_images;

    public function updatedTemporaryImages()
    {
        if ($this->validate([
            'temporary_images.*' => 'image|max:1024',
            'temporary_images' => 'max:6'
        ])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }
    }

    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }
}
