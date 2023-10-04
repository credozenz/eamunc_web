<div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo" style="font-size: 1.5rem;padding:5px 5px 5px;">
                <a href="{{ url('admin/dashbord') }}"><img src="{{ asset('assets/admin/img/logo.png') }}" style="width: 4rem;height: 4rem;" alt="E.A.MUNC" srcset="">&nbsp&nbspE.A.MUNC</a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-item @if($routeGroup =='dashbord') active @endif ">
                <a href="{{ route('admin.dashbord') }}" class='sidebar-link'>
                    <span><i class="fa fa-columns" aria-hidden="true">&nbsp</i>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item @if($routeGroup=='school') active @endif">
                <a href="{{ route('admin.schools') }}" class='sidebar-link'>
                    <span><i class="fa fa-university" aria-hidden="true">&nbsp</i>Schools</span>
                </a>
            </li>

            <li class="sidebar-item @if($routeGroup=='faculty_advisors') active @endif">
                <a href="{{ route('admin.faculty_advisors') }}" class='sidebar-link'>
                    <span><i class="fa fa-university" aria-hidden="true">&nbsp</i>Faculty Advisors</span>
                </a>
            </li>


            <li class="sidebar-item @if($routeGroup=='students') active @endif">
                <a href="{{ route('admin.students') }}" class='sidebar-link'>
                    <span><i class="fa fa-graduation-cap" aria-hidden="true">&nbsp</i>Students</span>
                </a>
            </li>



            <li class="sidebar-item @if($routeGroup=='committee') active @endif ">
                <a href="{{ route('admin.committee') }}" class='sidebar-link'>
                    <span><i class="fa fa-users" aria-hidden="true">&nbsp</i>Committee</span>
                </a>
            </li>

           
            <li class="sidebar-item @if($routeGroup=='users') active @endif ">
                <a href="{{ route('admin.users') }}" class='sidebar-link'>
                    <span><i class="fa fa-users" aria-hidden="true">&nbsp</i>VIP Users</span>
                </a>
            </li>

            <li class="sidebar-item  @if($routeGroup =='guideline') active @endif ">
                <a href="{{ route('admin.guideline') }}" class='sidebar-link'>
                    <span><i class="fa fa-map-signs" aria-hidden="true">&nbsp</i>Rules Of Procedure</span>
                </a>
            </li>

            <li class="sidebar-item  @if($routeGroup =='certificate') active @endif ">
                <a href="{{ route('admin.certificate_show') }}" class='sidebar-link'>
                    <span><i class="fa fa-graduation-cap" aria-hidden="true">&nbsp</i>Certificate</span>
                </a>
            </li>

            <li class="sidebar-item @if($routeGroup=='alumni_reg') active @endif">
                <a href="{{ route('admin.alumni_registration') }}" class='sidebar-link'>
                    <span><i class="fa fa-graduation-cap" aria-hidden="true">&nbsp</i>Alumini</span>
                </a>
            </li>

            <li class="sidebar-item  @if($routeGroup =='liability_form') active @endif ">
                <a href="{{ route('admin.liability_waiver_form') }}" class='sidebar-link'>
                    <span><i class="fa fa-file-o" aria-hidden="true">&nbsp</i>Liability Waiver Form</span>
                </a>
            </li>

            <li class="sidebar-item  @if($routeGroup =='feedback') active @endif ">
                <a href="{{ route('admin.user_feedback') }}" class='sidebar-link'>
                    <span><i class="fa fa-comment-o" aria-hidden="true">&nbsp</i>Feedback</span>
                </a>
            </li>

            <li class="sidebar-title" style="font-weight: bold;color: #9197a8;">Web Pages</li>
            <hr>

            <li class="sidebar-item  has-sub @if($routeGroup=='home') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-home" aria-hidden="true">&nbsp</i>Home</span>
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
                    <span><i class="fa fa-address-card" aria-hidden="true">&nbsp</i>About Page</span>
                </a>
                <ul class="submenu @if($routeGroup=='about') active @endif">
                    <li class="submenu-item ">
                    <a href="{{ route('admin.vision') }}" class='sidebar-link'>Vision</a>
                    </li>
                    <li class="submenu-item ">
                    <a href="{{ route('admin.mission') }}" class='sidebar-link'>Mission</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.our_mentors') }}">Our Mentors</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='conference') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-braille" aria-hidden="true">&nbsp</i>Conference Page</span>
                </a>
                <ul class="submenu @if($routeGroup=='conference') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.letters') }}">Letter</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.work_members') }}">Core Committee Members</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.importantdate') }}">Important Date</a>
                    </li>
                    <li class="submenu-item">
                           <a href="{{ route('admin.rules') }}">Rules & Regulations</a>
                    </li>
                </ul>
            </li>


            <li class="sidebar-item  @if($routeGroup =='gallery') active @endif ">
                <a href="{{ route('admin.gallery') }}" class='sidebar-link'>
                    <span><i class="fa fa-picture-o" aria-hidden="true">&nbsp</i>Gallery</span>
                </a>
            </li>
            <li class="sidebar-item @if($routeGroup=='press_corp') active @endif ">
                <a href="{{ route('admin.committee.press_corp') }}" class='sidebar-link'>
                    <span><i class="fa fa-users" aria-hidden="true">&nbsp</i>Press Corp</span>
                </a>
            </li>

       
            <li class="sidebar-item  has-sub @if($routeGroup=='alumni') active @endif ">
                <a href="{{ route('admin.alumni') }}" class='sidebar-link'>
                    <span><i class="fa fa-file-o" aria-hidden="true">&nbsp</i>Alumni</span>
                </a>
                <ul class="submenu @if($routeGroup=='alumni') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.alumni') }}">Alumni</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.alumninews') }}">Alumni News</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.alumniwebinar') }}">Alumni Webinar</a>
                    </li>
                </ul>
            </li>


            <li class="sidebar-item  @if($routeGroup =='newsletter') active @endif ">
                <a href="{{ route('admin.newsletter') }}" class='sidebar-link'>
                    <span><i class="fa fa-newspaper-o" aria-hidden="true">&nbsp</i>Consensus Chronicles</span>
                </a>
            </li>

            <li class="sidebar-item  @if($routeGroup =='hostschool') active @endif ">
                <a href="{{ route('admin.host_schools') }}" class='sidebar-link'>
                    <span><i class="fa fa-university" aria-hidden="true">&nbsp</i>Host Educational Institiutions</span>
                </a>
            </li>

            <li class="sidebar-item  @if($routeGroup =='participateschool') active @endif ">
                <a href="{{ route('admin.participate_schools') }}" class='sidebar-link'>
                    <span><i class="fa fa-university" aria-hidden="true">&nbsp</i>Participating Schools</span>
                </a>
            </li>

            <li class="sidebar-item  @if($routeGroup =='impact') active @endif ">
                <a href="{{ route('admin.act_impacts') }}" class='sidebar-link'>
                    <span><i class="fa fa-sort" aria-hidden="true">&nbsp</i>Act to Impact</span>
                </a>
            </li>

            <li class="sidebar-item  @if($routeGroup =='live') active @endif ">
                <a href="{{ route('admin.live') }}" class='sidebar-link'>
                    <span><i class="fa fa-podcast" aria-hidden="true">&nbsp</i>Live</span>
                </a>
            </li>

            <li class="sidebar-item  @if($routeGroup =='vc_condunt') active @endif ">
                <a href="{{ route('admin.vc_condunt') }}" class='sidebar-link'>
                    <span><i class="fa fa-sort" aria-hidden="true">&nbsp</i>Code Of Conduct</span>
                </a>
            </li>

            <li class="sidebar-item  @if($routeGroup =='past_conference') active @endif ">
                <a href="{{ route('admin.pastconference') }}" class='sidebar-link'>
                    <span><i class="fa fa-users" aria-hidden="true">&nbsp</i>Past Conference</span>
                </a>
            </li>

            <li class="sidebar-item  has-sub @if($routeGroup=='footer') active @endif ">
                <a href="#" class='sidebar-link'>
                    <span><i class="fa fa-object-group" aria-hidden="true">&nbsp</i>Footer</span>
                </a>
                <ul class="submenu @if($routeGroup=='footer') active @endif">
                    <li class="submenu-item ">
                        <a href="{{ route('admin.faq') }}">FAQ</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ route('admin.feedback') }}">Feedback</a>
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
                <a href="{{ route('admin.profile') }}" class='sidebar-link'>
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

