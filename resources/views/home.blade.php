@extends("inc/layout")
@extends("inc/navbar")
@section("content")
<section class="w-11 w-sm-10 w-md-8 w-lg-6 mx-auto pt-5">

    <!-- title -->
    <div class="py-3 d-flex">
        <div class="w-mini bg-primary mr-2"></div>
        <span class="t-3 t-uppercase">your feed</span>
    </div>

    <!-- feed -->
    <section>
        @if($feed->count() > 0)
        @foreach($feed as $post)
        <!-- post -->
        <div class="bg-white my-2 b-full-gray">
            <!-- user infos -->
            <div class="d-flex a-center j-between p-2">
                <!-- img & username -->
                <div class="d-flex a-center">
                    <!-- img -->
                    <a href="profile/{{$post->user->id}}" class="c-2 b-full-gray bg-classic h-pointer" style="background-image: url('storage/{{$post->user->profile->image }}');"></a>
                    <!-- username -->
                    <a href="profile/{{$post->user->id}}" class="pl-3 t-bold h-pointer">{{ $post->user->username }}</a>
                </div>

                <!-- date -->
                <span>
                    <span>
                        posted :
                    </span>
                    <span>
                        {{ $post->created_at }}
                    </span>
                </span>
            </div>

            <!-- image -->
            <div class="bg-black d-center">
                <img src="storage/{{ $post->image }}" style="max-width: 100%; max-height: 60vh" alt="">
            </div>

            <!-- caption -->
            <div class="p-2">
                <!-- username -->
                <span class="t-bold pr-2">{{ $post->user->username }}</span>
                <!-- caption -->
                <span>{{$post->caption}}</span>
            </div>

            <!-- likes -->
            <div class="p-2">
                <div class="d-flex a-center">
                    <!-- heart -->
                    @if(Session::has('liked_posts_ids') && session('liked_posts_ids')->contains($post->id))
                    <form action="like/{{ $post->id }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="mr-2">
                            <i class="fas fa-heart fa-lg t-primary"></i>
                        </button>
                    </form>

                    @else
                    <a href="like/{{ $post->id }}" class="mr-2">
                        <i class="far fa-heart fa-lg"></i>
                    </a>

                    @endif

                    <!-- number of likes -->
                    <span class="js-int-format t-bold">{{ $post->likes->count() > 0 ? $post->likes->count() : ""}}</span>

                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="pt-5 t-4 t-center">you are not following anyone, search for some users to follow ...</div>
        @endif
    </section>


</section>
@endsection