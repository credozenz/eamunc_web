<div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
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
                <a href="index.html" class='sidebar-link'>
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
            <li class="sidebar-item  ">
                <a href="{{ url('admin/president_messages') }}" class='sidebar-link'>
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    <span>President Message</span>
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
                <a href="form-layout.html" class='sidebar-link'>
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    <span>Change Password</span>
                </a>
            </li>
               
            
        </ul>
    </div>
    
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
        </div>