<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN: Head -->
    @include('app.bureau.layouts.header')
    <!-- END: Head -->
    <body class="fixed-nav sticky-footer bg-primary theme-dashboard" id="page-top">
        @include('app.bureau.layouts.menu')
        <div class="content-wrapper">
            <!-- BEGIN: Content -->
                @section('content')       
                @show
            <!-- END: Content --> 
        </div>
        @include('app.bureau.layouts.footer')
    </body>
</html>