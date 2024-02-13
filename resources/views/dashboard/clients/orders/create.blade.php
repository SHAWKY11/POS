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
    Create orders
@endsection


@section('pagetitle1')
    Dashboard
@endsection

@section('pagetitle2')
    orders
@endsection
@section('pagetitle3')
    Create order
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p> {{ '***********************************' . $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">create client</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@yield('pagetitle1')</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">@yield('pagetitle2')</a>
                            </li>
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
                <h3 class="card-title">Categories</h3>
            </div>
            <div class="card-body">
                {{-- <div class="input-group mb-3"> --}}
                {{-- <div class="box-body"> --}}

                @foreach ($categories as $category)
                    <div class="panel-group">

                        <div class="panel panel-info">

                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse"
                                        href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                                </h4>
                            </div>

                            <div id="{{ str_replace(' ', '-', $category->name) }}" class="panel-collapse collapse">

                                <div class="panel-body">

                                    @if ($category->product->count() > 0)
                                        <table class="table table-hover">
                                            <tr>
                                                <th>name</th>
                                                <th>stock</th>
                                                <th>price</th>
                                                <th>add</th>
                                            </tr>

                                            @foreach ($category->product as $productt)
                                                <tr>
                                                    <td>{{ $productt->name }}</td>
                                                    <td>{{ $productt->stock }}</td>
                                                    <td>{{ number_format($productt->sale_price, 2) }}</td>
                                                    <td>
                                                        <a href="" id="product-{{ $productt->id }}"
                                                            data-name="{{ $productt->name }}"
                                                            data-id="{{ $productt->id }}"
                                                            data-price="{{ $productt->sale_price }}"
                                                            class="btn btn-success btn-sm add-product-btn">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </table><!-- end of table -->
                                    @else
                                        <h5>no_records</h5>
                                    @endif

                                </div><!-- end of panel body -->

                            </div><!-- end of panel collapse -->

                        </div><!-- end of panel primary -->

                    </div><!-- end of panel group -->
                @endforeach

                {{-- </div><!-- end of box body --> --}}
                {{-- </div> --}}



            </div>

        </div>
        <!-- /.row -->
        <!-- /input-group -->

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">orders</h3>
                </div>
                <div class="card-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <form action="{{ route('clients.orders.store', $client->id) }}" method="post">

                            {{ csrf_field() }}
                            {{ method_field('post') }}
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>product</th>
                                        <th>quantity</th>
                                        <th>price</th>
                                    </tr>
                                </thead>

                                <tbody class="order-list">


                                </tbody>

                            </table><!-- end of table -->

                            <h4>total : <span class="total-price">0</span></h4>

                            <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i
                                    class="fa fa-plus"></i>
                                add_order</button>

                        </form>
                    </div>

                    @if ($client->orders->count() > 0)
                        <div class="box box-primary">

                            <div class="box-header">

                                {{-- <h3 class="box-title" style="margin-bottom: 10px">previous_orders
                                    <small>{{ $orders->total() }}</small>
                                </h3> --}}

                            </div><!-- end of box header -->

                            <div class="box-body">

                                @foreach ($orders as $order)
                                    <div class="panel-group">

                                        <div class="panel panel-success">
                                            <div id="{{ $order->created_at->format('d-m-Y-s') }}"
                                                class="panel-collapse collapse">

                                                <div class="panel-body">

                                                    <ul class="list-group">
                                                        @foreach ($order->products as $product)
                                                            <li class="list-group-item">{{ $product->name }}</li>
                                                        @endforeach
                                                    </ul>

                                                </div><!-- end of panel body -->

                                            </div>

                                        </div><!-- end of panel collapse -->

                                    </div><!-- end of panel primary -->

                            </div><!-- end of panel group -->
                    @endforeach

                    {{-- {{ $orders->links() }} --}}
                    @endif
                

            
        </div><!-- end of row -->
   
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
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
                text: "Created Succesfully!",
                icon: "success",
                timer: 3000
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
