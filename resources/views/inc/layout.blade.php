<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- icons -->
    <script src="https://kit.fontawesome.com/a9984945c1.js" crossorigin="anonymous"></script>

    <!-- base -->
    <base href="{{ config('app.url') }}">

    <!-- css -->
    <link rel="stylesheet" href="framework/css/index.css">

    <title>{{config('app.name')}}</title>
</head>

<body class="bg-gray-1 t-open t-capitalize">

    <!-- loading -->
    <section class="js-loading bg-gray-1">
        <div class="t-primary t-center">
            <h1 class="t-bold t-dancing t-5">
                {{config('app.name')}}
            </h1>
            <p class="pt-3">Loading . . .</p>
        </div>
    </section>

    <!-- navbar -->
    @yield("navbar")

    <!-- content -->
    @yield("content")


    <!-- footer -->
    <footer class="">
    </footer>
</body>
<script src="framework/js/index.js" type="module"></script>

</html>