<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN: Head -->
    @include('subadmin.layout.header')
    <!-- END: Head -->
    <body> 
    @include('subadmin.layout.menu')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
            <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
        </header>
        <!-- BEGIN: Content -->
            @section('content')       
            @show
        <!-- END: Content --> 
    </div>
    @include('subadmin.layout.footer')
    </body>
</html>