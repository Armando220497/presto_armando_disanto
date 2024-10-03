<x-layout>
    @if (session()->has('errorMessage'))
        <div class="alert alert-danger text-center shadow rounded mx-auto w-50">
            {{ session('errorMessage') }}
        </div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success text-center shadow rounded mx-auto w-50">
            {{ session('message') }}
        </div>
    @endif

    <div class="container-fluid text-center bg-body-tertiary container-home ">
        <div class="row vh-100 justify-content-center align-items-start container-home2">
            <div class="col-12 col-md-6 mt-5">
                <h1 class="display-6" style="font-weight: 700;">{!! __('ui.welcome') !!}</h1>
                <div class="my-3"></div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="text-center py-5">
            <h2 style="color:white; font-weight: 700;">I nostri ultimi articoli</h2>
        </div>

        <!-- Inizio sezione articoli con griglia Bootstrap -->
        <div class="row g-4 justify-content-center align-items-center">
            @forelse($articles as $article)
                <!-- Gestione responsiva con colonne -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
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
    </div>
</x-layout>
