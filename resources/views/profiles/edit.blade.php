@extends('inc/layout')
@extends('inc/navbar')

@section('content')
<section class="pt-5">
    <form action="profile/{{$user->id}}" method="post" enctype="multipart/form-data" class="w-10 w-md-8 w-lg-6 mx-auto b-full-gray bg-white">
        @csrf
        @method("put")
        <!-- title -->
        <div class="pl-5 t-3 py-3 bg-gray-1">
            edit profile
        </div>

        <!-- inputs -->
        <section class="px-5">
            <!-- title -->
            <div class="d-flex pt-4 a-center">
                <!-- title -->
                <div class="w-4 pr-5 t-end ">
                    title
                </div>
                <!-- input -->
                <input type="text" class="w-8 @error('title') b-alert @enderror" name="title" value="{{ old('title') ?? $user->profile->title}}" autocomplete="title" autofocus>
            </div>
            <!-- error msg -->
            @error("title")
            <div class="t-alert pt-1 w-8 ml-auto">
                {{$message}}
            </div>
            @enderror

            <!-- description -->
            <div class="d-flex pt-4 a-center">
                <!-- title -->
                <div class="w-4 pr-5 t-end ">
                    description
                </div>
                <!-- input -->
                <textarea name="description" class="w-8 @error('description') b-alert @enderror" rows=5>{{ old('description') ?? $user->profile->description }}</textarea>
            </div>
            <!-- error msg -->
            @error("description")
            <div class="t-alert pt-1 w-8 ml-auto">
                {{$message}}
            </div>
            @enderror

            <!-- url -->
            <div class="d-flex pt-4 a-center">
                <!-- title -->
                <div class="w-4 pr-5 t-end ">
                    url
                </div>
                <!-- input -->
                <input type="text" class="w-8 @error('url') b-alert @enderror" name="url" value="{{ old('url') ?? $user->profile->url}}" autocomplete="url" autofocus>
            </div>
            <!-- error msg -->
            @error("url")
            <div class="t-alert pt-1 w-8 ml-auto">
                {{$message}}
            </div>
            @enderror

            <!-- image -->
            <div class="d-flex pt-4 a-center">
                <!-- title -->
                <div class="w-4 pr-5 t-end ">
                    profile image
                </div>
                <!-- input -->
                <input type="file" name="image" value="{{ old('image') }}" autocomplete="image" autofocus>
            </div>
            <!-- error msg -->
            @error("image")
            <div class="t-alert pt-1 w-8 ml-auto">
                {{$message}}
            </div>
            @enderror


            <!-- btn -->
            <div class="d-center py-4">
                <button class="btn btn-primary btn-medium">save changes</button>
            </div>
        </section>
    </form>

</section>
@endsection