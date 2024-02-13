@extends('layouts.master')
@section('title')
    Products
@endsection



@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endsection


@section('pagetitle1')
    Dashboard
@endsection


@section('pagetitle2')
    Products
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>products</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">@yield('pagetitle1')</a></li>
                            <li class="breadcrumb-item">@yield('pagetitle2')</a></li>

                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of products && Create products With Permissions</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <a href="{{ route('products.create') }}"> 
                        @can('create_product')
                            <i class=" btn btn-outline-primary btn-block mb-3"><i
                                class="fa fa-plus"></i>Add New product</i>
                        @elsecannot('create_product')
                        <i class=" btn btn-outline-primary btn-block mb-3 disabled"><i
                                class="fa fa-plus"></i>Add New product</i>
                        @endcan
                        
                        <thead>
                            <tr>
                                <th> # </th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>category</th>
                                <th>Image</th>
                                <th>purchase_price</th>
                                <th>sale_price</th>
                                <th>Profit %</th>
                                <th>stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($products as $product)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <th>{{ $i }}</th>
                                    <th>{{ $product->name }}</th>
                                    <th>{!! $product->description !!}</th>
                                    <th>{{ $product->category->name }}</th>
                                    <th><img src="{{ $product->image_path }}" style="width: 70px"  class="img-thumbnail" alt=""></th>
                                    <th>{{ $product->purchase_price }}</th>
                                    <th>{{ $product->sale_price }}</th>
                                    <th>{{ $product->profit_percent }} %</th>
                                    <th>{{ $product->stock }}</th>
                                    <th>
                                        @can('update_product')
                                            <a href="{{ route('products.edit', $product->id) }}"><i
                                                    class="btn btn-primary btn-sm">Edit</i></a>
                                        @elsecannot('update_product')
                                            <i class="btn btn-primary btn-sm disabled">Edit</i>
                        </a>
                    @endcan

                    @can('delete_product')
                        <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @elsecannot('delete_product')
                        <button type="submit" class="btn btn-danger btn-sm disabled">Delete</button>
                    @endcan
                    </th>
                    </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
    @endsection

    @section('scripts')
        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- DataTables  & Plugins -->
        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('dist/js/demo.js') }}"></script>
        <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
    @endsection
