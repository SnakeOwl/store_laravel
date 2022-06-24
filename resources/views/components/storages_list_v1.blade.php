@if ( count($storages) > 0 )
<div class="container">

    @foreach ($storages as $storage)
    <div class="card mb-3">
        <div class="card-header">
            {{ $storage->name }}
        </div>
        <div class="card-body">
            <p class="card-text">
                Адрес: {{ $storage->address }} <br>
                @isset($storage->phone)
                    Телефон: {{ $storage->phone }} <br>
                @endisset
                Время работы:
                {!! $storage->get_schedule() !!}
            </p>
        </div>
    </div>
    @endforeach
</div>
@endif
