<x-layout>
    @if (session()->has('errorMessage'))
        <div class="alert alert-danger text-center shadow rounded w-50">
            {{ session('errorMessage') }}
        </div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success text-center shadow rounded w-50">
            {{ session('message') }}
        </div>
    @endif

    <div class="container-fluid text-center bg-body-tertiary container-home">
        <div class="row vh-100 justify-content-center align-items-start">
            <div class="col-12 col-md-6 mt-5">
                <h1 class="display-6" style="color: white; font-weight: 700;"> {{ __('ui.welcome') }}</h1>
                <div class="my-3">

                </div>
            </div>
        </div>
    </div>


    <div class="row article-section justify-content-center align-items-center py-5">
        <div class="text-center py-5">
            <h2 style="color:white; font-weight: 700;">I nostri ultimi articoli</h2>
        </div>

        @forelse($articles as $article)
            <div class="col-12 col-md-3">
                <x-card :article="$article"></x-card>
            </div>
        @empty
            <div class="col-12">
                <h3 class="text-center">
                    {{ __('ui.no_articles') }}
                </h3>
            </div>
        @endforelse
    </div>
</x-layout>
