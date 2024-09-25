<x-layout>

    <div class="container">

        <div class="row py-5 justify-content-center align-items-center text-center">

            <div class="col-12 pt-5">
                <h1 class="display-2">Articoli della categoria <span
                        class="fst-italic fw-bold">{{ $category->name }}</span></h1>
            </div>

        </div>

        @forelse ($articles as $article)
            <div class="row height-custom justify-content-center align-items-center py-5">
                <div class="col-12 col-md-3">
                    <x-card :article="$article" />
                </div>
            </div>

        @empty
            <div class="row text-center">
                <div class="col-12">
                    <h3>Non sono ancora stati creati articoli per questa categoria</h3>
                </div>
            </div>
        @endforelse

        @auth
            <div class="text-center">
                <a class="btn btn-dark my-5" href="{{ route('create.article') }}">Pubblica un articolo</a>
            </div>
        @endauth

    </div>

</x-layout>
