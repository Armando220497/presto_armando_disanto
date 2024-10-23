<x-layout>
    <div class="container-fluid pt-5">
        <!-- Mostra i messaggi di successo o errore -->
        @if (session()->has('message'))
            <div class="alert alert-success text-center">
                <span class="fw-bold" style="color: green !important;">{{ session('message') }}</span>
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-danger text-center">
                <span class="fw-bold" style="color: red !important;">{{ session('error') }}</span>
            </div>
        @endif

        <div class="row">
            <div class="col-3">
                <div class="rounded shadow bg-body-secondary">
                    <h1 class="display-6 text-center pb-2">
                        Revisor dashboard
                    </h1>
                </div>
            </div>

            @if ($article_to_check)
                <!-- Mostra l'articolo da revisionare -->
                <div class="row justify-content-center pt-5">
                    <div class="col-md-8">
                        <!-- Card unica per l'articolo con le immagini -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3>{{ $article_to_check->title }}</h3>
                            </div>
                            <div class="card-body">
                                <p><strong>Autore:</strong> {{ $article_to_check->user->name }}</p>
                                <p><strong>Prezzo:</strong> {{ $article_to_check->price }}€</p>
                                <p><strong>Categoria:</strong> {{ $article_to_check->category->name }}</p>
                                <p class="h6">Descrizione: {{ $article_to_check->description }}</p>

                                <!-- Visualizza tutte le immagini in un layout a griglia -->
                                @if ($article_to_check->images && $article_to_check->images->count() > 0)
                                    <div class="row">
                                        @foreach ($article_to_check->images as $image)
                                            <div class="col-4 mb-2">
                                                <img src="{{ $image->getUrl(600, 600) }}"
                                                    class="img-fluid rounded shadow"
                                                    alt="Immagine dell'articolo '{{ $article_to_check->title }}'">
                                                <div class="mt-2">
                                                    <h5>Labels</h5>
                                                    @if (is_array($image->labels) && count($image->labels) > 0)
                                                        <div>
                                                            @foreach ($image->labels as $label)
                                                                #{{ $label }}@if (!$loop->last)
                                                                    ,
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <p class="fst-italic">No Labels</p>
                                                    @endif

                                                    <h5 class="mt-3">Ratings</h5>
                                                    <div class="d-flex flex-column align-items-start">
                                                        <div>Adult: <span class="{{ $image->adult }}"></span></div>
                                                        <div>Violence: <span class="{{ $image->violence }}"></span>
                                                        </div>
                                                        <div>Spoof: <span class="{{ $image->spoof }}"></span></div>
                                                        <div>Racy: <span class="{{ $image->racy }}"></span></div>
                                                        <div>Medical: <span class="{{ $image->medical }}"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <!-- Immagini segnaposto se non ci sono immagini -->
                                    <div class="row">
                                        @for ($i = 0; $i < 3; $i++)
                                            <div class="col-4 mb-4">
                                                <img src="{{ asset('img/default.png') }}" alt="immagine segnaposto"
                                                    class="img-fluid rounded shadow">
                                            </div>
                                        @endfor
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Pulsanti per accettare o rifiutare l'articolo -->
                        <div class="d-flex justify-content-between pb-4">
                            <form action="{{ route('reject', ['article' => $article_to_check]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-danger fw-bold">Rifiuta</button>
                            </form>
                            <form action="{{ route('accept', ['article' => $article_to_check]) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success fw-bold">Accetta</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <!-- Messaggio quando non c'è nessun articolo da revisionare -->
                <div class="row justify-content-center align-items-center height-custom text-center">
                    <div class="col-12">
                        <h1 class="fst-italic display-4">Nessun articolo da revisionare</h1>
                        <a href="{{ route('homepage') }}" class="mt-5 btn btn-success">Torna all'homepage</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layout>
