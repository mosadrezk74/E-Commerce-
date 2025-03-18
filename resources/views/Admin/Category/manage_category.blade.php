@extends('Admin.layout')
@section('page_title', 'Manage Category')
@section('container')
    <h1 class="mb10">Manage Category</h1>
    <a href="{{ route('admin.category.index') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>
    <div class="row m-t-30">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.category.update', $category->CategoryID) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="category_name" class="control-label mb-1">Category Name</label>
                                            <input name="CategoryName" value="{{ old('CategoryName', $category->CategoryName) }}" class="form-control" required>
                                            @error('CategoryName')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Description" class="control-label mb-1">Category Description</label>
                                            <input name="Description" value="{{ old('Description', $category->Description) }}" class="form-control">
                                            @error('Description')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-lg btn-info btn-block">
                                            Submit
                                        </button>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $category->id }}" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
