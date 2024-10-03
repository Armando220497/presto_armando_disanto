<x-layout>
    <div class="container">
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-12">
                <h1 class="display-4" style="font-weight: 500;">
                    <span style="color: white;">Dettaglio dell'articolo:</span><br>
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
                    <img src="{{ asset('img/default.png') }}" alt="Nessuna foto inserita dall'utente"
                        class="img-fluid rounded shadow">
                @endif
            </div>

            <div class="col-12 col-md-6 mb-3 text-center">
                <h4 class="fw-bold">Prezzo: {{ $article->price }} €</h4>
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
