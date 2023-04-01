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
                  <a class="nav-link @if($routeGroup =='bureau_dashbord') active @endif" href="{{ route('app.bureau_dashbord') }}">
                     <span >Dashboard</span>
                  </a>
                </li>
                <li class="nav-item" >
                  <a class="nav-link @if($routeGroup =='bureau_general_papers') active @endif" href="{{ route('app.bureau_general_papers') }}">
                    <span >General Papers</span>
                  </a>
                </li>
      
                <li class="nav-item" >
                  <a class="nav-link @if($routeGroup =='bureau_bloc_formation') active @endif" href="{{ route('app.bureau_bloc_formation') }}">
                    <span >Bloc Formation</span>
                  </a>
                </li>
                <li class="nav-item" >
                  <a class="nav-link @if($routeGroup =='committee_live') active @endif" href="{{ route('app.bureau_committee_live') }}">
                    <span >Committee Live</span>
                  </a>
                </li>
                
      
                <li class="nav-item" >
                  <a class="nav-link @if($routeGroup =='bureau_vienna_formula') active @endif" href="{{ route('app.bureau_vienna_formula') }}">
                    <span >Vienna Formula</span>
                  </a>
                </li>
      
                <li class="nav-item" >
                  <a class="nav-link @if($routeGroup =='bureau_line_by_line') active @endif" href="{{ route('app.bureau_line_by_line') }}">
                    <span >Line by Line</span>
                  </a>
                </li>
      
                <li class="nav-item" >
                  <a class="nav-link @if($routeGroup =='bureau_resolution') active @endif" href="{{ route('app.bureau_resolution') }}">
                     <span >Resolution Corner</span>
                  </a>
                </li>
      
                <li class="nav-item" >
                  <a class="nav-link @if($routeGroup =='bureau_general_assembly') active @endif" href="{{ route('app.bureau_general_assembly') }}">
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
                @if(!empty($member->avatar))
                <img src="{{ asset('uploads/'.$member->avatar) ?? '' }}" alt="{{ $member->name ?? '' }}">
                @else
                <img src="{{ asset('assets/img/avatar.svg') }}" alt="{{ $member->name ?? '' }}">
                @endif
              
              <h4>{{ str_limit($member->name, $limit = 12, $end = '...') }}</h4>
              <a href="{{ route('app.bureau_profile') }}" type="button" class="btn btn-outline-secondary">My Profile</a> 
            </div>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='bureau_dashbord') active @endif" href="{{ route('app.bureau_dashbord') }}">
              <span >Dashboard</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='bureau_general_papers') active @endif" href="{{ route('app.bureau_general_papers') }}">
              <span >General Papers</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='bureau_bloc_formation') active @endif" href="{{ route('app.bureau_bloc_formation') }}">
              <span >Bloc Formation</span>
            </a>
          </li>

          <li class="nav-item" >
            <a class="nav-link @if($routeGroup =='committee_live') active @endif" href="{{ route('app.bureau_committee_live') }}">
              <span >Committee Live</span>
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
              <span >Resolution Corner</span>
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

    