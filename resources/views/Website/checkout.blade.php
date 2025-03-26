@extends('website.layouts.layout')
@section('content')
    <!-- Main Area -->
    <main id="main" class="main-site">
        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ url('/') }}" class="link">Home</a></li>
                    <li class="item-link"><span>Checkout</span></li>
                </ul>
            </div>

            <div class="main-content-area">
                <div class="wrap-address-billing">
                    <h3 class="box-title">Billing Address</h3>
                    <form action="{{ route('checkout.store') }}" method="post" name="frm-billing">
                        @csrf

                        <p class="row-in-form">
                            <label>First Name:</label>
                            <input type="text" value="{{ Auth::user()->FirstName }}" disabled>
                        </p>

                        <p class="row-in-form">
                            <label>Last Name:</label>
                            <input type="text" value="{{ Auth::user()->LastName }}" disabled>
                        </p>

                        <p class="row-in-form">
                            <label>Email:</label>
                            <input type="text" value="{{ Auth::user()->Email }}" disabled>
                        </p>

                        <p class="row-in-form">
                            <label>Phone Number:</label>
                            <input type="text" value="{{ Auth::user()->PhoneNumber }}" disabled>
                        </p>

                        <p class="row-in-form">
                            <label>Address:</label>
                            <input type="text" name="UserAddress" value="{{ Auth::user()->Address }}" disabled>
                        </p>

                        <p class="row-in-form">
                            <label for="city">City:</label>
                            <select id="city" name="CityID" class="form-control" required>
                                <option value="">-- Select City --</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->ProvinceID }}" data-price="{{ $city->Price }}">
                                        {{ $city->City }} - ${{ number_format($city->Price, 2) }}
                                    </option>
                                @endforeach
                            </select>
                        </p>

                        <p class="row-in-form">
                            <a href="{{ route('profile.edit') }}" class="text-danger">Change Personal Data</a>
                        </p>
                </div>

                <div class="summary summary-checkout">
                    <div class="summary-item payment-method">
                        <h4 class="title-box">Payment Method</h4>

                        <label class="payment-method">
                            <input name="payment-method" value="bank" type="radio">
                            <span>Direct Bank Transfer</span>
                        </label>

                        <label class="payment-method">
                            <input name="payment-method" value="visa" type="radio">
                            <span>Visa</span>
                        </label>

                        <label class="payment-method">
                            <input name="payment-method" value="paypal" type="radio">
                            <span>Paypal</span>
                        </label>

                        <p class="summary-info grand-total">
                            <span>Grand Total</span>
                            <span class="grand-total-price" id="grand-total">${{ number_format($cartTotal, 2) }}</span>
                        </p>

                        <button type="submit" class="btn btn-medium">Place Order Now</button>
                    </form>
                    </div>

                    <!-- Coupon Form -->
                    <div class="summary-item shipping-method">
                        <h4 class="title-box">Shipping</h4>
                        <p class="summary-info"><span>Flat Rate</span></p>
                        <p class="summary-info"><span id="shipping-cost">Select a city to calculate shipping</span></p>

                        <h4 class="title-box">Apply Coupon</h4>
                        <form id="apply-coupon-form">
                            <p class="row-in-form">
                                <label>Coupon Code:</label>
                                <input id="coupon-code" type="text" name="coupon_code" placeholder="Enter Code">
                            </p>
                            <button type="submit" class="btn btn-small">Apply</button>
                            <p id="coupon-message" style="color: red; display: none;"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Handle City Selection for Shipping Cost Calculation
            $("#city").on("change", function () {
                let shippingPrice = parseFloat($(this).find(':selected').data("price")) || 0;
                $("#shipping-cost").text("Shipping Cost: $" + shippingPrice.toFixed(2));

                let cartTotal = parseFloat('{{ $cartTotal }}');
                let newTotal = cartTotal + shippingPrice;
                $("#grand-total").text("$" + newTotal.toFixed(2));
            });

            // Handle Coupon Application
            $("#apply-coupon-form").on("submit", function (e) {
                e.preventDefault();
                let couponCode = $("#coupon-code").val();

                $.ajax({
                    url: "{{ route('apply_coupon') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        coupon_code: couponCode
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            $("#coupon-message").css("color", "green").text("Coupon Applied!").show();
                            let discount = parseFloat(response.discount);
                            let newTotal = parseFloat($("#grand-total").text().replace("$", "")) - discount;
                            $("#grand-total").text("$" + newTotal.toFixed(2));
                        } else {
                            $("#coupon-message").css("color", "red").text(response.message).show();
                        }
                    },
                    error: function () {
                        $("#coupon-message").css("color", "red").text("An error occurred. Please try again.").show();
                    }
                });
            });
        });
    </script>
@endsection
