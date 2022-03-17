<div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo" style="font-size: 1.5rem;padding:5px 5px 5px;">
                <a href="{{ url('admin/dashbord') }}"><img src="{{ asset('assets/admin/img/logo.png') }}" style="border: inset;width: 40px;height: 35px;" alt="EAMUNC" srcset="">EAMUNC</a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-item  @if($routeGroup =='dashbord') active @endif ">
                <a href="{{ route('admin.dashbord') }}" class='sidebar-link'>
                    <span><i class="fa fa-columns" aria-hidden="true">&nbsp</i>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='delegates') active @endif">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-user-plus" aria-hidden="true">&nbsp</i>Delegates</span>
                </a>
                <ul class="submenu @if($routeGroup=='delegates') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.isg_delegates') }}">ISG Delegates</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.school_delegates') }}">School Delegates</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">Web Pages</li>
            <hr>

            <li class="sidebar-item  has-sub @if($routeGroup=='home') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-file-o" aria-hidden="true">&nbsp</i>Home</span>
                </a>
                <ul class="submenu @if($routeGroup=='home') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.banner') }}">Banner</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.timer') }}">Timer</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.president_messages') }}">President Message</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.facultiesmessages') }}">Faculties Message</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.conference_updates') }}">Conference Updates</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.conference_schedule') }}">Conference schedule</a>
                    </li>

                </ul>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='about') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-file-o" aria-hidden="true">&nbsp</i>About Page</span>
                </a>
                <ul class="submenu @if($routeGroup=='about') active @endif">
                    <li class="submenu-item ">
                    <a href="{{ route('admin.vision') }}" class='sidebar-link'>Vision</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.our_mentors') }}">Our Mentors</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='conference') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-file-o" aria-hidden="true">&nbsp</i>Conference Page</span>
                </a>
                <ul class="submenu @if($routeGroup=='conference') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.letters') }}">Letter</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.work_members') }}">Working Members</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.importantdate') }}">Important Date</a>
                    </li>
                    <li class="submenu-item">
                           <a href="{{ route('admin.rules') }}">Rules & Regulations</a>
                    </li>
                </ul>
            </li>


            <li class="sidebar-item  has-sub @if($routeGroup=='committee') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-file-o" aria-hidden="true">&nbsp</i>Committee</span>
                </a>
                <ul class="submenu @if($routeGroup=='committee') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.committee') }}">Committee</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='gallery') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-file-o" aria-hidden="true">&nbsp</i>Gallery</span>
                </a>
                <ul class="submenu @if($routeGroup=='gallery') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.gallery') }}">Gallery</a>
                    </li>
                </ul>
            </li>
       
            <li class="sidebar-item  has-sub @if($routeGroup=='alumni') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-file-o" aria-hidden="true">&nbsp</i>Alumni</span>
                </a>
                <ul class="submenu @if($routeGroup=='alumni') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.alumni') }}">Alumni</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.alumninews') }}">Alumni News</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='newsletter') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-file-o" aria-hidden="true">&nbsp</i>News Letter</span>
                </a>
                <ul class="submenu @if($routeGroup=='newsletter') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.newsletter') }}">News Letter</a>
                    </li>
                </ul>
            </li>
           
            <li class="sidebar-item  has-sub @if($routeGroup=='hostschool') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-file-o" aria-hidden="true">&nbsp</i>Host Schools</span>
                </a>
                <ul class="submenu @if($routeGroup=='hostschool') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.host_schools') }}">Host Schools</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='impact') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-file-o" aria-hidden="true">&nbsp</i>Act to Impact</span>
                </a>
                <ul class="submenu @if($routeGroup=='impact') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.act_impacts') }}">Act to Impact</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='vc_condunt') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-file-o" aria-hidden="true">&nbsp</i>Virtual Code Of Conduct</span>
                </a>
                <ul class="submenu @if($routeGroup=='vc_condunt') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.vc_condunt') }}">Virtual Code Of Conduct</a>
                    </li>
                </ul>
            </li>
           
            <li class="sidebar-item  has-sub @if($routeGroup=='past_conference') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-file-o" aria-hidden="true">&nbsp</i>Past Conference</span>
                </a>
                <ul class="submenu @if($routeGroup=='past_conference') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.pastconference') }}">Past Conference</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='footer') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-file-o" aria-hidden="true">&nbsp</i>Footer</span>
                </a>
                <ul class="submenu @if($routeGroup=='footer') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.faq') }}">FAQ</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.terms') }}">Terms of Service</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.privacy_policy') }}">Privacy Policy</a>
                    </li>
                </ul>
            </li>

           
            
            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">Settings</li>
            <hr>

            <li class="sidebar-item  has-sub @if($routeGroup=='settings') active @endif">
                <a href="#" class='sidebar-link'>
                <span><i class="fa fa-user">&nbsp</i>Profile</span>
                </a>
                <ul class="submenu @if($routeGroup=='settings') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.profile') }}">Profile</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.change_password') }}">Change Password</a>
                    </li>
                </ul>
            </li>

         <br>
         
         <li class="sidebar-item">
                <a href="{{ route('admin.log_out') }}" class='sidebar-link'>
                    <span><i class="fa fa-power-off" aria-hidden="true" style="color:red;">&nbsp</i>Log Out</span>
                </a>
            </li>
         <br><br>
        </ul>
    </div>
    
    
            </div>
        </div>
</div>

