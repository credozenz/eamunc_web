<div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo" style="font-size: 1.5rem;padding:5px 5px 5px;">
                <a href="{{ url('subadmin/dashbord') }}"><img src="{{ asset('assets/admin/img/logo.png') }}" style="width: 4rem;height: 4rem;" alt="E.A.MUNC" srcset="">&nbsp&nbspE.A.MUNC</a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-item @if($routeGroup =='dashbord') active @endif ">
                <a href="{{ route('subadmin.dashbord') }}" class='sidebar-link'>
                    <span><i class="fa fa-columns" aria-hidden="true">&nbsp</i>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item @if($routeGroup=='school') active @endif">
                <a href="{{ route('subadmin.schools') }}" class='sidebar-link'>
                    <span><i class="fa fa-university" aria-hidden="true">&nbsp</i>Schools</span>
                </a>
            </li>

            <li class="sidebar-item @if($routeGroup=='faculty_advisors') active @endif">
                <a href="{{ route('subadmin.faculty_advisors') }}" class='sidebar-link'>
                    <span><i class="fa fa-university" aria-hidden="true">&nbsp</i>Faculty Advisors</span>
                </a>
            </li>


            <li class="sidebar-item @if($routeGroup=='students') active @endif">
                <a href="{{ route('subadmin.students') }}" class='sidebar-link'>
                    <span><i class="fa fa-graduation-cap" aria-hidden="true">&nbsp</i>Students</span>
                </a>
            </li>



            <li class="sidebar-item @if($routeGroup=='committee') active @endif ">
                <a href="{{ route('subadmin.committee') }}" class='sidebar-link'>
                    <span><i class="fa fa-users" aria-hidden="true">&nbsp</i>Committee</span>
                </a>
            </li>

           
            <li class="sidebar-item @if($routeGroup=='users') active @endif ">
                <a href="{{ route('subadmin.users') }}" class='sidebar-link'>
                    <span><i class="fa fa-users" aria-hidden="true">&nbsp</i>VIP Users</span>
                </a>
            </li>

            <li class="sidebar-item  @if($routeGroup =='guideline') active @endif ">
                <a href="{{ route('subadmin.guideline') }}" class='sidebar-link'>
                    <span><i class="fa fa-map-signs" aria-hidden="true">&nbsp</i>Rules Of Procedure</span>
                </a>
            </li>

            <li class="sidebar-item  @if($routeGroup =='certificate') active @endif ">
                <a href="{{ route('subadmin.certificate_show') }}" class='sidebar-link'>
                    <span><i class="fa fa-graduation-cap" aria-hidden="true">&nbsp</i>Certificate</span>
                </a>
            </li>

       
   
         
         <li class="sidebar-item">
                <a href="{{ route('subadmin.log_out') }}" class='sidebar-link'>
                    <span><i class="fa fa-power-off" aria-hidden="true" style="color:red;">&nbsp</i>Log Out</span>
                </a>
            </li>
         <br><br>
        </ul>
    </div>
    
    
            </div>
        </div>
</div>

