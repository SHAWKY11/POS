@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">



    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endsection

@section('title')
    Edit Product
@endsection


@section('pagetitle1')
    Dashboard
@endsection

@section('pagetitle2')
    Products
@endsection
@section('pagetitle3')
    Edit product
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p> {{ '***********************************' . $error }}</p>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <script>
            new Noty({
                type: 'success',
                layout: 'topRight',
                text: "{{ session('success') }}",
                timeout: 2000,
                killer: true
            }).show();
        </script>
    @endif

    <form action="{{ route('products.update',$product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{ method_field('put') }}

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Edit product</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@yield('pagetitle1')</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">@yield('pagetitle2')</a></li>
                                <li class="breadcrumb-item active">@yield('pagetitle3')</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>

            <!-- Input addon -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Input Addon</h3>
                </div>

                <div class="card-body">
                    <div class="form-group mb-3">
                        <div class="input-group-prepend">
                            <label>Categories</label>
                            
                        </div>
                        <select name="category_id" class="form-control">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>   
                    </div>

            
                    <div class="form-group mb-3">
                        <label>Product Name</label>
                        <div class="input-group-prepend">
                        
                        <input type="text" name="name" class="form-control" placeholder="Name of product" value='{{$product->name}}'>
                       
                    </div>

                    <div class="form-group mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control ckeditor" >{{$product->description}}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group-prepend">
                            <label>Image</label>
                        </div>
                        <input type="file" name="image" class="form-control" id="imgInp" >
                    </div>

                    <div class="form-group">
                            <img src="{{$product->image_path}}"  style="width: 70px"  id="blah" class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group mb-3">
                        <div class="input-group-prepend">
                            <label>Purchase Price</label>
                        </div>
                        <input type="text" name="purchase_price" class="form-control" placeholder="Purchase price" value='{{$product->purchase_price}}'>
                    </div>

                    <div class="form-group mb-3">
                        <div class="form-group-prepend">
                            <label>Sale Price</label>
                        </div>
                        <input type="text" name="sale_price" class="form-control" placeholder="Sale price" value='{{$product->sale_price}}'>
                    </div>

                    <div class="form-group mb-3">
                        <div class="form-group-prepend">
                            <label>Stock</label>
                        </div>
                        <input type="text" name="stock" class="form-control" placeholder="Sale price" value='{{$product->stock}}'>
                    </div>


                    <div class="">

                        <button type="submit" class="btn btn-success swalDefaultSuccess">
                            create
                        </button>
                    </div>
                    
                </div>

            </div>
            <!-- /.row -->

            <!-- /input-group -->
        </div>
        <!-- /.card-body -->
        </div>
    </form>

@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->

    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        });


        $('.swalDefaultSuccess').click(function() {
            Swal.fire({
                title: "Good job!",
                text: "Updated Succesfully!",
                icon: "success"
            });
        })
    </script>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
@endsection
