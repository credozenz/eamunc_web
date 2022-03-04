<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN: Head -->
    @include('admin.layout.header')
    <!-- END: Head -->
    <body> 
    @include('admin.layout.menu')
    <div id="main">
        <!-- BEGIN: Content -->
            @section('content')       
            @show
        <!-- END: Content --> 
    @include('admin.layout.footer')
    </body>

</html>