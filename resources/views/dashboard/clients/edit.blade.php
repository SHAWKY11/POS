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
    Edit clients
@endsection


@section('pagetitle1')
    Dashboard
@endsection

@section('pagetitle2')
    clients
@endsection
@section('pagetitle3')
    Edit client
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p> {{ '***********************************' . $error }}</p>
            @endforeach
        </div>
    @endif


    <form action="{{ route('clients.update',$client->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">edit client</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@yield('pagetitle1')</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">@yield('pagetitle2')</a></li>
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
                        <input type="text" name="name" class="form-control" placeholder="Name_Of_client" value="{{$client->name}}" >
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+</span>
                        </div>
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number"  value="{{$client->phone}}">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">#</span>
                        </div>
                        <input type="text" name="address" class="form-control" placeholder="Address"  value="{{$client->address}}">
                    </div>


                    <div class="">
                        {{-- <button type="submit" class="btn mt-3 btn-success swalDefaultSuccess"><i class="fa fa-plus"></i>edit</button> --}}

                        <button type="submit" class="btn btn-success swalDefaultSuccess">
                            Update
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

    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- Page specific script -->

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
@endsection
