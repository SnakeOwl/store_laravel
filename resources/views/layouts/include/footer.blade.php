<footer class="container-fluid bg-dark text-white py-5 mt-5 footer">
    <div class="container">

        <div class="row">
            <div class="col-3">
                <a class=" px-0" href="tel:375291234567" itemprop="telephone" content="375291234567"> 375 29 123 4567</a>
                <div class="text-muted">Бесплатно по РБ</div>

                <div class="mt-5">
                    <a class=" px-0" href="tel:375291234567" itemprop="telephone" content="375291234567"> 375 29 123 8523</a>
                    <div class="text-muted">Пн-Пт 9 AM - 10 PM МСК</div>
                    <div class="text-muted">Сб-Вс 12 AM - 8 PM МСК</div>
                </div>
            </div>

            <div class="col-3">
                <h4>Магазин</h4>
                <div class="list-group">
                    <a class="mb-2 px-0" href="{{ route('about') }}#oformlenie-zakaza" >Оформление заказа</a>
                    <a class="mb-2 px-0" href="{{ route('about') }}#oplata-zakaza" >Оплата заказа</a>
                    <a class="mb-2 px-0" href="{{ route('about') }}#actii" >Условия акций</a>
                    <a class="px-0" href="{{ route('delivery') }}" >Доставка заказа</a>
                </div>
            </div>


            <div class="col-3">
                <div class="list-group ">
                    <h4>Поддержка</h4>
                    <a class="mb-2 px-0" href="{{ route('support') }}" >Техническая поддержка</a>
                    <a class="mb-2 px-0" href="{{ route('service') }}" >Сервис и гарантия</a>
                    <a class="mb-2 px-0" href="{{ route('personal-data') }}" >Персональные данные</a>
                    <a class="px-0" href="{{ route('terms') }}" >Положения и условия</a>
                </div>
            </div>

            <div class="col-3">
                <div class="list-group">
                    <h4>Связь с администрацией</h4>
                    <a href="{{ route('support.create') }}" class="">Форма связи</a>
                </div>

                <svg width="70" height="70"
                    xmlns="http://www.w3.org/2000/svg">
                    <image href="{{ Storage::url('/system/logo.svg') }}" height="70" width="70"/>
                </svg>

            </div>

        </div>

        <div class="row mt-4">
            <div class="col-12 text-center">
                &copy 2022 Николай Аникеев. Сайт не является интернет-магазином.
            </div>
        </div>
</footer>
