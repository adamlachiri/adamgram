@extends("inc/layout")
@extends("inc/navbar")
@section("content")
<section class="d-flex w-11 mx-auto pt-5">
    <!-- section posts -->
    <section class="w-lg-8">
        <!-- title -->
        <div class="py-3 d-flex">
            <div class="w-mini bg-primary mr-2"></div>
            <span class="t-3 t-uppercase">explore</span>
        </div>

        <!-- posts -->
        @if($posts->count() > 0)
        <div class="d-flex a-center w-12">
            @foreach($posts as $post)
            <div class="p-1 w-4">
                <!-- open details -->
                <div data-id="{{ $post->id }}" data-image="storage/{{ $post->image }}" data-user_id="{{ $post->user->id }}" data-username="{{ $post->user->username }}" data-profile_image="storage/{{ $post->user->profile->image }}" data-caption="{{ $post->caption }}" class="d-block s-responsive bg-classic h-shadow p-relative" style="background-image:url('storage/{{$post->image}}')" onclick="
                document.getElementById('post').classList.remove('d-none');
                document.getElementById('image').src = this.dataset.image;
                document.getElementById('caption').innerHTML = this.dataset.caption;
                document.getElementById('username').innerHTML = this.dataset.username;
                document.getElementById('username').href = 'profile/' + this.dataset.user_id;
                document.getElementById('profile-image').src = this.dataset.profile_image;
                document.getElementById('caption-username').href ='profile/' + this.dataset.user_id;
                document.getElementById('caption-username').innerHTML =this.dataset.username;

                ">
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="pt-2 t-normal">
            Sorry, no posts to explore ...
        </div>
        @endif
    </section>


    <!-- section suggested users -->
    <div class="w-4">
        <section class="pl-5 d-lg-visible p-sticky" style="top: 6rem;">
            <!-- title -->
            <div class="py-3 d-flex flex-no-wrap">
                <div class="w-mini bg-primary mr-2"></div>
                <span class="t-3 t-uppercase">users to follow</span>
            </div>

            <!-- users -->
            @if($suggested_users->count() > 0)
            @foreach($suggested_users as $user)
            <div class="py-2 d-flex a-center j-between">
                <!-- username & image -->
                <div class="d-flex a-center">
                    <!-- image -->
                    <a href="profile/{{ $user->id }}" class="bg-classic b-full-gray c-2" style="background-image:url('storage/{{$user->profile->image}}')"></a>
                    <!-- username -->
                    <a href="profile/{{ $user->id }}" class="t-dots pl-3 h-t-link">{{$user->username}}</a>
                </div>

                <!-- follow btn -->
                <a href="follow/{{ $user->id }}" class="t-link h-underline">follow</a>
            </div>
            @endforeach
            @else
            <div class="pt-2 t-normal">
                Sorry, no suggestions so far ...
            </div>
            @endif
        </section>
    </div>

</section>


<!-- section post details -->
<section id="post" class="d-none p-fixed-full z-3 d-center bg-light-transparent">

    <!-- section close -->
    <img src="framework/img/close.png" class="h-3 h-opacity m-2 p-absolute t-0 r-0" alt="" onclick="
            document.getElementById('post').classList.add('d-none');
    ">

    <!-- container -->
    <section class="w-md-10 w-lg-8 bg-white mx-auto d-flex">
        <!-- image -->
        <div class="w-8 bg-black d-center">
            <img id="image" src="" style="max-height: 80vh; max-width: 100%" alt="">
        </div>

        <!-- text -->
        <div class="w-4 px-3">
            <!-- username -->
            <div class="py-2 d-flex flex-no-wrap a-center j-between b-bottom b-gray">
                <!-- name & img -->
                <div class="d-flex a-center">
                    <img id="profile-image" src="" class="c-2" alt="">
                    <a id="username" href="" class="pl-3 t-bold t-dots">
                    </a>
                </div>


            </div>

            <!-- caption -->
            <div class="py-3">
                <a id="caption-username" href="" class="pr-2 t-bold">
                </a>
                <span id="caption" class="t-normal">
                </span>
            </div>
        </div>

    </section>


</section>

@endsection