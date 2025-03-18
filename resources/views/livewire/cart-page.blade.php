<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{url('/')}}" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Your Cart
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($cartCount > 0)
                                        @foreach($cart as $ProductID => $details)
                                            <tr>
                                                <td><img src="{{ $details['ImageURL'] }}" alt="صورة المنتج" style="width: 50px;"></td>
                                                <td>{{ $details['ProductName'] }}</td>
                                                <td>{{ $details['Price'] }} </td>
                                                <td>{{ $details['quantity'] }}</td>
                                                <td>{{ $details['Price'] * $details['quantity'] }}</td>
                                                <td>
                                                    <button wire:click="removeFromCart('{{ $ProductID }}')">❌ حذف</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">لا يوجد منتجات في السلة</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        @if($cartCount > 0)
                            <div class="col-12 text-end">
                                {{-- <a href="{{ route('clear_cart') }}" class="text-muted">
                                    <i class="fi-rs-cross-small"></i> Clear Cart
                                </a> --}}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="city">Select City:</label>
                            <select wire:model="selectedCity" class="form-control">
                                <option value="">-- Choose City --</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->City }} - ${{ number_format($city->Price, 2) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <table class="table">
                                <tr>
                                    <td>Cart Subtotal</td>
                                    <td>${{ number_format($totalPrice, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>${{ number_format($shipping, 2) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total</strong></td>
                                    <td><strong>${{ number_format($totalWithShipping, 2) }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
