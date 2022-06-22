$(document).ready(function(){

    function delivery_method_changed()
    {
        var method = $('#delivery_method').val();
        if (method == null)
            console.log("Что-то пошло не так при изменении способа доставки");

        courier_inputs = $('#payment-type-1');
        post_inputs = $('#payment-type-2');
        self_inputs = $('#payment-type-3');

        switch (method) {
            case 'Доставка курьером':
                if (courier_inputs.hasClass("d-none"))
                    courier_inputs.removeClass("d-none");

                if (!post_inputs.hasClass("d-none"))
                    post_inputs.addClass("d-none");

                if (!courier_inputs.hasClass("d-none"))
                    self_inputs.addClass("d-none");
                break;

            case 'Доставка почтой':
                if (courier_inputs.hasClass("d-none"))
                    courier_inputs.removeClass("d-none");

                if (post_inputs.hasClass("d-none"))
                    post_inputs.removeClass("d-none");

                if (!courier_inputs.hasClass("d-none"))
                    self_inputs.addClass("d-none");

                break;

            case 'Доставка до точки самовывоза':
                if (!courier_inputs.hasClass("d-none"))
                    courier_inputs.addClass("d-none");

                if (!post_inputs.hasClass("d-none"))
                    post_inputs.addClass("d-none");

                if (courier_inputs.hasClass("d-none"))
                    self_inputs.removeClass("d-none");
                break;

        }
    }


    $('#delivery_method').change(function()
    {
        delivery_method_changed();
    })

    delivery_method_changed(); // если пользователь перезагрузил страницу
});
