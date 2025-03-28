@extends('Admin.layout')
@section('page_title', 'Customer Details')
@section('Customer_select', 'active')
@section('container')

    <h1 class="mb10">Show {{$user_data->FirstName}} Data </h1>

    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="table-responsive m-b-40">

                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">{{ $user_data->FirstName }} {{$user_data->LastName}}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Address</th>
                            <th scope="col">{{ $user_data->Address }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">{{ $user_data->PhoneNumber }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Country</th>
                            <th scope="col">Egypt - مصر</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Gender</th>
                            <th scope="col">{{ Arr::random(['Male - ذكر', 'Female - انثى']) }}</th>

                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Email</th>
                            <th scope="col">{{ $user_data->Email  }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Password</th>
                            <th scope="col">{{ $user_data->PasswordHash }}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Created at</th>
                            <th scope="col">
                                {{\Carbon\Carbon::parse($user_data->created_at)->format('Y-m-d h:i:s:A') }}
                            </th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Updated at</th>
                            <th scope="col">
                                {{\Carbon\Carbon::parse($user_data->updated_at)->format('Y-m-d h:i:s:A') }}
                            </th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

@endsection
