@extends('inc/layout')
@extends('inc/navbar')

@section('content')
<section class="pt-5 w-sm-8 mx-auto">
    <form action="post" method="post" enctype="multipart/form-data" class="b-full-gray w-md-8 w-10 mx-auto bg-white">
        @csrf
        <!-- title -->
        <div class="pl-5 t-3 py-3 bg-gray-1">
            add a post
        </div>

        <!-- inputs -->
        <section class="px-5">
            <!-- caption -->
            <section class="pt-3">
                <!-- title -->
                <div class="t-bold">
                    caption
                </div>
                <!-- input -->
                <div class="pt-2">
                    <input type="text" class="f-b-shadow-link w-12 @error('caption') b-alert @enderror" name="caption" value="{{ old('caption') }}" autocomplete="caption" autofocus>
                </div>
                <!-- error msg -->
                @error("caption")
                <div class="t-alert pt-1">
                    {{$message}}
                </div>
                @enderror
            </section>


            <!-- image -->
            <section class="pt-3">
                <!-- title -->
                <div class="t-bold">
                    image
                </div>
                <!-- input -->
                <div class="pt-2">
                    <input type="file" name="image" value="{{ old('image') }}" autocomplete="image" autofocus>
                </div>
                <!-- error msg -->
                @error("image")
                <div class="t-alert pt-1">
                    {{$message}}
                </div>
                @enderror
            </section>



            <!-- btn -->
            <div class="py-4">
                <!-- btn -->
                <button class="btn btn-primary btn-medium">add post</button>
            </div>
        </section>
    </form>
</section>
@endsection