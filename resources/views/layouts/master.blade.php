<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('layouts.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
       @include('layouts.main-navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
      @include('layouts.main-sidebar')

        <!-- Content Wrapper. Contains page content -->
       {{-- @include('layouts.content') --}}
        @yield('content')
        @include('partials._session')
        <!-- /.content-wrapper -->
       @include('layouts.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @include('layouts.footer-scripts')
    @stack('scripts')
    </body>

</html>
