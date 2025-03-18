@extends('Website.layouts.layout')
@section('content')
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ url('/') }}" class="link">Home</a></li>
                    <li class="item-link"><span>Cart</span></li>
                </ul>
            </div>
            <div class="main-content-area">
                @if(session('cart'))
                @php
                    $totalPrice = 0;
                @endphp
                @foreach(session('cart') as $id => $details)
                <div class="wrap-iten-in-cart">
                    <h3 class="box-title">Products Name</h3>
                    <ul class="products-cart">
                        <li class="pr-cart-item">
                            <div class="product-image">
                                <figure><img src="{{ $details['ImageURL'] }}" alt=""></figure>
                            </div>
                            <div class="product-name">
                                <a class="link-to-product" href="#">{{ $details['ProductName'] }}</a>
                            </div>
                            <div class="price-field produtc-price"><p class="price">${{ number_format($details['Price'], 2) }}</p></div>
                            <div class="quantity">
                                <div class="quantity-input">
                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" data-id="{{ $id }}" class="quantity-update">
                                </div>
                            </div>
                            <div class="price-field sub-total"><p class="price">${{ number_format($details['Price'] * $details['quantity'], 2) }}</p></div>
                            <div class="delete">
                                <a href="{{ route('remove_from_cart', $id) }}" class="btn btn-delete" title="">
                                    <span>Delete from your cart</span>
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                @php
                    $totalPrice += $details['Price'] * $details['quantity'];
                @endphp
                @endforeach
                @endif

                <div class="summary">
                    <div class="order-summary">
                        <h4 class="title-box">Order Summary</h4>
                        <p class="summary-info"><span class="title">Subtotal</span><b class="index" id="subtotal">${{ number_format($totalPrice, 2) }}</b></p>
                        <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
                        <p class="summary-info total-info "><span class="title">Total</span><b class="index" id="total">${{ number_format($totalPrice, 2) }}</b></p>
                    </div>
                    <div class="checkout-info">
                        <label class="checkbox-field">
                            <input class="frm-input " name="have-code" id="have-code" value="" type="checkbox"><span>I have promo code</span>
                        </label>
                        <a class="btn btn-checkout" href="{{ url('checkout') }}">Check out</a>
                        <a class="link-to-shop" href="{{ url('shop') }}">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                    </div>
                    <div class="update-clear">
                        <a class="btn btn-clear" href="{{ route('remove_from_cart') }}">Clear Shopping Cart</a>
                        <a class="btn btn-update" href="#">Update Shopping Cart</a>
                    </div>
                </div>
            </div><!--end main content area-->
        </div><!--end container-->

    </main>
    <!--main area-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
    let timeout = null;

    $(".quantity-update").on("input", function () {
        clearTimeout(timeout);

        let input = $(this);
        let quantity = parseInt(input.val());
        let id = input.data('id');


        let priceText = input.closest(".pr-cart-item").find(".produtc-price .price").text().replace("$", "").replace(",", "");
        let price = parseFloat(priceText);


        if (isNaN(quantity) || quantity < 1) {
            input.val(1);
            quantity = 1;
        }

        let newSubtotal = quantity * price;
        input.closest(".pr-cart-item").find(".sub-total .price").text("$" + newSubtotal.toFixed(2));

        let totalPrice = 0;
        $(".sub-total .price").each(function () {
            totalPrice += parseFloat($(this).text().replace("$", "").replace(",", ""));
        });

        $("#subtotal").text("$" + totalPrice.toFixed(2));
        $("#total").text("$" + totalPrice.toFixed(2));


        timeout = setTimeout(function () {
            $.ajax({
                url: '{{ route("update_cart") }}',
                method: 'patch',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    quantity: quantity
                },
                success: function (response) {
                    console.log(response);
                }
            });
        }, 500);
    });
});

    </script>


@endsection
