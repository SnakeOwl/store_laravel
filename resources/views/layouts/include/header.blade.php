<header class=" py-3 border-bottom mb-4">
    <div class="container d-flex flex-wrap align-items-center justify-content-center justify-content-md-between">
          <x-logo/>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
          <li><a class="nav-link px-2 @headerRouteActive('catalog')" href="{{ route('catalog') }}">Каталог</a></li>
          <li><a class="nav-link px-2 @headerRouteActive('basket')" href="{{ route('basket') }}">Корзина</a></li>
          <li><a class=" d-none nav-link px-2 link-dark" href="{{ route('basket') }}">Акции</a></li>

        </ul>

        <div class="col-md-3 text-end">
          @auth
            <a class="bttn blue me-1" href="{{ route('users.show', Auth::user()->id) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
            </a>
              @admin
                <a class="bttn blue me-1" href="{{ route('orders.index') }}" title="Панель управления">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-nut-fill" viewBox="0 0 16 16">
                      <path d="M4.58 1a1 1 0 0 0-.868.504l-3.428 6a1 1 0 0 0 0 .992l3.428 6A1 1 0 0 0 4.58 15h6.84a1 1 0 0 0 .868-.504l3.429-6a1 1 0 0 0 0-.992l-3.429-6A1 1 0 0 0 11.42 1H4.58zm5.018 9.696a3 3 0 1 1-3-5.196 3 3 0 0 1 3 5.196z"/>
                    </svg>
                </a>
              @endadmin

              <form class="d-inline" action="{{ route('logout') }}" method="post">
                  @csrf
                  <button type="submit" class="bttn">Выход</button>
              </form>
          @else
              <a class="bttn blue me-1" href="{{ route('register') }}">Регистрация</a>
              <a class="bttn blue" href="{{ route('login') }}">Вход</a>
          @endauth

        </div>
    </div>
</header>
