<div id="menuHolder" class="menuHolder">
    <div role="navigation" class="sticky-top border-bottom border-top" id="mainNavigation">
        <div class="flexMain">
            <div class="flex2">
                <button class="whiteLink siteLink" style="border-right:1px solid #eaeaea" onclick="menuToggle()"><i
                        class="fas fa-clock"></i></i> <img src="https://img.icons8.com/sf-black/30/menu.png" /></button>
            </div>

            @if (is_null(Auth::user()))
                <div class="logo" id="siteBrand">
                    DRONEZONE
                </div>
            @elseif(Auth::user()->role == 'admin')
                <div class="logo" id="siteBrand">
                    DRONEZONE adminsite.
                </div>
            @elseif(Auth::user()->role == 'provider')
                <div class="logo" id="siteBrand">
                    DRONEZONE providersite.
                </div>
            @endif

            <div class="login-container">
                <div class="icon-container">
                    @if (is_null(Auth::user()))
                        <div class="whatsapp">
                            <a href="">
                                <img src="https://img.icons8.com/windows/32/whatsapp--v1.png">
                                <img src="https://img.icons8.com/ios-glyphs/32/whatsapp.png ">
                            </a>
                        </div>
                        <div class="email">
                            <a href="">
                                <img src="https://img.icons8.com/material-outlined/30/new-post.png ">
                                <img src="https://img.icons8.com/material-rounded/30/new-post.png">
                            </a>
                        </div>
                    @endif
                </div>
                @if (is_null(Auth::user()))
                    <a class="login" href="{{ route('login') }}">Login</a>
                @else
                    <p class="already-login">{{ Auth::user()->name }}</p>
                    <div class="logout-button" style="display:flex; justify-content:flex-end;">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="button">
                                <img src="https://img.icons8.com/material-outlined/30/exit.png" />
                                <img src="https://img.icons8.com/material-rounded/30/exit.png" />
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <div id="menuDrawer">
        <div class="p-4 border-bottom">
            <div class='row'>
                <div class="col">
                    <select class="noStyle">
                        <option value="ind">Indonesia</option>
                    </select>
                </div>
                <div class="col text-end ">
                    <i role="btn" onclick="menuToggle()"><img
                            src="https://img.icons8.com/ios-filled/20/long-arrow-left.png"
                            style="cursor: pointer;" /></i>
                </div>
            </div>
        </div>
        <div>
            @if (is_null(Auth::user()))
                <a href="/" class="nav-menu-item"><i class="fas fa-home me-3"></i>Home</a>
                <a href="{{ route('explore') }}" class="nav-menu-item"><i
                        class="fab fa-product-hunt me-3"></i>Explore</a>
                <a href="{{ route('article') }}" class="nav-menu-item"><i class="fas fa-search me-3"></i>Article</a>
                <a href="#" class="nav-menu-item"><i class="fas fa-file-alt me-3"></i>Join Us</a>
                <a href="#" class="nav-menu-item"><i class="fas fa-building me-3"></i>About Us</a>
            @elseif(Auth::user()->role == 'admin')
                <a href="{{ route('dashboard.index') }}" class="nav-menu-item"><i
                        class="fas fa-home me-3"></i>Dashboard</a>
                <a href="{{ route('portfolio.index') }}" class="nav-menu-item"><i
                        class="fas fa-home me-3"></i>Portfolio</a>
                <a href="{{ route('articles.index') }}" class="nav-menu-item"><i
                        class="fas fa-home me-3"></i>Articles</a>
            @elseif(Auth::user()->role == 'provider')
                <a href="/" class="nav-menu-item"><i class="fas fa-home me-3"></i>Dashboard</a>
            @endif
        </div>
    </div>
</div>
