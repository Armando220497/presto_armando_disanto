<?php

namespace App\Livewire;

use App\Jobs\ResizeImage;
use App\Jobs\GoogleVisionLabelImage;
use App\Models\Article;
use App\Models\Category;
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
    public $images = [];
    public $temporary_images;

    public function mount()
    {
        $this->category = null;
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
                $newFileName = "articles/{$this->article->id}";
                $newImage = $this->article->images()->create(['path' => $image->store($newFileName, 'public')]);

                // Dispatch del job per ridimensionare l'immagine
                dispatch(new ResizeImage($newImage->path, 300, 300));

                // Dispatch del job per Google Vision Label Detection
                dispatch(new GoogleVisionLabelImage($newImage->id)); // Modificato da GoogleVisionSafeSearch a GoogleVisionLabelImage
            }

            // Cancella la directory temporanea usata da Livewire
            File::deleteDirectory(storage_path('app/livewire-tmp'));
        }

        session()->flash('success', 'Articolo creato correttamente');
        $this->reset(['title', 'description', 'price', 'category', 'images']);
    }

    public function render()
    {
        $categories = Category::all(); // Carica le categorie
        return view('livewire.create-article-form', compact('categories')); // Passa le categorie alla vista
    }

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
