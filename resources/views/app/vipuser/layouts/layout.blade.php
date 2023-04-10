<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN: Head -->
    @include('app.vipuser.layouts.header')
    <!-- END: Head -->
   
        @if($routeGroup =='vipuser_dashbord')  
        <body class="" id="page-top">
        <div class="">

        @else
        <body class="fixed-nav sticky-footer bg-primary theme-dashboard" id="page-top">

        @include('app.vipuser.layouts.menu')
        <div class="content-wrapper">
        @endif
        
            <!-- BEGIN: Content -->
                @section('content')       
                @show
            <!-- END: Content --> 
        </div>
        @include('app.vipuser.layouts.footer')
    </body>
</html>