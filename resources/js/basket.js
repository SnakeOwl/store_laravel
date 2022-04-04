
$(document).ready(function(){

    // global constants
    var BASKET = $("#basket");
    var ITEMS = $("#basket-items");
    var FULL_PRICE = $("#basket-full-price");

    // доделать количество

    //    Функция для бинда на кнопочки в каталоге.
    //    Добавляет предмет в корзину, еще делает ajax запрос, для сервера.
    function add_item_to_basket()
    {
        let id = $(this).attr("i_id");
        let name = $(this).attr("i_name");
        let price = $(this).attr("i_price");
        let amount = 1;

        //аякс чтобы засунуть товар в корзину через сессии!
        $.ajax({
            url: "/catalog/basket/add_item",
            dataType:"json",
            method: "GET",
            data: {
                id: id,
                amount: amount,
                name: name,
                price: price
            },
            success: function( result ) {
                $("#message").html(result);
                $(this).attr('disabled', 'true');
            }
        });

        create_new_basket_item(name, price);
        baket_change_visible_if_need();
    }

    // создает новый элемент DOM в корзине
    function create_new_basket_item(name, price)
    {
        if ($("#clone-for-script") == 0)
        {
            console.log("Error: не удалиось найти DOM элемент для клонирования, в корзине.")
            return;
        }

        $("#clone-for-script").clone().removeClass("d-none").appendTo(ITEMS);

        calculate_full_price();
    }

    /*
        Смотрит на элементы DOM в корзине, а затем пересчитывает все их цены и обновляет счетчик.
        Не сверяет данные с сервером!

        @return Сумма, округленная до *.00
    */
    function calculate_full_price()
    {
        let prices = ITEMS.children(".price");
        let full_price = 0;
        for (var i = 0; i < prices.length; i++)
        {
            full_price += (prices[i].innerHTML * 1);
        }

        full_price = full_price.toFixed(2);
        FULL_PRICE.innerHTML = full_price;

        return full_price;
    }

    /*доделать*/
    function delete_item_from_basket()
    {

        /*
            function tt(){
            this.parent(".item").remove();
            }
            $(".item-param-del").onclick = tt;
        */
        let id = $(this).attr('id');

        $.ajax({
            url: "/basket/delete_item",
            dataType:"json",
            method: "GET",
            data: {
                id: id,
            },
            success: function( result ) {
                $("#message").html(result);
            }
        });
    }

    // Задает функции кнопочкам в каталоге.
    function bind_buttons()
    {
        $(".cart-btn-basket").click(add_item_to_basket);
        $('.btn-delete-from-basket').click(delete_item_from_basket);
    }

    // Скрывает корзину, если та пустая. Пересчитывает все суммы товаров в ней.
    function baket_change_visible_if_need()
    {
        let sum = calculate_full_price();

        if (sum == false)
        {
            if (!BASKET.hasClass("d-none"))
                BASKET.addClass("d-none");
        }
        else
        {
            if (BASKET.hasClass("d-none"))
                BASKET.removeClass("d-none");
        }
    }

    // Вызовы функций.
    baket_change_visible_if_need();
    bind_buttons();
});
