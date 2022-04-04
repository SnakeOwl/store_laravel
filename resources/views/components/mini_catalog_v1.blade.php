<div class="mini-catalog-v1 m-5">
    <div class="row">
        @if (count($items) > 0)
            @foreach ($items as $item)
                <div class="container col-xxl-8 px-4 py-5">
                    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                        <div class="col-12 col-sm-8 col-lg-6">
                            <img src="{{ Storage::url($item->short_image) }}" alt="Bootstrap Themes" loading="lazy" class="d-block mx-auto mx-lg-auto img-fluid" width="700" height="500">
                        </div>

                        <div class="col-lg-6">
                            <h1 class="display-5 fw-bold lh-1 mb-3">{{ $item->name }}</h1>
                            <p class="lead">
                                @php
                                    echo $item->get_description()
                                @endphp
                            </p>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <a type="button" class="btn btn-primary btn-lg px-4 me-md-2">Подробнее</a>
                                <button type="button" class="btn btn-outline-danger btn-lg px-4">Купить</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>Сайт заполняется</p>
        @endif
    </div>

</div>
