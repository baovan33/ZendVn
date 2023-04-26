<!DOCTYPE html>
<html lang="en">

@include('admin.elements.header')
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        @include('admin.elements.sidebar')
        <!-- top navigation -->
        <div class="top_nav">
           @include('admin.elements.top_nav')
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
             @yield('content')
        </div>
        <!-- /page content -->

       @include('admin.elements.footer')

    </div>
</div>
@include('admin.elements.script')
</body>
</html>
