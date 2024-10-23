<x-layout>
    <div class="container">
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-12">
                <h1 class="display-4" style="font-weight: 500;">
                    <span style="color: white;">{{ __('ui.article_detail') }}</span><br>
                    <span style="color: #EE922B;">{{ $article->title }}</span>
                </h1>
            </div>
        </div>

        <div class="row justify-content-center py-5">
            <div class="col-12 col-md-6 mb-3">
                @if ($article->images->count() > 0)
                    <div id="carouselExample" class="carousel slide" data-bs-interval="2000">
                        <div class="carousel-inner">
                            @foreach ($article->images as $key => $image)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    <img src="{{ $image->getUrl(300, 300) }}" class="d-block mx-auto rounded shadow"
                                        style="max-width: 50%; height: auto;"
                                        alt="{{ __('ui.image_alt', ['number' => $key + 1, 'title' => $article->title]) }}">
                                </div>
                            @endforeach
                        </div>
                        @if ($article->images->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">{{ __('ui.previous') }}</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">{{ __('ui.next') }}</span>
                            </button>
                        @endif
                    </div>
                @else
                    <img src="{{ asset('img/default.png') }}" alt="{{ __('ui.no_user_image') }}" class="img-fluid rounded shadow">
                @endif
            </div>

            <div class="col-12 col-md-6 mb-3 text-center">
                <h4 class="fw-bold">{{ __('ui.price') }} {{ $article->price }} €</h4>
                <h5>{{ __('ui.description') }}</h5>
                <p>{{ $article->description }}</p>

                {{-- Visualizzazione della categoria --}}
                <h5>{{ __('ui.category') }}:</h5>
                @if ($article->category)
                    <a style="color: #EE922B; text-decoration: none; font-weight: 400; font-size: 1.5rem" 
                        href="{{ route('byCategory', ['category' => $article->category->id]) }}">
                        {{ $article->category->name }}
                    </a>
                @else
                    <span>{{ __('ui.category_unavailable') }}</span>
                @endif

                {{-- Visualizzazione del numero di articoli disponibili --}}
                <h5>{{ __('ui.availability') }}:</h5>
                @if ($article->quantity > 0)
                    <span class="text-success">{{ __('ui.available') }}</span>
                    <span class="fw-bold">({{ $article->quantity }} {{ __('ui.items') }})</span>
                @else
                    <span class="text-danger">{{ __('ui.not_available') }}</span>
                @endif
            </div>
        </div>
    </div>
</x-layout>
