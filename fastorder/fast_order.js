$(document).ready(function () {

		
    $('.container').on('click' ,'.product-list .singleclick, .product-grid .singleclick, .itemcolumns .singleclick', function () {
       $('.fast_order_button').css('display','block');
	    $('#fast_order_result').html('');
        var product = $(this).parents('.product-list > div, .product-grid > div, .itemcolumns');
        $('#product_name').val(product.find('.name a').text());
        $('#product_price').val(product.find('.price').text());
        $('#singleclick_title').text(product.find('.name a').text());
        $.colorbox({
            href: "#fast_order_form",
            inline: true,
            maxWidth:'95%', 
		    maxHeight:'95%',
		    overlayClose: true,
            title: " ",
			opacity: 0.5,
        });
    });


    $('.fast_order_button').on('click', function () {
		var $sendparam = $(this).closest("#fast_order_form");
        var product_name = $('#product_name', $sendparam).val();
        var product_price = $('#product_price', $sendparam).val();
        var customer_name = $('#customer_name', $sendparam).val();
        var customer_phone = $('#customer_phone', $sendparam).val();
        var customer_message = $('#customer_message', $sendparam).val();
	    var captcha = $('#captcha', $sendparam).val();
	    var pr = $('#pr', $sendparam).val();
        $('#fast_order_result', $sendparam).text('Обрабатываем введенные данные..');
        $.post('/index.php?route=module/singleclick', {
            'product_name': product_name,
            'product_price': product_price,
            'customer_name': customer_name,
            'customer_phone': customer_phone,
			'captcha': captcha, 
			'pr': pr ,
            'customer_message': customer_message
        }, function (data) {
            var data = $.parseJSON(data);
            if ('error' in data) {
                $('#fast_order_result', $sendparam).html('<span class="singleclick_error">' + data.error + '</span>');
            } else {
                $('#fast_order_result', $sendparam).html('<span class="singleclick_success">Ваш заказ успешно оформлен!</span><br /><span>Мы перезвоним Вам.</span>');
				$('.fast_order_button', $sendparam).css('display','none');
            }
        });
    });

});