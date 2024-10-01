<div class="card card-bg mx-auto shadow text-center mb-3" style="width: 18rem;">
    <img src="{{ $article->images->isNotEmpty() ? $article->images->first()->getUrl(300, 300) : 'https://picsum.photos/200' }}"
        class="card-img-top" alt="Imagen del artículo {{ $article->title }}" style="object-fit: cover; height: 200px;">
    <div class="card-body d-flex flex-column justify-content-between">
        <h4 class="card-title">{{ $article->title }}</h4>
        <h6 class="card-subtitle text-body-secondary">{{ $article->price }} Eur</h6>
        <div class="d-flex justify-content-evenly align-items-center mt-5">
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
