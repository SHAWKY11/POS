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
    Create Users
@endsection


@section('pagetitle1')
    Dashboard
@endsection

@section('pagetitle2')
    Users
@endsection
@section('pagetitle3')
    Create User
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

    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">create user</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@yield('pagetitle1')</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">@yield('pagetitle2')</a></li>
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
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" name="first_name" class="form-control" placeholder="First_Name">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" name="last_name" class="form-control" placeholder="Last_name">
                    </div>



                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>


                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope image"></i></span>
                        </div>
                        <input type="file" name="image" class="form-control" id="imgInp">
                    </div>

                    <div class="form-group">
                            <img src="{{ asset('uploads/user_images/default.png') }}"  style="width: 70px"  id="blah" class="img-thumbnail image-preview" alt="">
                        </div>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                        </div>
                    </div>

                    <!-- Custom Tabs -->
                    <div class="card mt-3">
                        <div class="card-header d-flex p-0">
                            <h3 class="card-title p-3">Permissions</h3>
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#users" data-toggle="tab">Users</a>
                                </li>

                                <li class="nav-item"><a class="nav-link" href="#categories" data-toggle="tab">Categories</a>
                                </li>
                                <li class="nav-item dropdown">

                                    <li class="nav-item"><a class="nav-link" href="#products" data-toggle="tab">Products</a>
                                </li>
                                <li class="nav-item dropdown">

                                    <li class="nav-item"><a class="nav-link" href="#clients" data-toggle="tab">Clients</a>
                                </li>
                                <li class="nav-item dropdown">
                            <li class="nav-item"><a class="nav-link" href="#orders" data-toggle="tab">Orders</a>

                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="users">
                                    <label><input type="checkbox" name="roles_name[]" value="create">Create</label>
                                    <label><input type="checkbox" name="roles_name[]" value="read">Read</label>
                                    <label><input type="checkbox" name="roles_name[]" value="update">Update</label>
                                    <label><input type="checkbox" name="roles_name[]" value="delete">Delete</label>
                                </div>

                                <div class="tab-pane" id="categories">
                                    <label><input type="checkbox" name="roles_name[]" value="create_category">Create</label>
                                    <label><input type="checkbox" name="roles_name[]" value="read_category">Read</label>
                                    <label><input type="checkbox" name="roles_name[]" value="update_category">Update</label>
                                    <label><input type="checkbox" name="roles_name[]" value="delete_category">Delete</label>
                                </div>

                                <div class="tab-pane" id="products">
                                    <label><input type="checkbox" name="roles_name[]" value="create_product">Create</label>
                                    <label><input type="checkbox" name="roles_name[]" value="read_product">Read</label>
                                    <label><input type="checkbox" name="roles_name[]" value="update_product">Update</label>
                                    <label><input type="checkbox" name="roles_name[]" value="delete_product">Delete</label>
                                </div>

                                <div class="tab-pane" id="clients">
                                    <label><input type="checkbox" name="roles_name[]" value="create_client">Create</label>
                                    <label><input type="checkbox" name="roles_name[]" value="read_client">Read</label>
                                    <label><input type="checkbox" name="roles_name[]" value="update_client">Update</label>
                                    <label><input type="checkbox" name="roles_name[]" value="delete_client">Delete</label>
                                </div>

                                <div class="tab-pane" id="orders">
                                    <label><input type="checkbox" name="roles_name[]" value="create_order">Create</label>
                                    <label><input type="checkbox" name="roles_name[]" value="read_order">Read</label>
                                    <label><input type="checkbox" name="roles_name[]" value="update_order">Update</label>
                                    <label><input type="checkbox" name="roles_name[]" value="delete_order">Delete</label>
                                </div>
                                <!-- /.tab-pane -->

                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- ./card -->

                    <div class="">
                        {{-- <button type="submit" class="btn mt-3 btn-success swalDefaultSuccess"><i class="fa fa-plus"></i>Create</button> --}}

                        <button type="submit" class="btn btn-success swalDefaultSuccess">
                            create
                        </button>
                    </div>




                    <!-- /input-group -->
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
