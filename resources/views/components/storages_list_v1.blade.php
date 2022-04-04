<div class="container">
    @if ( count($storages) > 0 )
        @foreach ($storages as $storage)
            <div class="card mb-3">
                <div class="card-header">
                {{ $storage->name }}
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Адрес: {{ $storage->address }} <br>
                        Телефон: {{ $storage->phone }} <br>
                        Время работы:
                        @php
                            echo str_replace (array("\r\n", "\r", "\n"), '<br>', $storage->schedule);
                        @endphp
                    </p>
                </div>
            </div>


        @endforeach
    @endif
</div>
