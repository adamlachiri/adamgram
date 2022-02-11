@extends("inc/layout")
@extends("inc/navbar")
@section("content")
<section class="w-11 w-sm-10 w-md-8 w-lg-6 mx-auto">
    <!-- list -->
    <div class="pt-5">
        @if($users->count() > 0)
        @foreach($users as $user)
        <div class="d-flex a-center j-between pt-3 t-bold">

            <!-- image & name -->
            <div class="d-flex a-center">
                <!-- image -->
                <a href="profile/{{ $user->id }}" class="c-3 bg-classic mr-4" style="background-image:url('storage/{{ $user->profile->image }}')"></a>
                <!-- name -->
                <a href="profile/{{ $user->id }}">
                    {{ $user->username}}
                </a>
            </div>

            <!-- check if user is master -->
            @php
            $is_follower = false;
            $follow_id = null;
            foreach($user->followers as $follow) {
            if($follow->follower_id == Auth::user()->id) {
            $is_follower = true;
            $follow_id = $follow->id;
            break;
            }
            }
            @endphp

            <!-- follow -->
            @if($user->id !== Auth::user()->id)
            <div>
                @if($is_follower)
                <form action="follow/{{ $follow_id }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-transparent btn-small">unfollow</button>
                </form>
                @else
                <a href="follow/{{ $user->id }}" class="btn btn-primary btn-small">
                    follow
                </a>
                @endif
            </div>
            @endif

        </div>
        @endforeach
        @else
        <div class="pt-5 t-4 t-center">
            no users found ...
        </div>
        @endif
    </div>

</section>
@endsection