<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    @include('admin.layout.header')
    <!-- END: Head -->
    <body class="main">

    @include('sweet::alert')

        <?php Session::forget('sweet_alert'); ?>
    <!-- BEGIN: Mobile Menu -->
    @include('admin.layout.mobileMenu')    
    <!-- END: Mobile Menu -->
   
    @include('admin.layout.headMenu')
    <div class="wrapper">
        <div class="wrapper-box">

        <!-- BEGIN: Side Menu -->
        @include('admin.layout.sideMenu')
        <!-- END: Side Menu -->

        <!-- BEGIN: Content -->
            @section('content')
            
            @show
        <!-- END: Content -->

        </div>
    </div>
    @include('admin.layout.footer')
    </body>
    

    
</html>