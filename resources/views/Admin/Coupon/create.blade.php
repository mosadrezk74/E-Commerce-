@extends('Admin.layout')
@section('page_title', 'Create Coupon')
@section('container')

    <h1 class="mb10">Create Coupon</h1>
    <a href="{{ route('admin.coupon.index') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>

    <div class="row m-t-30">
        <div class="col-lg-12">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif


            <div class="card">
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('admin.coupon.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group has-success">
                                <label for="Code" class="control-label lg-12">Code</label>
                                <input name="Code" type="text" class="form-control" value="{{ old('Code') }}" required>
                                @error('Code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group has-success">
                                <label for="DiscountValue" class="control-label lg-12">Discount Value</label>
                                <input name="DiscountValue" type="number" step="0.01" class="form-control" value="{{ old('DiscountValue') }}" required>
                                @error('DiscountValue')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group has-success">
                                <label for="ValidFrom" class="control-label lg-12">Valid From</label>
                                <input name="ValidFrom" type="datetime-local" class="form-control" value="{{ old('ValidFrom') }}" required>
                                @error('ValidFrom')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group has-success">
                                <label for="ValidTo" class="control-label lg-12">Valid To</label>
                                <input name="ValidTo" type="datetime-local" class="form-control" value="{{ old('ValidTo') }}" required>
                                @error('ValidTo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group has-success">
                                <label for="MaxUsage" class="control-label lg-12">Max Usage</label>
                                <input name="MaxUsage" type="number" class="form-control" value="{{ old('MaxUsage') }}">
                                @error('MaxUsage')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group has-success">
                                <label for="IsActive" class="control-label lg-12">Is Active</label>
                                <select id="IsActive" name="IsActive" class="form-control">
                                    <option value="1" {{ old('IsActive', 1) == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('IsActive', 1) == 0 ? 'selected' : '' }}>No</option>
                                </select>
                                @error('IsActive')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-lg btn-info btn-block">Submit</button>
                        </div>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
@endsection
