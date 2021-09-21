@include('layouts.partials.header')
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

        <!-- /top navigation -->

        <!-- page content -->
        @yield('content')
        @yield('scripts')
          <!-- /top tiles -->          
      </div>
        <!-- /page content -->

        <!-- footer content -->
    @include('layouts.partials.footer')
