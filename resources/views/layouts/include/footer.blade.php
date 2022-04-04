<footer class="container-fluid bg-dark text-white py-5 mt-5 footer">
    <div class="container">

        <div class="row">
            <div class="col-3">
                <a class="link-light px-0" href="tel:375291234567" itemprop="telephone" content="375291234567"> 375 29 123 4567</a>
                <div class="text-muted">Бесплатно по РБ</div>

                <div class="mt-5">
                    <a class="link-light px-0" href="tel:375291234567" itemprop="telephone" content="375291234567"> 375 29 123 8523</a>
                    <div class="text-muted">Пн-Пт 9 AM - 10 PM МСК</div>
                    <div class="text-muted">Сб-Вс 12 AM - 8 PM МСК</div>
                </div>
            </div>

            <div class="col-3">
                <h4>Магазин</h4>
                <div class="list-group">
                    <a href="{{ route('about') }}#oformlenie-zakaza" class="link-light px-0">Оформление заказа</a>
                    <a href="{{ route('about') }}#oplata-zakaza" class="link-light px-0">Оплата заказа</a>
                    <a href="{{ route('about') }}#actii" class="link-light px-0">Условия акций</a>
                    <a href="{{ route('delivery') }}" class="link-light px-0">Доставка заказа</a>
                </div>
            </div>


            <div class="col-3">
                <div class="list-group">
                    <h4>Поддержка</h4>
                    <a href="{{ route('support') }}" class="link-light px-0">Техническая поддержка</a>
                    <a href="{{ route('service') }}" class="link-light px-0">Сервис и гарантия</a>
                    <a href="{{ route('personal-data') }}" class="link-light px-0">Персональные данные</a>
                    <a href="{{ route('terms') }}" class="link-light px-0">Положения и условия</a>
                </div>
            </div>

            <div class="col-3">
                <div class="list-group">
                    <h4>Связь с администрацией</h4>
                    <a href="{{ route('support-form') }}" class="link-light">Форма связи</a>
                </div>

                <!-- <img src="{{ Storage::url('logo-white.png') }}" class="d-inline" width="50" alt="Белый логотип"> -->
                <!-- <img src="{{ Storage::url('mastercard-logo.png') }}" class="d-inline" width="50" alt="Белый логотип"> -->
                <!-- <img src="{{ Storage::url('visa-logo.png') }}" class="d-inline" width="50" alt="Белый логотип"> -->
            </div>


        <div class="row mt-4">
            <div class="col-12 text-center">
                &copy 2021 Николай Аникеев. Сайт не является интернет-магазином.
            </div>
        </div>
    </div>
</footer>
