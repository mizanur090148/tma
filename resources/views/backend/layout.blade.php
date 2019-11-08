<!doctype html>
<html class="no-js h-100" lang="en">
  <head>
    @include('backend.partials.styles')
    @yield('styles')
  </head>
  <body class="h-100">    
    <div class="container-fluid">
      <div class="row">
        <!-- Main Sidebar -->
        @include('backend.partials.left_menu')
        <!-- End Main Sidebar -->        
          @include('backend.partials.header')
          <!-- / .main-navbar -->
          <div class="main-content-container container-fluid px-4">
            <!-- PAGE START -->
            @yield('content')
            <!-- PAGE END -->           
          </div>
          @include('backend.partials.footer')
        </main>
      </div>
    </div>    
    
    @include('backend.partials.scripts')
    @yield('scripts')
    
  </body>
</html>