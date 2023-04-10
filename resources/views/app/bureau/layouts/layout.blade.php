<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN: Head -->
    @include('app.bureau.layouts.header')
    <!-- END: Head -->
    <body class="fixed-nav sticky-footer bg-primary theme-dashboard" id="page-top">
        @if($routeGroup =='bureau_general_assembly')
        <body class="" id="page-top">
        <div class="">
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
    </body>
</html>