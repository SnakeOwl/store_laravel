<h1>Заказ принят. Номер заказа </h1>
<p>Уважаемый {{$order->name}}</p>
<p>Ваш заказ на сумму {{$full_cost}}</p>

<h2>Заказываемые товары</h2>
<table>
    <thead>
        <tr>
            <th>Изображение</th>
            <th>Название</th>
            <th>Количество</th>
            <th>Цена (за шт.)</th>
            <th>Стоимость</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
        <tr>
            <td><img src="{{ Storage::url($item->short_image) }}" width="200" alt="Изображение"></td>
            <td><span class="basket-item-name">{{$item->name}}</span></td>
            <td>
                <span>{{$item->pivot->amount}}</span>
            </td>
            <td class="text-end"><span>{{$item->price}}</span></td>
            <td class="text-end"><span>{{ $item->get_cost_for_amount() }}</span></td>

        </tr>
        @endforeach
    </tbody>
</table>
