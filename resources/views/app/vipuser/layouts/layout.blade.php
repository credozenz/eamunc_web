<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN: Head -->
    @include('app.vipuser.layouts.header')
    <!-- END: Head -->
    <body class="fixed-nav sticky-footer bg-primary theme-dashboard" id="page-top">
        @include('app.vipuser.layouts.menu')
        <div class="content-wrapper">
            <!-- BEGIN: Content -->
                @section('content')       
                @show
            <!-- END: Content --> 
        </div>
        @include('app.vipuser.layouts.footer')
    </body>
</html>