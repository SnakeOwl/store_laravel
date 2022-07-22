<h1>{{$item->name}} появился в наличии</h1>
<p>Уважаемый клиент, товар {{$item->name}} появился в наличии. Вы можете его заказать на нашем сайте: <a href="{{route('catalog-item', [$item->category->alias, $item->alias])}}">Подробнее</a></p>
