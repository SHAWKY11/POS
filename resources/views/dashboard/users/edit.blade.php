@extends('layouts.master')

@section('title')
    Edit Users
@endsection


@section('pagetitle1')
    Dashboard
@endsection

@section('pagetitle2')
    Users
@endsection
@section('pagetitle3')
    Edit User
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p> {{ '***********************************' . $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('user.update',$user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Edit user</h1>
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
                        <input type="text" name="first_name" class="form-control" placeholder="First_Name" value="{{$user->first_name}}">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" name="last_name" class="form-control" placeholder="Last_name" value="{{$user->last_name}}">
                    </div>



                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{$user->email}}">
                    </div>


                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="file" name="image" class="form-control" id="imgInp">
                    </div>

                     <div class="form-group">
                            <img src="{{ $user->image_path }}" style="width: 70px"  id="blah" class="img-thumbnail image-preview" alt="">
                        </div>

                    <!-- Custom Tabs -->
                    <div class="card mt-3">
                        <div class="card-header d-flex p-0">
                            <h3 class="card-title p-3">Permissions</h3>
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#users" data-toggle="tab">Users</a>
                                </li> 

                                <li class="nav-item"><a class="nav-link" href="#categories" data-toggle="tab">Categories</a></li>
                                <li class="nav-item dropdown">

                                    <li class="nav-item"><a class="nav-link" href="#categories" data-toggle="tab">Products</a></li>
                                <li class="nav-item dropdown">

                                    <li class="nav-item"><a class="nav-link" href="#categories" data-toggle="tab">Clients</a></li>
                                <li class="nav-item dropdown">

                                    <li class="nav-item"><a class="nav-link" href="#categories" data-toggle="tab">Orders</a></li>
                                <li class="nav-item dropdown">

                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="users">
                                    @foreach ($roles as $role )
                                        <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('create') ? 'checked' : '' }} value="create">Create</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('read') ? 'checked' : '' }} value="read">Read</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('update') ? 'checked' : '' }} value="update">Update</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('delete') ? 'checked' : '' }} value="delete">Delete</label>
                                    @endforeach
                                    
                                </div>

                                <div class="tab-pane" id="categories">
                                    @foreach ($roles as $role )
                                        <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('create_category') ? 'checked' : '' }} value="create_category">Create</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('read_category') ? 'checked' : '' }} value="read_category">Read</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('update_category') ? 'checked' : '' }} value="update_category">Update</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('delete_category') ? 'checked' : '' }} value="delete_category">Delete</label>
                                    @endforeach
                                </div>

                                <div class="tab-pane" id="products">
                                    @foreach ($roles as $role )
                                        <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('create_product') ? 'checked' : '' }} value="create_product">Create</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('read_product') ? 'checked' : '' }} value="read_product">Read</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('update_product') ? 'checked' : '' }} value="update_product">Update</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('delete_product') ? 'checked' : '' }} value="delete_product">Delete</label>
                                    @endforeach
                                </div>

                                <div class="tab-pane" id="clients">
                                    @foreach ($roles as $role )
                                        <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('create_client') ? 'checked' : '' }} value="create_client">Create</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('read_client') ? 'checked' : '' }} value="read_client">Read</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('update_client') ? 'checked' : '' }} value="update_client">Update</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('delete_client') ? 'checked' : '' }} value="delete_client">Delete</label>
                                    @endforeach
                                </div>


                                <div class="tab-pane" id="orders">
                                    @foreach ($roles as $role )
                                        <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('create_order') ? 'checked' : '' }} value="create_order">Create</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('read_order') ? 'checked' : '' }} value="read_order">Read</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('update_order') ? 'checked' : '' }} value="update_order">Update</label>
                                    <label><input type="checkbox" name="roles_name[]" {{ $user->hasPermissionTo('delete_order') ? 'checked' : '' }} value="delete_order">Delete</label>
                                    @endforeach
                                </div>
                                <!-- /.tab-pane -->

                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- ./card -->

                    <div class="">
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
@endsection
