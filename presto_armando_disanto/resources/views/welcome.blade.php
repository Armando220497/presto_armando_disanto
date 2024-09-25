<x-layout>

    <div class="container-fluid text-center bg-body-teritary">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-12 col-md-6">
                <h1 class="display-4">Presto.it</h1>
                <div class="my-3">
                    @auth
                        <a class="btn btn-dark" href="{{ route('create.article') }}">Pubblica un articolo</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="row height-custom justify-content-center align-items-center py-5">
        @forelse($articles as $article)
            <div class="col-12 col-md-3">
                <x-card :article="$article"></x-card>
            </div>
        @empty
            <div class="col-12">
                <h3 class="text-center">
                    Non sono ancora stati caricati articoli
                </h3>
            </div>
        @endforelse
    </div>


</x-layout>
