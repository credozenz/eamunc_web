<header id="header" class="border header-padding">
        <nav class="navbar">
            <div class="container">
                <div class="navbar-header">

                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('assets/web/img/logo.png') }}" class="logo" alt="">
                    </a>

                    <div class="menu font-normal">
                        <div class="menu-left">
                            <div class="toggler" id="side_opener">
                                <i class="font-normal menu-helper">
                                    <svg class="me-2" fill="#000000" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 50 50" width="30px" height="30px">
                                        <path
                                            d="M 0 9 L 0 11 L 50 11 L 50 9 Z M 0 24 L 0 26 L 50 26 L 50 24 Z M 0 39 L 0 41 L 50 41 L 50 39 Z" />
                                    </svg>
                                    Menu</i>
                            </div>
                            <a href="#" class="text-darkblue main-line desk-text">E.Ahamed Model <br>United Nations
                                Conference</a>
                            <a href="#" class="mobile-text text-darkblue main-line">E.Ahamed Model United Nations
                                Conference</a>
                        </div>
                        <div class="menu-right">
                            <a href="{{ route('registration') }}" class="button register-btn">Register Now</a>
                            <span class="divider"></span>
                            <a href="#" class="button signin-btn">Sign In</a>
                        </div>
                    </div>

                </div>

                <div class="collapse sidemenu" id="navbar-menu">
                    <button class="closer" id="side_closer">
                        <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                            <path
                                d="M 7.71875 6.28125 L 6.28125 7.71875 L 23.5625 25 L 6.28125 42.28125 L 7.71875 43.71875 L 25 26.4375 L 42.28125 43.71875 L 43.71875 42.28125 L 26.4375 25 L 43.71875 7.71875 L 42.28125 6.28125 L 25 23.5625 Z" />
                        </svg>
                    </button>


                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a href="{{ route('about-us') }}" class="color-white font-normal">About E.A.MUNC</a></li>
                        <li class="nav-item"><a href="{{ route('conference') }}" class="color-white font-normal">Conferences</a></li>
                        <li class="nav-item"><a href="{{ route('committees') }}" class="color-white font-normal">Committees</a></li>
                        <li class="nav-item"><a href="{{ route('live') }}" class="color-white font-normal">Live</a></li>
                        <li class="nav-item"><a href="{{ route('gallery') }}" class="color-white font-normal">Gallery</a></li>
                        <li class="nav-item"><a href="{{ route('alumni') }}" class="color-white font-normal">Alumni</a></li>
                        <li class="nav-item"><a href="{{ route('newsletter') }}" class="color-white font-normal">Newsletter</a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle color-white font-normal" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                More Information
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item font-normal" href="{{ route('registration') }}">Registration</a></li>
                                <li><a class="dropdown-item font-normal" href="{{ route('host-school') }}">Participating Schools</a></li>
                                <li><a class="dropdown-item font-normal" href="{{ route('act-impact') }}">Act Impact</a></li>
                                <li><a class="dropdown-item font-normal" href="{{ route('virtual-code') }}">Virtual Code Of Conduct</a></li>
                                <li><a class="dropdown-item font-normal" href="{{ route('past-conference') }}">Past Conference</a></li>
                                <li><a class="dropdown-item font-normal" href="{{ route('feedback') }}">Feedback</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="sidemenu-footer">
                        <div class="footer-line d-flex">
                            <p>HELP SHAPE A BETTER FUTURE</p>
                            <a href="{{ route('registration') }}" class="button register-btn">Register Now</a>
                        </div>
                        <ul class="d-flex sidemenu-socials">
                            <li><a href="#" class="color-white"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#" class="color-white"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="color-white"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#" class="color-white"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="color-white"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </nav>
    </header>
