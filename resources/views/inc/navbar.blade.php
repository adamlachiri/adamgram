@section("navbar")
<!-- nav container -->

<section class="p-fixed-top z-1 p-relative">
    <!-- navbar -->
    <nav id="navbar" class="py-3 a-center j-around bg-white">
        <!-- logo -->
        <a href="" class="t-italic t-bold t-4 t-primary t-dancing">
            {{config('app.name')}}
        </a>

        <!-- search -->
        @auth
        <form action="search" method="get" class="d-sm-visible w-2 w-sm-4 w-md-6 d-flex a-center b-gray b-bottom flex-no-wrap">
            @csrf
            <!-- btn -->
            <button type="submit">
                <i class="fas fa-search t-gray-3 fa-lg h-opacity p-2"></i>
            </button>
            <!-- input -->
            <input type="text" name="username" value="{{ old('username') }}" class="w-grow b-none" placeholder="Search">
        </form>
        @endauth

        <!-- links -->
        <div class="d-sm-visible d-flex a-center">
            @guest
            <a href="login" class="mr-5 h-opacity">
                login
            </a>

            <a href="register" class="h-opacity">
                register
            </a>

            @else

            <!-- home -->
            <a href="" class="h-opacity mr-3" title="home">
                <i class="fas fa-home fa-lg"></i>
            </a>

            <!-- explore -->
            <a href="explore" class="h-opacity mr-3" title="explore">
                <i class="far fa-compass fa-lg"></i>
            </a>

            <!-- username dropdown -->
            <span class="js-dropdown-btn">
                <!-- dropdown btn -->
                <div class="p-2 d-flex a-center flex-no-wrap p-relative z-2 h-opacity">
                    <div class="c-2 b-full-gray bg-classic" style="background-image: url('storage/{{ Auth::user()->profile->image }}')"></div>
                    <i class="fas fa-angle-down fa-lg pl-1"></i>
                </div>

                <!-- dropdown box -->
                <div class="js-dropdown-box o-invisible d-none bg-white mt-3">

                    <!-- profile -->
                    <a href="profile/{{ Auth::user()->id }}" class="d-block py-2 px-5 h-opacity">
                        profile
                    </a>

                    <!-- logout -->
                    <div data-form_id="logout_form" class="py-2 px-5 h-opacity js-submit">
                        logout
                    </div>

                    <!-- logout form -->
                    <form id="logout_form" action="logout" class="d-none" method="post">
                        @csrf
                        <button type="submit"></button>
                    </form>
                </div>
            </span>
            @endguest
        </div>

        <!-- nav dropdown btn -->
        <i class="fas fa-bars fa-2x js-nav-dropdown-btn d-sm-none h-opacity"></i>
    </nav>

    <!-- nav dropdown box -->
    <div class="js-nav-dropdown-box ts-hide-top o-invisible d-none h-vh t-3 t-center px-5 bg-white">
        @guest
        <!-- login -->
        <div class="py-2">
            <a href="login" class="h-opacity">
                login
            </a>
        </div>
        <!-- register -->
        <div class="py-2">
            <a href="register" class="h-opacity">
                register
            </a>
        </div>

        @else
        <!-- search -->
        <form action="search" method="get" class="d-flex a-center b-gray b-bottom flex-no-wrap py-1 my-2">
            @csrf
            <!-- btn -->
            <button type="submit">
                <i class="fas fa-search t-gray-3 fa-lg h-opacity p-2"></i>
            </button>
            <!-- input -->
            <input type="text" name="username" value="{{ old('username') }}" class="w-grow b-none" placeholder="Search">
        </form>

        <!-- home -->
        <div class="py-2">
            <a href="" class="h-opacity">
                home
            </a>
        </div>

        <!-- explore -->
        <div class="py-2">
            <a href="explore" class="h-opacity">
                explore
            </a>
        </div>

        <!-- profile -->
        <div class="py-2">
            <a href="profile/{{ Auth::user()->id }}" class="h-opacity">
                profile
            </a>
        </div>
        <!-- logout -->
        <div class="py-2">
            <span data-form_id="logout_form" class="h-opacity js-submit">
                logout
            </span>
        </div>

        @endguest
    </div>

    <!-- msg section -->
    @if(session("msg"))
    <div class="py-2 bg-success t-white pl-5 js-fade-out">
        <i class="fas fa-check-circle pr-2"></i>
        {{session("msg")}}
    </div>
    @endif
</section>

<!-- section antinav -->
<section style="height: 4rem"></section>
@endsection