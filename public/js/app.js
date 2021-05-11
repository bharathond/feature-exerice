$(document).ready(function(){
    var cart = JSON.parse(localStorage.getItem("cart")) || {};
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var baseUrl = $('meta[name="base_url"]').attr('content');
    $(document).on('click','.add_list',function(){
        var qty = $(this).prev().val();
        if(qty != ''){
            var model_id = $(this).data('id');
            if (cart[model_id]) {
                if(cart[model_id].qty != qty){
                    cart[model_id].qty = qty;
                }
                var newCart = {};
                newCart[model_id] = {
                    model_id,
                    qty
                };
                var newArray = $.merge(cart, newCart);
                console.log(cart);
            } else {
                cart[model_id] = {
                    model_id,
                    qty
                };
                localStorage.setItem("cart", JSON.stringify(cart));
            }
            loadCart(cart,CSRF_TOKEN,baseUrl);
        }
        else{
            alert('Please enter Quantity of Product then add to List');
        }
    });

    $(document).on('click','.clear-list',function(){
        localStorage.clear();
        loadCart(cart,CSRF_TOKEN,baseUrl);
    });
    loadCart(cart,CSRF_TOKEN,baseUrl);
});

function loadCart(cart,CSRF_TOKEN,baseUrl){
    $.ajax(baseUrl+'/product/cart', {
        type: 'POST',
        data: { _token: CSRF_TOKEN,cart: cart },
        success: function (data, status, xhr) {
            $('#load_cart').html(data.html);
        }
    });
}