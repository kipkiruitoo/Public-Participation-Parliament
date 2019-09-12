{{-- new nav bar --}}
<?php
$user = Auth::user();
?>
<nav class="navbar has-shadow">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item is-paddingless" href="{{route('home')}}">
                <img src="{{asset('images/arms.png')}}" alt="">
                <b class="p-l-5">Parliament of Kenya </b>
            </a>
            @if (Request::segment(1) == "manage")
            <a class="navbar-item is-hidden-desktop" id="admin-slideout-button">
              <span class="icon">
                <i class="fa fa-arrow-circle-right"></i>
              </span>
            </a>
          @endif
            <button class="button navbar-burger">
                <span></span>
                <span></span>
                <span></span>
              </button>
        </div>
        
    
        <div class="navbar-menu">
            <div class="navbar-start">
                
            </div>
            <div class="navbar-end nav-menu" style="overflow: visible">
                @guest

                <a href="{{route('login')}}" class="navbar-item is-tab">Login</a>
                <a href="{{route('register')}}" class="navbar-item m-l-10 is-tab">Register</a>

                @else
                <div class="navbar-item has-dropdown is-hoverable">
                   
                    <a class="navbar-link"> <img src="/uploads/avatars/{{ $user->avatar }}"
                        style=" width: 25px; height: 25px;  border-radius:50%; margin-right: 25px;" alt=""> Hey {{Auth::user()->name}}</a>
                    <div class="navbar-dropdown is-right">
                        <a href="{{url('/profile')}}" class="navbar-item">
                            <span class="icon">
                                <i class="fa fa-fw fa-user-circle-o m-r-5"></i>
                            </span>Profile
                        </a>
                        <hr class="navbar-divider">
                        <a href="{{url('/messages')}}" class="navbar-item">
                                <span class="icon">
                                    <i class="fa fa-fw fa-envelope m-r-5"></i>
                                </span>Messages
                            </a>
                        <a href="#" class="navbar-item">
                            <span class="icon">
                                <i class="fa fa-fw fa-bell m-r-5"></i>
                            </span>Notifications
                        </a>
                        @role('administrator')
                        <a href="{{route('manage.dashboard')}}" class="navbar-item">
                            <span class="icon">
                                <i class="fa fa-fw fa-cog m-r-5"></i>
                            </span>Manage
                        </a>
                        @endrole
                        <hr class="navbar-divider">
                        <a href="{{ route('logout') }}" class=" navbar-item" onclick="event.preventDefault(); 
                            document.getElementById('logout-form').submit();"><span class="icon"><i
                                    class="fa fa-fw fa-sign-out m-r-5"></i></span> Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
{{-- old nav bar --}}
{{-- <nav class="nav has-shadow">
    <div class="container">
        <div class="nav-left">
            <a class="nav-item">
                <img src="{{asset('images/arms.png')}}" height="150" width="150" alt="logo" href="{{route('home')}}">

</a>

</div>
<div class="nav-right" style="overflow: visible;">
    @if (Auth::guest())

    <a href="{{route('login')}}" class="nav-item is-tab">Login</a>
    <a href="{{route('register')}}" class="nav-item is-tab">Sign Up</a>

    @else
    <button class="dropdown is-aligned-right nav-item  is-tab">
        Hey {{Auth::user()->name}} <span class="icon"><i class="fa fa-caret-down"></i></span>

        <ul class="dropdown-menu">
            <li><a href="#">
                    <span class="icon"><i class="fa fa-fw fa-user-circle-o"></i></span>
                    Profile</a></li>
            <li><a href="##"><span class="icon"><i class="fa fa-fw fa-bell"></i></span> Notification</a></li>
            <li><a href="{{route('manage.dashboard')}}">
                    <span class="icon"><i class="fa fa-fw fa-cog"></i></span> Manage</a></li>
            <li class="seperator"></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();"><span class="icon"><i
                            class="fa fa-fw fa-sign-out"></i></span> Logout</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </button>
    @endif
</div>

</div>
</nav> --}}
