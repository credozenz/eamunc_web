<div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="{{ url('admin/dashbord') }}"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>

    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>
            
            <li class="sidebar-item active ">
                <a href="{{ url('admin/dashbord') }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>News Letter</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="{{ url('admin/newsletter') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ url('admin/newsletter_create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>Letter</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="{{ url('admin/letters') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ url('admin/letters_create') }}">Add</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>Conference schedule</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="{{ url('admin/conference_schedule') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ url('admin/conference_schedule_create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>Conference Updates</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="{{ url('admin/conference_updates') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ url('admin/conference_updates_create') }}">Add</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item  ">
                <a href="{{ url('admin/president_messages') }}" class='sidebar-link'>
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    <span>President Message</span>
                </a>
            </li>

            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>Faculties Message</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="{{ url('admin/facultiesmessages') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ url('admin/facultiesmessages_create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>Our Mentors</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="{{ url('admin/our_mentors') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ url('admin/our_mentors_create') }}">Add</a>
                    </li>
                </ul>
            </li>


            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>Committee Members</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="{{ url('admin/committee_members') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ url('admin/committee_members_create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>Host Schools</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="{{ url('admin/host_schools') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ url('admin/host_schools_create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>Gallery</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="{{ url('admin/gallery') }}">Index</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ url('admin/gallery_create') }}">Add</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  ">
                <a href="{{ url('admin/live') }}" class='sidebar-link'>
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    <span>Live</span>
                </a>
            </li>

            <li class="sidebar-item  ">
                <a href="{{ url('admin/act_impacts') }}" class='sidebar-link'>
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    <span>Act to Impact</span>
                </a>
            </li>

            <li class="sidebar-item  ">
                <a href="{{ url('admin/vc_condunt') }}" class='sidebar-link'>
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    <span>Virtual Code Of Conduct</span>
                </a>
            </li>

            <li class="sidebar-item  ">
                <a href="{{ url('admin/vision') }}" class='sidebar-link'>
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    <span>Vision</span>
                </a>
            </li>
            
            <li class="sidebar-title">Settings</li>
        
            <li class="sidebar-item  ">
                <a href="{{ url('admin/president_messages') }}" class='sidebar-link'>
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="sidebar-item  ">
                <a href="{{ url('admin/change_password') }}" class='sidebar-link'>
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    <span>Change Password</span>
                </a>
            </li>
               
           
        </ul>
    </div>
    
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
</div>

