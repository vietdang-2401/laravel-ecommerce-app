<header class="section-header">
    <section class="header-main">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-1">
                    <div class="brand-wrap">
                        <a href="{{ url('/') }}">
                            <img class="logo" src="{{ asset('frontend/images/logo-dark.png') }}" alt="logo">
                        </a>
                    </div>
                </div>
                <div class=" col-lg-3 " id="main_nav">
                    <ul class="navbar-nav">
                        @foreach($categories as $cat)
                        @foreach($cat->items as $category)
                        @if ($category->items->count() > 0)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ route('category.show', $category->slug) }}"
                                id="{{ $category->slug }}" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">{{
                                $category->name }}</a>
                            <div class="dropdown-menu" aria-labelledby="{{ $category->slug }}">
                                @foreach($category->items as $item)
                                <a class="dropdown-item" href="{{ route('category.show', $item->slug) }}">{{ $item->name
                                    }}</a>
                                @endforeach
                            </div>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category.show', $category->slug) }}">{{ $category->name
                                }}</a>
                        </li>
                        @endif
                        @endforeach
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <form action="#" class="search-wrap">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nhập từ khóa cần tìm?">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="widgets-wrap d-flex justify-content-end">
                        <div class="widget-header">
                            <a href="{{route('checkout.cart')}}" class="icontext">
                                <div class="icon-wrap icon-xs bg2 round text-secondary"><i
                                        class="fa fa-shopping-cart"></i></div>
                                <div class="text-wrap">
                                    <small>{{$cartCount}} sản phẩm</small>
                                </div>
                            </a>
                        </div>
                        @guest
                        <div class="widget-header">
                            <a href="{{ route('login') }}" class="ml-3 icontext">
                                <div class="icon-wrap icon-xs bg-primary round text-white"><i class="fa fa-user"></i>
                                </div>
                                <div class="text-wrap"><span>Đăng nhập</span></div>
                            </a>

                        </div>
                        <div class="widget-header">
                            <a href="{{ route('register') }}" class="ml-3 icontext">
                                <div class="icon-wrap icon-xs bg-success round text-white"><i class="fa fa-user"></i>
                                </div>
                                <div class="text-wrap"><span>Đăng ký</span></div>
                            </a>
                        </div>
                        @else
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->full_name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Đăng xuất') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('account.orders') }}">Quản lý đơn hàng</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- @include('site.partials.nav') --}}
</header>