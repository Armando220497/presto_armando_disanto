<div class="card card-bg mx-auto shadow text-center mb-3" style="width: 18rem;">
    <!-- Immagine dell'articolo -->
    <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl(300, 300) : asset('img/default.png') }}"
        class="card-img-top" alt="Imagen del artículo {{ $article->title }}"
        style="width: auto; max-height: 200px; object-fit: contain; object-position: center;">

    <!-- Corpo della card -->
    <div class="card-body d-flex flex-column justify-content-between">
        <h4 class="card-title">{{ $article->title }}</h4>
        <h6 class="card-subtitle text-body-secondary">{{ $article->price }} €</h6>

        <div class="card-footer-links d-flex justify-content-evenly align-items-center mt-5">
            <a href="{{ route('article.show', compact('article')) }}" class="btn card-btn">{{ __('ui.detail') }}</a>
            @if ($article->category)
                <a class="category-text" href="{{ route('byCategory', ['category' => $article->category->id]) }}">
                    {{ $article->category->name }}
                </a>
            @else
                <span>{{ __('ui.category_unavailable') }}</span>
            @endif
        </div>
    </div>
</div>
