<div class="card mx-auto shadow text-center mb-3" style="width: 18rem;">
    <img src="{{ $article->images->isNotEmpty() ? Storage::url($article->images->first()->path) : 'https://picsum.photos/200' }}"
        class="card-img-top" alt="Immagine dell'articolo {{ $article->title }}">
    <div class="card-body">
        <h4 class="card-title">{{ $article->title }}</h4>
        <h6 class="card-subtitle text-body-secondary">{{ $article->price }} Eur</h6>
        <div class="d-flex justify-content-evenly align-items-center mt-5">
            <a href="{{ route('article.show', compact('article')) }}" class="btn btn-primary">Dettaglio</a>
            @if ($article->category)
                <a href="{{ route('byCategory', ['category' => $article->category->id]) }}">
                    {{ $article->category->name }}
                </a>
            @else
                <span>Categoria non disponibile</span>
            @endif
        </div>
    </div>
</div>
