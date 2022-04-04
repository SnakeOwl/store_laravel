<div id="carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
        <button type="button" data-bs-target="#carousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="4500">
            <img class="d-block w-100" src="{{ Storage::url('system/razer-logo.jpg') }}" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Razer</h5>
                <p>Лучшие предложения Razer по суперценам</p>
            </div>
        </div>

        <div class="carousel-item" data-bs-interval="4500">
            <img class="d-block w-100" src="{{ Storage::url('system/amd-logo.jpg') }}" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>AMD</h5>
                <p>Оружие быстрой победы</p>
            </div>
        </div>

        <div class="carousel-item" data-bs-interval="4500">
            <img class="d-block w-100" src="{{ Storage::url('system/bloody-logo.jpg') }}" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Bloody</h5>
                <p>Профессиональная периферия по доступным ценам</p>
            </div>
        </div>

        <div class="carousel-item" data-bs-interval="4500">
            <img class="d-block w-100" src="{{ Storage::url('system/intel-logo.jpg') }}" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Intel</h5>
                <p>Совершите следующий рывок в развитии с помощью высокопроизводительной гибридной архитектуры процессоров Intel</p>
            </div>
        </div>

        <div class="carousel-item" data-bs-interval="4500">
            <img class="d-block w-100" src="{{ Storage::url('system/nvidia-logo.jpg') }}" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>NVIDIA</h5>
                <p>Лидер в области вычислений для искусственного интеллекта</p>
            </div>
        </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
