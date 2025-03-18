@extends('Admin.layout')
@section('page_title', 'Manage Product')
@section('Product_select', 'active')
@section('container')
    <h1 class="mb10">Manage Product</h1>
    <a href="{{ url('admin/product/') }}">
        <button type="button" class="btn btn-success">Back
        </button>
    </a>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <div class="row m-t-30">
        <div class="col-md-12">
            <form action="{{ route('admin.product.store') }}" method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="ProductName" class="control-label mb-1">Product Name</label>
                                            <input id="ProductName" name="ProductName" type="text" class="form-control" required>
                                            @error('ProductName')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="ImageURL" class="control-label mb-1">Product Image URL</label>
                                            <input id="ImageURL" name="ImageURL" type="url" class="form-control">
                                            @error('ImageURL')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label for="Price" class="control-label mb-1">Price</label>
                                            <input id="Price" name="Price" type="number" step="0.01" class="form-control" required>
                                            @error('Price')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="SKU" class="control-label mb-1"><b>
                                                SKU</b>
                                            </label>
                                            <input id="SKU"  name="SKU" type="text"
                                                   class="form-control" aria-required="true"
                                                   aria-invalid="false" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Description" class="control-label mb-1"><b>Description</b></label>
                                            <input id="Description"  name="Description" type="text"
                                                   class="form-control" aria-required="true"
                                                   aria-invalid="false" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="CategoryID" class="control-label mb-1">Product Category</label>
                                            <select id="CategoryID" name="CategoryID" class="form-control" required>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->CategoryID }}">{{ $cat->CategoryName }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="SupplierID" class="control-label mb-1">Supplier</label>
                                            <select id="SupplierID" name="SupplierID" class="form-control">
                                                <option value="">Select Supplier</option>
                                                @foreach ($suppliers as $sup)
                                                    <option value="{{ $sup->SupplierID }}">{{ $sup->SupplierName }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="StockQuantity" class="control-label mb-1">Stock Quantity</label>
                                            <input id="StockQuantity" name="StockQuantity" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="IsActive" class="control-label mb-1">Is Active</label>
                                            <select id="IsActive" name="IsActive" class="form-control">
                                                <option value="0" selected>No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="IsTrending" class="control-label mb-1">Is Trending</label>
                                            <select id="IsTrending" name="IsTrending" class="form-control">
                                                <option value="0" selected>No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="IsFeatured" class="control-label mb-1">Is Featured</label>
                                            <select id="IsFeatured" name="IsFeatured" class="form-control">
                                                <option value="0" selected>No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-lg btn-info btn-block">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
