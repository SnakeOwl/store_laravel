<section class="filter px-3">
    <!-- поисковик -->

    <section class="mb-3">
        <form action="{{route('catalog')}}">

            <div class="form-floating mb-1">
                <input type="text" class="form-control" name="search" id="searcher" placeholder="Поисковик"
                @isset($search)
                    value="{{$search}}"
                @endisset
                >
                <label for="searcher">Поиск</label>
            </div>
                <button class="bttn blue w-100">Найти</button>

        </form>
    </section>

    <form class="d-xl-block d-none" action="{{ route('catalog') }}">
        <!-- фильтр по категориям -->
        <section class="mb-3">
            <h6>Фильтр:</h6>
            <a class="bttn blue w-100 mb-2" href="{{route('catalog')}}">Все товары</a>
            @foreach($aliases as $alias)
                <a class="bttn w-100 mb-1
                @if(isset($current_category) && $current_category == $alias->id)
                    green
                @else
                    blue
                @endif
                " href="{{route('catalog-category-alias', $alias->id)}}">
                    {{ $alias->name }}
                </a>
            @endforeach
        </section>

        <!-- фильтр по параметрам товара -->
        <section>
            <div class="mb-3 ">
                <label for="price_from" class="form-label">Цена</label>
                <div class="input-group">
                    <input type="number" min="1" class="form-control" name="price_from" id="price_from" value="{{ request()->price_from }}">
                    <span class="input-group-text">до</span>
                    <input type="number" min="1" class="form-control" name="price_to" value="{{ request()->price_to }}">
                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="new" id="new" @if( request()->has('new') ) checked @endif >
                <label for="new" class="form-check-label">Новинка</label>
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="hit" id="hit" @if( request()->has('hit') ) checked @endif>
                <label for="hit" class="form-check-label">Хит продаж</label>
            </div>
            @isset($current_category)
                <input type="hidden" name="category_id" value="{{$current_category}}">
            @endisset
            <button class="bttn blue w-100" type="submit">Фильтровать</button>
        </section>
    </form>


</section>
