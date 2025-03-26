@extends('Website.layouts.layout')
@section('content')
<main id="main">
		<div class="container">

			<!--MAIN SLIDE-->
			<div class="wrap-main-slide">
				<div class="slide-carousel owl-carousel style-nav-1" data-items="1" data-loop="1" data-nav="true" data-dots="false">
					<div class="item-slide">
						<img src="assets/images/main-slider-1-1.jpg" alt="" class="img-slide">
						<div class="slide-info slide-1">
                            @foreach ($t_products as $p )
							<h2 class="f-title">Kid Smart <b>Watches</b></h2>
							<span class="subtitle">{{$p->ProductName}}.</span>
							<p class="sale-info">Only price: <span class="price">${{$p->Price}}</span></p>
							<a href="#" class="btn-link">Shop Now</a>
                            @endforeach

                        </div>
					</div>
					<div class="item-slide">
						<img src="assets/images/main-slider-1-2.jpg" alt="" class="img-slide">
						<div class="slide-info slide-2">
							<h2 class="f-title">Extra 25% Off</h2>
							<span class="f-subtitle">On online payments</span>
							<p class="discount-code">Use Code: #FA6868</p>
							<h4 class="s-title">Get Free</h4>
							<p class="s-subtitle">TRansparent Bra Straps</p>
						</div>
					</div>
					<div class="item-slide">
						<img src="assets/images/main-slider-1-3.jpg" alt="" class="img-slide">
						<div class="slide-info slide-3">
							<h2 class="f-title">Great Range of <b>Exclusive Furniture Packages</b></h2>
							<span class="f-subtitle">Exclusive Furniture Packages to Suit every need.</span>
							<p class="sale-info">Stating at: <b class="price">$225.00</b></p>
							<a href="#" class="btn-link">Shop Now</a>
						</div>
					</div>
				</div>
			</div>

			<!--BANNER-->
			<div class="wrap-banner style-twin-default">
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="assets/images/home-1-banner-1.jpg" alt="" width="580" height="190"></figure>
					</a>
				</div>
				<div class="banner-item">
					<a href="#" class="link-banner banner-effect-1">
						<figure><img src="assets/images/home-1-banner-2.jpg" alt="" width="580" height="190"></figure>
					</a>
				</div>
			</div>

			<!--On Sale-->
			<div class="wrap-show-advance-info-box style-1 has-countdown">
				<h3 class="title-box">On Sale</h3>
				<div class="wrap-countdown mercado-countdown" data-expire="2020/12/12 12:34:56"></div>
				<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container " data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>


                    @foreach ($products as $p )
					<div class="product product-style-2 equal-elem ">
						<div class="product-thumnail">
							<a href="{{route('front.product.show', $p->ProductID)}}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
								<figure><img src="{{$p->ImageURL}}" width="800" height="800" alt=""></figure>
							</a>
							<div class="group-flash">
								<span class="flash-item sale-label">sale</span>
							</div>
							<div class="wrap-btn">
								<a href="#" class="function-link">quick view</a>
							</div>
						</div>
						<div class="product-info">
							<a href="#" class="product-name"><span>{{$p->ProductName}} [White]</span></a>
							<div class="wrap-price"><ins><p class="product-price">${{number_format($p->Price , 2)}}</p></ins>
                                <del><p class="product-price">${{ number_format($p->Price + 1400, 2) }}</p></del>
                            </div>
						</div>
					</div>
                    @endforeach



				</div>
			</div>

			<!--Latest Products-->
			<div class="wrap-show-advance-info-box style-1">
				<h3 class="title-box">Latest Products</h3>
				<div class="wrap-top-banner">
					<a href="#" class="link-banner banner-effect-2">
						<figure><img src="assets/images/digital-electronic-banner.jpg" width="1170" height="240" alt=""></figure>
					</a>
				</div>
				<div class="wrap-products">
					<div class="wrap-product-tab tab-style-1">
						<div class="tab-contents">
							<div class="tab-content-item active" id="digital_1a">
								<div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}' >

                                    @foreach ($products as $p )
									<div class="product product-style-2 equal-elem ">
										<div class="product-thumnail">
											<a href="{{route('front.product.show', $p->ProductID)}}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
												<figure><img src="{{$p->ImageURL}}" width="800" height="800" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
											</a>
											<div class="group-flash">
												<span class="flash-item new-label">new</span>
											</div>
											<div class="wrap-btn">
												<a href="#" class="function-link">quick view</a>
											</div>
										</div>
										<div class="product-info">
											<a href="#" class="product-name"><span>{{$p->ProductName}} [White]</span></a>
											<div class="wrap-price"><span class="product-price">${{$p->Price}}</span></div>
										</div>
									</div>
                                    @endforeach


								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		<!-- Product Categories -->
<div class="wrap-show-advance-info-box style-1">
    <h3 class="title-box">Product Categories</h3>

    <!-- Top Banner -->
    <div class="wrap-top-banner">
        <a href="#" class="link-banner banner-effect-2">
            <figure><img src="{{ asset('assets/images/fashion-accesories-banner.jpg') }}" width="1170" height="240" alt=""></figure>
        </a>
    </div>

    <div class="wrap-products">
        <div class="wrap-product-tab tab-style-1">
            <!-- Tab Control -->
            <div class="tab-control">
                @foreach ($categories as $index => $category)
                    <a href="#category_{{ $category->id }}"
                       class="tab-control-item {{ $index === 0 ? 'active' : '' }}">
                        {{ $category->CategoryName }}
                    </a>
                @endforeach
            </div>

            <!-- Tab Contents -->
            <div class="tab-contents">
                @foreach ($categories as $index => $category)
                    <div class="tab-content-item {{ $index === 0 ? 'active' : '' }}" id="category_{{ $category->id }}">
                        <div class="wrap-products slide-carousel owl-carousel style-nav-1 equal-container"
                             data-items="5" data-loop="false" data-nav="true" data-dots="false"
                             data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"4"},"1200":{"items":"5"}}'>

                            @foreach ($category->products as $product)
                                <div class="product product-style-2 equal-elem">
                                    <div class="product-thumnail">
                                        <a href="{{route('front.product.show', $product->ProductID)}}" title="{{ $product->ProductName }}">
                                            <figure>
                                                <img src="{{ asset($product->ImageURL) }}" width="800" height="800" alt="{{ $product->ProductName }}">
                                            </figure>
                                        </a>
                                        <div class="group-flash">
                                            @if($product->isNew)
                                                <span class="flash-item new-label">New</span>
                                            @endif
                                            @if($product->isOnSale)
                                                <span class="flash-item sale-label">Sale</span>
                                            @endif
                                            @if($product->isBestseller)
                                                <span class="flash-item bestseller-label">Bestseller</span>
                                            @endif
                                        </div>
                                        <div class="wrap-btn">
                                            <a href="#" class="function-link">Quick View</a>
                                        </div>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="product-name"><span>{{ $product->ProductName }}</span></a>
                                        <div class="wrap-price">
                                            @if($product->isOnSale)
                                                <ins><p class="product-price">${{ number_format($product->SalePrice, 2) }}</p></ins>
                                                <del><p class="product-price">${{ number_format($product->Price, 2) }}</p></del>
                                            @else
                                                <span class="product-price">${{ number_format($product->Price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- jQuery for Active Tab Handling -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(".tab-control-item").click(function (e) {
            e.preventDefault();

            $(".tab-control-item").removeClass("active");
            $(this).addClass("active");

            $(".tab-content-item").removeClass("active");
            $($(this).attr("href")).addClass("active");
        });
    });
</script>


</div>

		</div>

	</main>


@endsection
