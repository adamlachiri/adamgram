@extends('inc/layout')
@extends('inc/navbar')

@section('content')
<section class="pt-5">
    <form action="register" method="post" class="w-11 w-10 w-md-8 w-lg-6 mx-auto b-full-gray bg-white">
        @csrf
        <!-- title -->
        <div class="pl-5 t-3 py-3 bg-gray-1">
            register
        </div>

        <!-- inputs -->
        <section class="px-5">
            <!-- name -->
            <div class="d-flex pt-4 a-center">
                <!-- title -->
                <div class="w-4 pr-5 t-end ">
                    name
                </div>
                <!-- input -->
                <input type="text" class="w-8 @error('name') b-alert @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>
            <!-- error msg -->
            @error("name")
            <div class="t-alert pt-1 w-8 ml-auto">
                {{$message}}
            </div>
            @enderror

            <!-- email -->
            <div class="d-flex pt-4 a-center">
                <!-- title -->
                <div class="w-4 pr-5 t-end ">
                    email
                </div>
                <!-- input -->
                <input type="email" class="w-8 @error('email') b-alert @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>
            <!-- error msg -->
            @error("email")
            <div class="t-alert pt-1 w-8 ml-auto">
                {{$message}}
            </div>
            @enderror

            <!-- username -->
            <div class="d-flex pt-4 a-center">
                <!-- title -->
                <div class="w-4 pr-5 t-end ">
                    username
                </div>
                <!-- input -->
                <input type="text" class="w-8 @error('username') b-alert @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
            </div>
            <!-- error msg -->
            @error("username")
            <div class="t-alert pt-1 w-8 ml-auto">
                {{$message}}
            </div>
            @enderror

            <!-- password -->
            <div class="d-flex pt-4 a-center">
                <!-- title -->
                <div class="w-4 pr-5 t-end ">
                    password
                </div>
                <!-- input -->
                <input type="password" class="w-8 @error('password') b-alert @enderror" name="password" required autocomplete="new-password">
            </div>
            <!-- error msg -->
            @error("password")
            <div class="t-alert pt-1 w-8 ml-auto">
                {{$message}}
            </div>
            @enderror

            <!-- confirm password -->
            <div class="d-flex pt-4 a-center">
                <!-- title -->
                <div class="w-4 pr-5 t-end ">
                    confirm your password
                </div>
                <!-- input -->
                <input type="password" class="w-8 @error('password') b-alert @enderror" name="password_confirmation" required autocomplete="new-password">
            </div>
            <!-- error msg -->
            @error("password_confirmation")
            <div class="t-alert pt-1 w-8 ml-auto">
                {{$message}}
            </div>
            @enderror

            <!-- btn -->
            <div class="d-center py-4">
                <!-- btn -->
                <button class="btn btn-primary btn-medium">register</button>

                <!-- have account -->
                <a class="pl-3 t-link h-underline" href="login">
                    already have an account ?
                </a>
            </div>
        </section>
    </form>

</section>
@endsection