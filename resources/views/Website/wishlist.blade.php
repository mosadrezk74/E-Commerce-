@extends('Website.layouts.layout')
@section('content')
    <!--main area-->
    <main id="main" class="main-site">

        <div class="container">

            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ url('/') }}" class="link">Home</a></li>
                    <li class="item-link"><span>Wishlist</span></li>
                </ul>
            </div>
            <div class="main-content-area">
                @if(session('cart'))
                @php
                    $totalPrice = 0;
                @endphp
                @foreach(session('wishlist') as $id => $details)
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

                             <div class="delete">
                                <a href="{{ route('remove_from_cart', $id) }}" class="btn btn-delete" title="">
                                    <span>Delete from your cart</span>
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>

                @endforeach
                @endif


            </div><!--end main content area-->
        </div><!--end container-->

    </main>
    <!--main area-->




@endsection
