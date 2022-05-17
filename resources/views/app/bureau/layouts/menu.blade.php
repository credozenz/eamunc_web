 <!-- Navigation-->
<nav class="navbar navbar-expand-lg   fixed-top" id="mainNav">
    <button class="btn float-end display-sm text-white" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </button>
    <div class="display-sm">
      <div class="offcanvas bg-primary offcanvas-start mobile-menu" tabindex="-1" id="offcanvas" data-bs-keyboard="false" data-bs-backdrop="false">
        <div class="offcanvas-header">      
            <button type="button" class="btn-close text-reset text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body px-0">
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
               
                <li   class="nav-item">
                  <a class="nav-link " href="dashboard.html">
                   
                    <span >Dashboard</span>
                  </a>
                </li>
                <li class="nav-item" >
                  <a class="nav-link" href="paper-submission.html">
                   
                    <span >Paper Submission</span>
                  </a>
                </li>
      
                <li class="nav-item" >
                  <a class="nav-link" href="bloc-formation.html">
                   
                    <span >Bloc Formation</span>
                  </a>
                </li>
      
                
      
                <li class="nav-item" >
                  <a class="nav-link" href="vienna-formula.html">
                   
                    <span >Vienna Formula</span>
                  </a>
                </li>
      
                <li class="nav-item" >
                  <a class="nav-link" href="line-by-line.html">
                   
                    <span >Line by Line</span>
                  </a>
                </li>
      
                <li class="nav-item" >
                  <a class="nav-link" href="registration.html">
                   
                    <span >Resolution</span>
                  </a>
                </li>
      
                <li class="nav-item" >
                  <a class="nav-link" href="general-assebly.html">
                   
                    <span >General Assembly</span>
                  </a>
                </li>
               
            </ul>
        </div>
      </div>
    </div>
     
    <div class="collapse navbar-collapse" id="navbarResponsive">
          
        <ul class="navbar-nav navbar-sidenav display-lg" id="exampleAccordion">
            <div class="text-center menu-profile">
                @if(!empty(Session::get('Log_IMG'))) 
                <img src="{{ asset('uploads/'.Session::get('Log_IMG')) ?? '' }}" alt="{{ Session::get('Log_NAME') ?? '' }}">
                @else
                <img src="{{ asset('assets/img/avatar.svg') }}" alt="{{ Session::get('Log_NAME') ?? '' }}">
                @endif
              
              <h4>{{ Session::get('Log_NAME') ?? '' }}</h4>
              <a href="{{ route('app.bureau_profile') }}" type="button" class="btn btn-outline-secondary">My Profile</a> 
            </div>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='bureau_dashbord') active @endif" href="{{ route('app.bureau_dashbord') }}">
              <span >Dashboard</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='bureau_bloc_formation') active @endif" href="{{ route('app.bureau_bloc_formation') }}">
              <span >Bloc Formation</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='bureau_vienna_formula') active @endif" href="{{ route('app.bureau_vienna_formula') }}">
              <span >Vienna Formula</span>
            </a>
          </li>
          
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='bureau_line_by_line') active @endif" href="{{ route('app.bureau_line_by_line') }}">
              <span >Line by Line</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='bureau_resolution') active @endif" href="{{ route('app.bureau_resolution') }}">
              <span >Resolution</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='bureau_general_assembly') active @endif" href="{{ route('app.bureau_general_assembly') }}">
              <span >General Assembly</span>
            </a>
          </li>

        </ul>
   
    </div>
</nav>

    