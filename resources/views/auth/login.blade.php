@extends('inc/layout')
@extends('inc/navbar')

@section('content')
<section class="pt-5">
    <form action="login" method="post" class="w-10 w-md-8 w-lg-6 mx-auto b-full-gray bg-white">
        @csrf
        <!-- title -->
        <div class="pl-5 t-3 py-3 bg-gray-1">
            <div>login</div>
            <div style="text-transform: lowercase; font-weight: 200" class="pt-1 t-2">use the Credentials in the placeholders to login</div>
        </div>

        <!-- inputs -->
        <section class="px-5">
            <!-- email -->
            <section>
                <div class="d-flex pt-4 a-center">
                    <!-- title -->
                    <div class="w-4 pr-5 t-end ">
                        email
                    </div>
                    <!-- input -->
                    <input type="email" class="w-8 @error('email') b-alert @enderror" name="email" value="guest@gmail.com" required autocomplete="email" autofocus>
                </div>
                <!-- error msg -->
                @error("email")
                <div class="w-8 ml-auto t-alert pt-1">
                    {{$message}}
                </div>
                @enderror
            </section>


            <!-- password -->
            <section>
                <div class="d-flex pt-4 a-center">
                    <!-- title -->
                    <div class="w-4 pr-5 t-end ">
                        password
                    </div>
                    <!-- input -->
                    <input value="123456789" type="password" class="w-8 @error('password') b-alert @enderror" name="password" required autocomplete="current-password">
                </div>
                <!-- error msg -->
                @error("password")
                <div class="w-8 ml-auto t-alert pt-1">
                    {{$message}}
                </div>
                @enderror
            </section>


            <!-- remember me -->
            <div class="pt-4 w-8 ml-auto">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="pl-2">remember me</span>
            </div>



            <!-- btn -->
            <div class="d-center py-4">
                <!-- btn -->
                <button class="btn btn-primary btn-medium">login</button>

                <!-- forgot password -->
                @if (Route::has('password.request'))
                <a class="t-link h-underline pl-3" href="{{ route('password.request') }}">
                    forgot your password ?
                </a>
                @endif
            </div>
        </section>
    </form>
</section>
@endsection