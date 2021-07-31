<div class="navbar-custom-menu" style="background:#26b1b0;">

        <ul class="nav navbar-nav">
            <li>
                @if(Auth::check())
                    <a href="{{route('logout')}}">Logout</a>
                    @else
                    <a href="{{route('login')}}">login</a>
                    <a href="{{route('showUserRegisterForm')}}">register</a>
                @endif

            </li>
        </ul>

</div>
