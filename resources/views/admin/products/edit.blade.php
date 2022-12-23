@extends('layouts.admin')

@section('page_title','Products')

@section('content')
    <form class="form" method="POST" action="{{route('products.update')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$product->id}}">
        <div class="container-fluid">
            <div class="alert alert-custom alert-white alert-shadow fade show gutter-b" role="alert">
                <div class="alert-icon">
                    <span class="svg-icon svg-icon-xl">
                        <i class="fab fa-blogger"></i>
                    </span>
                </div>
                <div class="alert-text">
                    Update
                    <span class="font-weight-bolder mb-4 text-hover-state-dark">
                         {{$product->name}}
                    </span>
                     Product
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="fab fa-blogger"></i>
                                </span>
                                <h3 class="card-label">
                                    <span class="font-weight-bolder mb-4 text-hover-state-dark">
                                        Main Image
                                    </span>
                                </h3>
                            </div>
                        </div>
                        <div class="card-body row col col-md-12">
                            <div class="col-md-4">
                                <div class="image-input image-input-outline image-input-circle" id="kt_image_1" >
                                    <div class="image-input-wrapper" style="background-image: url({{$product->main_image}})"></div>
                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="main_image" accept=".png, .jpg, .jpeg" />
                                    </label>
                                    @error("image")
                                        <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                    <div class="col-md-12">
                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="card-icon">
                                        <i class="fas fa-users"></i>
                                    </span>
                                    <h3 class="card-label">
                                        <span class="font-weight-bolder mb-4 text-hover-state-dark">
                                            Product 
                                        </span>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body row">
                                <div class="form-group col-md-6">
                                    <label>Product Type</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <select class="form-control input-lg" id="kt_select2_1" name="product_type" required>
                                            <option value="">Choose Product Type</option>
                                            <option value="product">Product</option>
                                            <option value="service">Service</option>
                                            <option value="group_products">Group Products</option>
                                            <option value="codes">Codes</option>
                                            <option value="digital">Digital</option>
                                            <option value="food">Food</option>
                                            <option value="donating">Donating</option>
                                        </select>
                                        @error('name')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label>
                                        Name
                                    </label>
                                    <div class="input-group">
                                        <input type="text" name="name" required value="{{$product->name}}"  class="form-control @error('name') is-invalid @enderror" placeholder="Enter name Value" />
                                    </div>
                                    @error("name")
                                        <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label>
                                        Price
                                    </label>
                                    <div class="input-group">
                                        <input type="text" name="price" required  value="{{$product->price}}" class="form-control @error('price') is-invalid @enderror" placeholder="Enter price Value"/>
                                    </div>
                                    @error("price")
                                        <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label>
                                        Quantity
                                    </label>
                                    <div class="input-group">
                                        <input type="text" name="quantity" required   class="form-control @error('quantity') is-invalid @enderror" placeholder="Enter quantity Value" value="{{ $product->quantity }}" />
                                    </div>
                                    @error("quantity")
                                        <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-4">
                                    <label>
                                        SKU
                                    </label>
                                    <div class="input-group">
                                        <input type="text" name="sku" required value="{{$product->sku}}"  class="form-control @error('sku') is-invalid @enderror" placeholder="Enter sku Value"/>
                                    </div>
                                    @error("sku")
                                        <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label >
                                        Description
                                    </label>
                                    <div class="input-group">
                                        <textarea class="editor form-control @error('description')  is-invalid @enderror" id="editor" required name="description" id=""> {{ $product->description }}</textarea>
                                    </div>
                                    @error("description")
                                        <small class="form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-7">
                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection

