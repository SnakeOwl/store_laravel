<div class="submenu">
    <div class="list-group">
    @foreach($items as $item)
        <a class="list-group-item list-group-item-action
        @if ( $current_item_alias != false )
            @if ($current_item_alias == $item->alias)
                 list-group-item-success active
            @endif
        @endif
        " href=" {{ route('catalog-alias', $item->alias ) }} ">{{ $item->name }}</a>
    @endforeach
    </div>
</div>
