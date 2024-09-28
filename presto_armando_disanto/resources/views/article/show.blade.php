<x-layout>
    <div class="container">
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-12">
                <h1 class="display-4">Dettaglio dell'articolo: {{ $article->title }}</h1>
            </div>
        </div>

        <div class="row justify-content-center py-5">
            <div class="col-12 col-md-6 mb-3">
                @if ($article->images->count() > 0)
                    <div id="carouselExample" class="carousel slide" data-bs-interval="2000">
                        <div class="carousel-inner">
                            @foreach ($article->images as $key => $image)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    <img src="{{ $image->getUrl(300, 300) }}" class="d-block w-100 rounded shadow"
                                        alt="Immagine {{ $key + 1 }} dell'articolo {{ $article->title }}">
                                </div>
                            @endforeach
                        </div>
                        @if ($article->images->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                @else
                    <img src="https://picsum.photos/300" alt="Nessuna foto inserita dall'utente"
                        class="img-fluid rounded shadow">
                @endif
            </div>

            <div class="col-12 col-md-6 mb-3 text-center">
                <h2 class="display-5"><span class="fw-bold">Titolo</span> {{ $article->title }}</h2>
                <h4 class="fw-bold">Prezzo: {{ $article->price }} Eur</h4>
                <h5>Descrizione</h5>
                <p>{{ $article->description }}</p>

                {{-- Visualizzazione della categoria --}}
                <h5>Categoria:</h5>
                @if ($article->category)
                    <a href="{{ route('byCategory', ['category' => $article->category->id]) }}">
                        {{ $article->category->name }}
                    </a>
                @else
                    <span>Categoria non disponibile</span>
                @endif

                {{-- Visualizzazione del numero di articoli disponibili --}}
                <h5>Disponibilità:</h5>
                @if ($article->quantity > 0)
                    <span class="text-success">Disponibile</span>
                    <span class="fw-bold">({{ $article->quantity }} articoli)</span>
                @else
                    <span class="text-danger">Non disponibile</span>
                @endif
            </div>
        </div>
    </div>
</x-layout>
