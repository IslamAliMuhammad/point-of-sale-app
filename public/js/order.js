$('.add-product-btn').on('click', function (e) {

    $(this).attr('disabled', true);

    var id = $(this).data('id');
    var name = $(this).data('name');
    var price = $(this).data('price');
    var stock = $(this).data('stock');
    console.log(name)
    $html = `
        <tr>
            <td>${name}</td>
            <td ><input class="product-price product-quantity" data-price="${price}" name="products[${id}][quantity]" type="number" min="1" value="1" max="${stock}" style="width: 75px" data-id="${price}"></td>
            <td>${new Intl.NumberFormat('en-IN').format(price)}</td>
            <td><button type="button" class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><i class="fa fa-trash"></i></button></td>
        </tr>
    `;

    $('#order-list').append($html)

    calculateTotal()
});


$('body').on('click', '.remove-product-btn',function(e) {
    const id = $(this).data('id');

    $(this).closest('tr').remove();

    $(this).closest('tr')

    $('#product-' + id).attr('disabled', false);

    calculateTotal()
});


function calculateTotal() {

    let totalPrice = 0;


    $('#order-list .product-quantity').each(function(index) {
        let price = parseFloat($(this).data('price'));
        let quantity =  $(this).val();

        totalPrice += price * quantity;

    });


    $('#total-price').val(totalPrice.toFixed(2));

    if(totalPrice > 0) {
        $('#add-order').attr('disabled', false);
    }else {
        $('#add-order').attr('disabled', true);

    }

}

$('body').on('input', '.product-quantity', function () {
    calculateTotal();
});

$('.display-products').on('click', function (e) {
    e.preventDefault();


    let url = $(this).data('url');
    let method = $(this).data('method');

    $.ajax({
        url: url,
        method: method,
        success: function(data) {
            $('#order-products').empty().append(data);
        }
    })
});


$('body').on('click', '#print-btn', function () {
    $('#print-header, #print-footer').printThis();
});
