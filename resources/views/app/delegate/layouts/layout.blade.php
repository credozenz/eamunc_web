<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN: Head -->
    @include('app.delegate.layouts.header')
    <!-- END: Head -->
   
        @if($routeGroup =='delegate_dashbord')  
        <body class="" id="page-top">
        <div class="">
        @else
        <body class="fixed-nav sticky-footer bg-primary theme-dashboard" id="page-top">
        @include('app.delegate.layouts.menu')
        <div class="content-wrapper">
        @endif
        
            <!-- BEGIN: Content -->
                @section('content')       
                @show
            <!-- END: Content --> 
        </div>
        @include('app.delegate.layouts.footer')
    </body>
</html>