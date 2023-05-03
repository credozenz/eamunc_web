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
                  <a class="nav-link @if($routeGroup =='vipuser_dashbord') active @endif" href="{{ route('app.vipuser_dashbord') }}">
                     <span >Dashboard</span>
                  </a>
                </li>
                <li   class="nav-item">
                  <a class="nav-link @if($routeGroup =='vipuser_guideline') active @endif" href="{{ route('app.vipuser_guideline') }}">
                     <span >Rules Of Procedure</span>
                  </a>
                </li>
                <li class="nav-item" >
                  <a class="nav-link @if($routeGroup =='vipuser_general_papers') active @endif" href="{{ route('app.vipuser_general_papers') }}">
                    <span >Position Papers</span>
                  </a>
                </li>
      
                <li class="nav-item" >
                  <a class="nav-link @if($routeGroup =='vipuser_bloc_formation') active @endif" href="{{ route('app.vipuser_bloc_formation') }}">
                    <span >Bloc Formation</span>
                  </a>
                </li>
      
                <li class="nav-item" >
                  <a class="nav-link @if($routeGroup =='vipuser_live') active @endif" href="{{ route('app.vipuser_committee_live') }}">
                    <span >Committee Live</span>
                  </a>
                </li>
      
                <li class="nav-item" >
                  <a class="nav-link @if($routeGroup =='vipuser_vienna_formula') active @endif" href="{{ route('app.vipuser_vienna_formula') }}">
                    <span >Vienna Formula</span>
                  </a>
                </li>
      
                <li class="nav-item" >
                  <a class="nav-link @if($routeGroup =='vipuser_line_by_line') active @endif" href="{{ route('app.vipuser_line_by_line') }}">
                    <span >Line by Line</span>
                  </a>
                </li>
      
                <li class="nav-item" >
                  <a class="nav-link @if($routeGroup =='vipuser_resolution') active @endif" href="{{ route('app.vipuser_resolution') }}">
                     <span >Resolution Corner</span>
                  </a>
                </li>
      
                <li class="nav-item" >
                  <a class="nav-link @if($routeGroup =='vipuser_general_assembly') active @endif" href="{{ route('app.vipuser_general_assembly') }}">
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
              <a href="{{ route('app.vipuser_profile') }}" type="button" class="btn btn-outline-secondary">My Profile</a>
            </div>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='vipuser_dashbord') active @endif" href="{{ route('app.vipuser_dashbord') }}">
              <span >Dashboard</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Guideline">
            <a class="nav-link @if($routeGroup =='vipuser_guideline') active @endif" href="{{ route('app.vipuser_guideline') }}">
              <span >Rules Of Procedure</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='vipuser_general_papers') active @endif" href="{{ route('app.vipuser_general_papers') }}">
              <span >Position Papers</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='vipuser_bloc_formation') active @endif" href="{{ route('app.vipuser_bloc_formation') }}">
              <span >Bloc Formation</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='vipuser_vienna_formula') active @endif" href="{{ route('app.vipuser_vienna_formula') }}">
              <span >Vienna Formula</span>
            </a>
          </li>
          
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='vipuser_line_by_line') active @endif" href="{{ route('app.vipuser_line_by_line') }}">
              <span >Line by Line</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='vipuser_resolution') active @endif" href="{{ route('app.vipuser_resolution') }}">
              <span >Resolution Corner</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link @if($routeGroup =='vipuser_general_assembly') active @endif" href="{{ route('app.vipuser_general_assembly') }}">
              <span >General Assembly</span>
            </a>
          </li>

        </ul>
   
    </div>
</nav>

    