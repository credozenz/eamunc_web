<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN: Head -->
    @include('app.bureau.layouts.header')
    <!-- END: Head -->
   
        @if($routeGroup =='bureau_dashbord')
        <body class="fixed-nav sticky-footer bg-primary theme-dashboard" id="page-top">
        <div class="main-dasboard">
        @else
        <body class="fixed-nav sticky-footer bg-primary theme-dashboard" id="page-top">
        @include('app.bureau.layouts.menu')
        <div class="content-wrapper">
        @endif
        
            <!-- BEGIN: Content -->
                @section('content')       
                @show
            <!-- END: Content --> 
        </div>
        @include('app.bureau.layouts.footer')

        @yield('script')
    </body>
</html>

