<!DOCTYPE html>
<html>
<head>
    @include('includes._head')

    @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('includes._navbar')


        @include('includes._sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

          @include('includes._content-header')

          <!-- Main content -->
          <section class="content">
            <div class="`container-fluid">
                @yield('content')
            </div>
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('includes._footer')
    </div>
    <!-- ./wrapper -->


    @include('includes._scripts')

    @yield('script')
</body>
</html>
