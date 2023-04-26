<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Admin</span></a>
        </div>
        <div class="clearfix"></div>
        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{asset('admin/img/img.jpg')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br/>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                    @can('show-user')
                    <li><a href="{{route('users.index')}}"><i class="fa fa-user"></i> User</a></li>
                    @endcan
                    @can('show-role')
                    <li><a href="{{route('role.index')}}"><i class="fa fa-cogs"></i> Role</a></li>
                    @endcan
                    <li><a  href="{{route('category.index')}}"><i class="fa fa fa-building-o"></i> Category</a></li>
                    <li><a><i class="fa fa-newspaper-o"></i> Article</a></li>
                    @can('show-slider')
                    <li><a href="{{route('slider.index')}}"><i class="fa fa-sliders"></i> Silders</a></li>
                    @endcan

                    <li><a href="{{route('product.index')}}"><i class="fa fa-product-hunt" aria-hidden="true"></i> Product</a></li>

                </ul>
            </div>
        </div>

    </div>
</div>
