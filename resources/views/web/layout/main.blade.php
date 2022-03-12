<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN: Head -->
    @include('web.layout.head')
    <!-- END: Head -->
    <body> 
        
    @include('web.layout.menu')
   
        <!-- BEGIN: Content -->
            @section('content')       
            @show
        <!-- END: Content --> 
    
    @include('web.layout.footer')
    
    </body>

</html>