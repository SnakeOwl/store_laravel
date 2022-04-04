<header class=" py-3 border-bottom">
    <div class="container d-flex flex-wrap align-items-center justify-content-center justify-content-md-between">
          <x-logo/>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
          <li><a class="nav-link px-2 @headerRouteActive('catalog')" href="{{ route('catalog') }}">Каталог</a></li>
          <li><a class="nav-link px-2 @headerRouteActive('basket')" href="{{ route('basket') }}">Корзина</a></li>
          <li><a class="nav-link px-2 link-dark" href="{{ route('basket') }}">Акции</a></li>

        </ul>

        <div class="col-md-3 text-end">
          @auth
                <a href=""></a>
              @admin
                <a class="btn btn-primary" href="{{ route('orders.index') }}">Контрольная панель</a>
              @endadmin

              <form class="d-inline" action="{{ route('logout') }}" method="post">
                  @csrf

                  <button type="submit" class="btn btn-danger">Выход</button>
              </form>
          @else
              <a class="btn btn-outline-primary" href="{{ route('register') }}">Регистрация</a>
              <a class="btn btn-primary" href="{{ route('login') }}">Вход</a>
          @endauth

        </div>
    </div>
</header>


@if( session()->has('warning') )
<div class="container p-4">
    <div class="text-center">
        <p class="text-info">{{ session()->get('warning') }}</p>
    </div>
</div>
@endif

@if( session()->has('danger') )
<div class="container p-4">
    <div class="text-center">
            <p class="text-danger">{{ session()->get('danger') }}</p>
    </div>
</div>
@endif

@if( session()->has('success') )
<div class="container p-4">
    <div class="text-center">
            <p class="text-success">{{ session()->get('success') }}</p>
    </div>
</div>
@endif

@if( session()->has('info') )
<div class="container p-4">
    <div class="text-center">
            <p class="text-info">{{ session()->get('info') }}</p>
    </div>
</div>
@endif
