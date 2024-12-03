<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials/title-meta', ['title' => $title])
    @yield('css')
    @include('layouts.partials/head-css')
</head>
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
<style>
    * {
        font-family: "Cairo", sans-serif !important;
        /* direction: rtl !important; */
    }
</style>

<body >

    <div class="wrapper">

        @include("layouts.partials/topbar", ['title' => $title])
        @include('layouts.partials/main-nav')

        <div class="page-content">

            <div class="container-fluid">
                @yield('content')
            </div>

            @include("layouts.partials/footer")

        </div>

    </div>

    @include("layouts.partials/right-sidebar")
    @include("layouts.partials/footer-scripts")
    @vite(['resources/js/app.js','resources/js/layout.js'])

</body>

</html>