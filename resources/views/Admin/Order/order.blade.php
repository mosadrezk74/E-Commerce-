@extends('Admin.layout')
@section('page_title', 'Order')
@section('Orde_select', 'active')
@section('container')

    <h1 class="mb10">Order</h1>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Customer Details</th>
                            <th>Amount</th>
                            <th>Order Status</th>
                            <th>Payment Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->OrderDate }}</td>
                                <td>{{ $order->user->FirstName }}<br>
                                    {{ $order->user->Email }}<br>
                                    {{ $order->user->PhoneNumber }}<br>
                                    {{-- {{ $order->user->Address }}<br> --}}
                                </td>
                                <td>{{ $order->TotalAmount }}</td>
                                <td>
                                    @if ($order->Status == 0)
                                        <button type="button" class="btn btn-warning">Pending</button>
                                    @elseif($order->Status == 1)
                                        <button type="button" class="btn btn-info">On the Way</button>
                                    @elseif ($order->Status == 2)
                                        <button type="button" class="btn btn-success">Delivered</button>
                                    @endif

                                </td>
                                <td>
                                    @if ($order->Pay_Status == 1)
                                        <button type="button" class="btn btn-success">Success</button>
                                    @elseif($order->Pay_Status == 0)
                                        <button type="button" class="btn btn-warning">Pending</button>
                                    @else
                                        <button type="button" class="btn btn-danger">Failed</button>
                                    @endif

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>

@endsection
