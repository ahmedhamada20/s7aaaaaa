<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('admin.layouts.head')
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    @include('admin.layouts.Sidebar')

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            @include('admin.layouts.Topbar')
            <div class="container-fluid">
                @yield('content')
            </div>

        </div>

        @include('admin.layouts.footer')

    </div>

</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

@include('admin.layouts.footerJs')
</body>

</html>
