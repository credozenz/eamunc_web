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
            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">Home</li>
            <hr>
            <li class="sidebar-item  has-sub @if($routeGroup=='banner') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-file-image-o" aria-hidden="true">&nbsp</i>Banner</span>
                </a>
                <ul class="submenu @if($routeGroup=='banner') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.banner') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.banner.create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item @if($routeGroup=='president_messages') active @endif ">
                <a href="{{ route('admin.president_messages') }}" class='sidebar-link'>
                    <span><i class="fa fa-black-tie" aria-hidden="true">&nbsp</i>President Message</span>
                </a>
            </li>

            <li class="sidebar-item has-sub @if($routeGroup=='facultiesmessages') active @endif">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-user-circle-o" aria-hidden="true">&nbsp</i>Faculties Message</span>
                </a>
                <ul class="submenu @if($routeGroup=='facultiesmessages') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.facultiesmessages') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.facultiesmessages.create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='conference_updates') active @endif">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-user-plus" aria-hidden="true">&nbsp</i>Conference Updates</span>
                </a>
                <ul class="submenu @if($routeGroup=='conference_updates') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.conference_updates') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.conference_updates.create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='conference_schedule') active @endif">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-bars" aria-hidden="true">&nbsp</i>Conference schedule</span>
                </a>
                <ul class="submenu @if($routeGroup=='conference_schedule') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.conference_schedule') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.conference_schedule.create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">About Page</li>
            <hr>

            <li class="sidebar-item @if($routeGroup=='vision') active @endif ">
                <a href="{{ route('admin.vision') }}" class='sidebar-link'>
                    <span><i class="fa fa-eye" aria-hidden="true">&nbsp</i>Vision</span>
                </a>
            </li>

            <li class="sidebar-item has-sub @if($routeGroup=='ourmentors') active @endif">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-user-circle-o" aria-hidden="true">&nbsp</i>Our Mentors</span>
                </a>
                <ul class="submenu @if($routeGroup=='ourmentors') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.our_mentors') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.our_mentors.create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">Conference Page</li>
            <hr>

            <li class="sidebar-item  has-sub @if($routeGroup=='letters') active @endif">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-pencil-square-o" aria-hidden="true">&nbsp</i>Letter</span>
                </a>
                <ul class="submenu @if($routeGroup=='letters') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.letters') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.letters.create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='work_members') active @endif">
                <a href="#" class='sidebar-link'>
                <span><i class="fa fa-users" aria-hidden="true">&nbsp</i>Working Members</span>
                </a>
                <ul class="submenu @if($routeGroup=='work_members') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.work_members') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.work_members.create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='importantdate') active @endif">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-calendar" aria-hidden="true">&nbsp</i>Important Date</span>
                </a>
                <ul class="submenu @if($routeGroup=='importantdate') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.importantdate') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.importantdate.create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  @if($routeGroup=='rules') active @endif">
                <a href="{{ route('admin.rules') }}" class='sidebar-link'>
                    <span><i class="fa fa-sliders" aria-hidden="true">&nbsp</i>Rules & Regulations</span>
                </a>
            </li>

            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">Committee</li>
            <hr>

            <li class="sidebar-item  has-sub @if($routeGroup=='committee') active @endif">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-users" aria-hidden="true">&nbsp</i>Committee</span>
                </a>
                <ul class="submenu @if($routeGroup=='committee') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.committee') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.committee.create') }}">Add</a>
                    </li>
                </ul>
            </li>


            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">Live</li>
            <hr>

            <li class="sidebar-item @if($routeGroup=='live') active @endif">
                <a href="{{ route('admin.live') }}" class='sidebar-link'>
                    <span><i class="fa fa-podcast" aria-hidden="true">&nbsp</i>Live</span>
                </a>
            </li>

            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">Timer</li>
            <hr>

            <li class="sidebar-item @if($routeGroup=='timer') active @endif">
                <a href="{{ route('admin.timer') }}" class='sidebar-link'>
                    <span><i class="fa fa-hourglass-half" aria-hidden="true">&nbsp</i>Timer</span>
                </a>
            </li>

            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">Gallery</li>
            <hr>

            <li class="sidebar-item  has-sub @if($routeGroup=='gallery') active @endif">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-picture-o" aria-hidden="true">&nbsp</i>Gallery</span>
                </a>
                <ul class="submenu @if($routeGroup=='gallery') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.gallery') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.gallery.create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">Alumni</li>
            <hr>

            <li class="sidebar-item @if($routeGroup=='alumni') active @endif">
                <a href="{{ route('admin.alumni') }}" class='sidebar-link'>
                    <span><i class="fa fa-graduation-cap" aria-hidden="true">&nbsp</i>Alumni</span>
                </a>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='alumninews') active @endif">
                <a href="#" class='sidebar-link'>
                <span><i class="fa fa-newspaper-o" aria-hidden="true">&nbsp</i>Alumni News</span>
                </a>
                <ul class="submenu @if($routeGroup=='alumninews') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.alumninews') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.alumninews.create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">News Letter</li>
            <hr>

            <li class="sidebar-item  has-sub @if($routeGroup=='newsletter') active @endif">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-newspaper-o" aria-hidden="true">&nbsp</i>News Letter</span>
                </a>
                <ul class="submenu @if($routeGroup=='newsletter') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.newsletter') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.newsletter.create') }}">Add</a>
                    </li>
                </ul>
            </li>


            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">Host Schools</li>
            <hr>

            <li class="sidebar-item  has-sub @if($routeGroup=='host_schools') active @endif">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-share-square-o" aria-hidden="true">&nbsp</i>Host Schools</span>
                </a>
                <ul class="submenu @if($routeGroup=='host_schools') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.host_schools') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.host_schools.create') }}">Add</a>
                    </li>
                </ul>
            </li>
            
            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">Act to Impact</li>
            <hr>

            <li class="sidebar-item @if($routeGroup=='act_impacts') active @endif ">
                <a href="{{ route('admin.act_impacts') }}" class='sidebar-link'>
                    <span><i class="fa fa-spinner" aria-hidden="true">&nbsp</i>Act to Impact</span>
                </a>
            </li>
           
            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">Virtual Code Of Conduct</li>
            <hr>
            
            <li class="sidebar-item  @if($routeGroup=='vc_condunt') active @endif">
                <a href="{{ route('admin.vc_condunt') }}" class='sidebar-link'>
                    <span><i class="fa fa-window-maximize" aria-hidden="true">&nbsp</i>Virtual Code Of Conduct</span>
                </a>
            </li>
           
            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">Past Conference</li>
            <hr>
            
            <li class="sidebar-item  has-sub @if($routeGroup=='pastconference') active @endif">
                <a href="#" class='sidebar-link'>
                <span><i class="fa fa-users">&nbsp</i>Past Conference</span>
                </a>
                <ul class="submenu @if($routeGroup=='pastconference') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.pastconference') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.pastconference.create') }}">Add</a>
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

