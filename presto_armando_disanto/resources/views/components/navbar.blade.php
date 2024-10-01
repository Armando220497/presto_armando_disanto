<nav class="navbar navbar-expand-lg shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('homepage') }}">{{ __('ui.presto') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('homepage') }}">{{ __('ui.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page"
                        href="{{ route('article.index') }}">{{ __('ui.all_articles') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">{{ __('ui.categories') }}</a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('byCategory', ['category' => $category->id]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                            @if (!$loop->last)
                                <hr class="dropdown-divider">
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>

            <!-- Form di ricerca accanto alle categorie -->
            <form class="d-flex" role="search" action="{{ route('article.search') }}" method="GET">
                <div class="input-group">
                    <input type="search" name="query" class="form-control" placeholder="{{ __('ui.search') }}"
                        aria-label="search">
                    <button type="submit" class="input-group-text btn btn-custom" id="basic-addon2">
                        {{ __('ui.search') }}
                    </button>
                </div>
            </form>


            <!-- Spazio aggiuntivo per spostare il resto degli elementi verso destra -->
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ __('ui.hello_user', ['name' => Auth::user()->name]) }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('create.article') }}">{{ __('ui.publish_article') }}</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('create.article') }}"
                                    onclick="event.preventDefault(); document.querySelector('#form-logout').submit();">{{ __('ui.logout') }}</a>
                            </li>
                        </ul>
                        <form action="{{ route('logout') }}" method="post" class="d-none" id="form-logout">@csrf</form>
                    </li>
                    @if (Auth::user()->is_revisor)
                        <li class="nav-item">
                            <a class="nav-link btn btn-custom btn-sm position-relative w-sm-25"
                                href="{{ route('revisor.index') }}">{{ __('ui.revisor_zone') }}
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ \App\Models\Article::toBeRevisedCount() }}</span>
                            </a>

                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ __('ui.hello_guest') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('ui.login') }}</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('ui.register') }}</a></li>
                        </ul>
                    </li>
                @endauth

                <!-- Icone delle bandiere -->
                <div class="d-flex align-items-center">
                    <x-_locale lang="it" />
                    <x-_locale lang="en" />
                    <x-_locale lang="es" />
                </div>
            </ul>
        </div>
    </div>
</nav>
