<header class="header bg-white">
    <div class="container px-0 px-lg-3">
        <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="index.html"><span class="font-weight-bold text-uppercase text-dark">MYSHOP</span></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link  {{ Route::is('homepage') ? 'active' : '' }}" href="{{ url('/') }}">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('products') ? 'active' : '' }}" href="{{ route('products') }}">Produits</a>
                    </li>

                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="pagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catégories</a>
                        <div class="dropdown-menu mt-3" aria-labelledby="pagesDropdown">
                            @foreach (\App\Models\Category::all() as $category)
                            @if($category->menu == 1)
                            <a class="dropdown-item border-0 transition-link" href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                            @endif
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="detail.html">Contact</a>
                    </li>
                </ul>




                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('checkout.cart') }}"> <i class="fas fa-dolly-flatbed mr-1 text-gray"></i>Panier<small class="text-gray"> ({{ $cartCount }})</small></a></li>
                    <li class="nav-item"><a class="nav-link" href="#search"> <i class="fas fa-search mr-1 text-gray"></i>Recherche</a></li>
                    @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"> <i class="fas fa-sign-in-alt mr-1 text-gray"></i>Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"> <i class="fas fa-user mr-1 text-gray"></i>Inscription</a></li>

                    @else

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="pagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->full_name }} </a>
                        <div class="dropdown-menu mt-3" aria-labelledby="pagesDropdown">
                            <a class="dropdown-item border-0 transition-link" href="{{ route('account.orders') }}">Mes commandes</a>
                            <a class="dropdown-item border-0 transition-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Déconnexion</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                    </li>
                    @endguest

                </ul>
            </div>
        </nav>
    </div>
    <div id="search">
        <button type="button" class="close">×</button>
        <form method="GET" action="{{ route('products-search') }}">
            <input type="search" value="" name="q" id="q" placeholder="Tapez le nom du produit .." />
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>
    </div>
</header>

