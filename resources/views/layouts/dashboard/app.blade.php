<!DOCTYPE html>
<html>
<head>
    @include('includes.dashboard._head')

    @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('includes.dashboard._navbar')


        @include('includes.dashboard._sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

          @include('includes.dashboard._content-header')

          <!-- Main content -->
          <section class="content">
            <div class="`container-fluid">
                @yield('content')
            </div>
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('includes.dashboard._footer')
    </div>
    <!-- ./wrapper -->


    @include('includes.dashboard._scripts')

    @yield('script')
</body>
</html>
