<x-layout>
    <div class="container-fluid">
        <div class="row height-custom justify-content-center align-items-center text-center">
            <div class="col-12">
                <h1 class="display-1 title-all-articles">{{ __('ui.all_articles') }}</h1>
            </div>
        </div>

        <div class="row g-3 justify-content-center align-items-stretch py-5">
            @forelse ($articles as $article)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                    <x-card :article="$article" />
                </div>
            @empty
                <div class="col-12">
                    <h3 class="text-center">{{ __('ui.no_articles') }}</h3>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center">
            <div>
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-layout>
