@extends('Admin.layout')
@section('page_title', 'Customer')
@section('Customer_select', 'active')
@section('container')
    @if (session()->has('message'))
        <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
            <span class="badge badge-pill badge-warning">Success</span>
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <h1 class="mb10">Customer</h1>

    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->

            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->UserID  }}</td>
                                <td>{{ $customer->FirstName }}</td>
                                <td>{{ $customer->LastName }}</td>
                                <td>{{ $customer->Email}}</td>


                                <td>
                                    @if ($customer->IsActive == 1)
                                        <a href="{{ url('admin/customer/status/0') }}/{{ $customer->UserID }}">
                                            <button type="button" class="btn btn-success">Active</button>
                                        </a>
                                    @elseif($customer->IsActive == 0)
                                        <a href="{{ url('admin/customer/status/1') }}/{{ $customer->UserID }}">
                                            <button type="button" class="btn btn-danger">De active</button>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.customer.show', $customer->UserID ) }}"> <i
                                            class="fas fa-eye"></i> </a>

                                    &nbsp; &nbsp;
                                    <a href="{{ route('admin.category.delete', $customer->UserID ) }}"> <i
                                            class="fas fa-trash"></i> </a>
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
