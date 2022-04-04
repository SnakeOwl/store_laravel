$(document).ready(function(){

    function payment_method_changed()
    {
        var method = $('#payment-type').val();
        if (method == null)
            console.log("Что-то пошло не так при изменении метода оплаты");

        courier_inputs = $('#payment-type-1');
        post_inputs = $('#payment-type-2');
        self_inputs = $('#payment-type-3');

        switch (method) {
            case 'courier':
                if (courier_inputs.hasClass("d-none"))
                    courier_inputs.removeClass("d-none");

                if (!post_inputs.hasClass("d-none"))
                    post_inputs.addClass("d-none");

                if (!courier_inputs.hasClass("d-none"))
                    self_inputs.addClass("d-none");
                break;

            case 'post':
                if (courier_inputs.hasClass("d-none"))
                    courier_inputs.removeClass("d-none");

                if (post_inputs.hasClass("d-none"))
                    post_inputs.removeClass("d-none");

                if (!courier_inputs.hasClass("d-none"))
                    self_inputs.addClass("d-none");

                break;

            case 'self':
                if (!courier_inputs.hasClass("d-none"))
                    courier_inputs.addClass("d-none");

                if (!post_inputs.hasClass("d-none"))
                    post_inputs.addClass("d-none");

                if (courier_inputs.hasClass("d-none"))
                    self_inputs.removeClass("d-none");
                break;

        }
    }


    $('#payment-type').change(function()
    {
        payment_method_changed();
    })
});
