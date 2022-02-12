@extends("inc/layout")
@extends("inc/navbar")
@section("content")
<section>
    <!-- section user infos -->
    <section class="py-4 d-flex w-11 w-sm-10 w-md-8 mx-auto">

        <!-- image section -->
        <div class="w-4">
            <!-- image -->
            <div style="background-image:url('storage/{{ $user->profile->image }}');" class="b-circle b-full-gray w-lg-6 w-8 mx-auto s-responsive bg-classic"></div>
        </div>
        <!-- text section -->
        <div class="w-8">
            <!-- title -->
            <div class="d-flex a-center j-between">
                <!-- username -->
                <span class="py-2 pr-5 t-4 t-thin">
                    {{$user->username}}
                </span>

                <!-- options -->
                @if(Auth::user()->id == $user->id )
                <div class="py-2">
                    <a href="post/create" class="btn btn-primary btn-small mr-2">
                        <i class="fas fa-plus pr-1"></i>
                        add a post
                    </a>
                    <a href="profile/{{Auth::user()->id}}/edit" class="btn btn-transparent btn-small">
                        edit profile
                    </a>
                </div>

                @else
                <div class="py-2">
                    @if(!$master)
                    <a href="follow/{{ $user->id }}" class="btn btn-primary btn-small">
                        follow
                    </a>
                    @else
                    <form action="follow/{{ $follow_id }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-transparent btn-small">unfollow</button>
                    </form>
                    @endif
                </div>
                @endif
            </div>

            <!-- stats -->
            <div class="py-2 d-flex a-center d-md-visible">
                <!-- posts -->
                <div class="pr-3">
                    <span class="t-bold js-format-int">{{$user->posts->count()}}</span>
                    <span>{{$user->posts->count() > 1 ? "posts" : "post"}}</span>
                </div>
                <!-- followers -->
                <div class="mr-3 h-t-link" onclick="
                document.getElementById('followers').classList.remove('d-none');               ">
                    <span class="t-bold js-format-int">
                        {{ $user->followers->count() }}
                    </span>
                    <span>{{$user->followers->count() > 1 ? "followers" : "follower"}}</span>
                </div>
                <!-- following -->
                <div class="mr-3 h-t-link" onclick="
                document.getElementById('followings').classList.remove('d-none'); 
                ">
                    <span class="t-bold js-format-int">
                        {{$user->masters->count() }}
                    </span>
                    <span>{{$user->masters->count() > 1 ? "followings" : "following"}}</span>
                </div>
            </div>

            <!-- bio -->
            <div class="py-2 d-md-visible t-normal">
                <div class="t-bold">{{$user->profile->title}}</div>
                <div>
                    {{$user->profile->description}}
                </div>
                <div>
                    <a href="{{$user->profile->url}}" target="_blank" class="h-underline t-link t-normal">
                        {{$user->profile->url}}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- lower section -->
    <section class="py-4 w-11 w-sm-10 w-md-8 mx-auto d-md-none">
        <div class="t-bold">{{$user->profile->title}}</div>
        <div>
            {{$user->profile->description}}
        </div>
        <div>
            <a href="{{$user->profile->url}}" target="_blank" class="h-underline t-link t-normal">
                {{$user->profile->url}}
            </a>
        </div>
    </section>

    <!-- stats section -->
    <section class="py-2 b-top b-bottom b-gray d-md-none d-flex a-center t-center">
        <!-- posts -->
        <div class="w-4 b-gray b-right">
            <span class="t-bold js-format-int">{{$user->posts->count()}}</span>
            <span>{{$user->posts->count() > 1 ? "posts" : "post"}}</span>
        </div>
        <!-- followers -->
        <div class="w-4 b-gray b-right">
            <span class="h-t-link" onclick="
                document.getElementById('followers').classList.remove('d-none'); 
                ">
                <span class="t-bold js-format-int">{{$user->followers->count()}}</span>
                <span>{{$user->followers->count() > 1 ? "followers" : "follower"}}</span>
            </span>

        </div>
        <!-- following -->
        <div class="w-4">
            <span class="h-t-link" onclick="
                document.getElementById('followings').classList.remove('d-none'); 
                ">
                <span class="t-bold js-format-int">{{$user->masters->count()}}</span>
                <span>{{$user->masters->count() > 1 ? "followings" : "following"}}</span>
            </span>
        </div>
    </section>

    <!-- section posts -->
    <section class="d-flex a-center w-sm-10 w-md-8 mx-auto">
        @if($user->posts->count() > 0)
        <!-- posts -->
        @foreach($user->posts as $post)
        <div class="p-1 w-4">
            <!-- open details -->
            <div data-id="{{ $post->id }}" data-image="storage/{{ $post->image }}" data-caption="{{ $post->caption }}" data-likes="{{$post->likes->count()}}" class="d-block s-responsive bg-classic h-shadow p-relative" style="background-image:url('storage/{{$post->image}}')" onclick="
            document.getElementById('post').classList.remove('d-none');
            document.getElementById('image').src = this.dataset.image;
            document.getElementById('caption').innerHTML = this.dataset.caption;
            document.getElementById('likes').innerHTML = this.dataset.likes;
            document.getElementById('edit').href = 'post/'+ this.dataset.id + '/edit';
            ">
            </div>
        </div>
        @endforeach
        @else

        <div class="py-5 t-center t-4 w-12">
            no posts available ...
        </div>

        @endif
    </section>
</section>

<!-- section post details -->
<section id="post" class="d-none p-fixed-full z-3 d-center bg-light-transparent">
    <!-- container -->
    <section class="w-md-10 w-lg-8 bg-white b-full-gray mx-auto d-flex">
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
                    <img src="storage/{{ $user->profile->image }}" class="c-2" alt="">
                    <a href="profile/ {{$user->id}}" class="pl-3 t-bold t-dots">
                        {{$user->username}}
                    </a>
                </div>

                <!-- edit post -->
                @if($user->id == Auth::user()->id)
                <a id="edit" href="" title="edit post" class=" h-opacity">
                    <i class="fas fa-ellipsis-v fa-lg"></i>
                </a>
                @endif
            </div>

            <!-- likes -->
            <div class="py-2">
                <div class="d-flex a-center">
                    <!-- icon -->
                    <i class="far fa-heart fa-lg pr-2"></i>

                    <!-- number of likes -->
                    <span id="likes" class="js-int-format t-bold"></span>
                </div>
            </div>

            <!-- caption -->
            <div class="py-2">
                <a href="profile/ {{$user->id}}" class="pr-2 t-bold">
                    {{$user->username}}
                </a>
                <span id="caption" class="t-normal">
                </span>
            </div>
        </div>

    </section>

    <!-- section close -->
    <img src="framework/img/close.png" class="h-3 h-opacity m-2 p-absolute t-0 r-0" alt="" onclick="
            document.getElementById('post').classList.add('d-none');
    ">
</section>

<!-- section followers -->
<section id="followers" class="d-none p-fixed-full z-3 d-center bg-light-transparent">

    <!-- section users -->
    <div class="bg-white b-full-gray w-10 w-sm-8 w-md-5 w-lg-3 px-3 ov-y-scroll p-relative" style="height: 50vh;">

        <!-- section close -->
        <img src="framework/img/close.png" class="h-3 h-opacity m-2 p-absolute t-0 r-0" alt="" onclick="
            document.getElementById('followers').classList.add('d-none');
    ">

        <!-- title -->
        <div class="py-3 d-flex">
            <div class="w-mini bg-primary mr-2"></div>
            <span class="t-uppercase">followers</span>
        </div>

        <!-- users -->
        @if($user->followers->count() > 0)
        @foreach($user->followers as $follow)
        @php
        $follower = $follow->follower;
        @endphp
        <div class="py-2 d-flex a-center">
            <!-- image -->
            <a href="profile/{{ $follower->id }}" class="bg-classic b-full-gray c-2" style="background-image:url('storage/{{$follower->profile->image}}')"></a>
            <!-- followername -->
            <a href="profile/{{ $follower->id }}" class="t-dots pl-3 h-t-link">{{$follower->username}}</a>

        </div>
        @endforeach
        @else
        <div class="pt-2 t-normal">
            no followers so far ...
        </div>
        @endif
    </div>


</section>

<!-- section followings -->
<section id="followings" class="d-none p-fixed-full z-3 d-center bg-light-transparent">

    <!-- section users -->
    <div class="bg-white b-full-gray w-10 w-sm-8 w-md-5 w-lg-3 px-3 ov-y-scroll p-relative" style="height: 50vh;">

        <!-- close btn -->
        <img src="framework/img/close.png" class="h-3 m-2 h-opacity p-absolute t-0 r-0" alt="" onclick="
            document.getElementById('followings').classList.add('d-none');
    ">

        <!-- title -->
        <div class="py-3 d-flex">
            <div class="w-mini bg-primary mr-2"></div>
            <span class="t-uppercase">following</span>
        </div>

        <!-- users -->
        @if($user->masters->count() > 0)
        @foreach($user->masters as $follow)
        @php
        $master = $follow->master;
        @endphp
        <div class="py-2 d-flex a-center">
            <!-- image -->
            <a href="profile/{{ $master->id }}" class="bg-classic b-full-gray c-2" style="background-image:url('storage/{{$master->profile->image}}')"></a>
            <!-- mastername -->
            <a href="profile/{{ $master->id }}" class="t-dots pl-3 h-t-link">{{$master->username}}</a>

        </div>
        @endforeach
        @else
        <div class="pt-2 t-normal">
            no followed users so far ...
        </div>
        @endif
    </div>

</section>
@endsection