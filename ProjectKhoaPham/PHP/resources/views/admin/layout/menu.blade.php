<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="javascript:;"><i class="fa fa-bar-chart-o fa-fw"></i> The loai<span
                            class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/theloai/danhsach">Danh sach the loai</a>
                    </li>
                    <li>
                        <a href="admin/theloai/them">Them the loai</a>
                    </li>
                    @yield('edit-theloai')
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="javascript:;"><i class="fa fa-cube fa-fw"></i> Loai tin<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/loaitin/danhsach">Danh sach Loai tin</a>
                    </li>
                    <li>
                        <a href="admin/loaitin/them">Them Loai tin</a>
                    </li>
                    @yield('edit-loaitin')
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href=javascript:;><i class="fa fa-cube fa-fw"></i> Tin tuc<span
                            class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/tintuc/danhsach">Danh sach Tin tuc</a>
                    </li>
                    <li>
                        <a href="admin/tintuc/them">Them tin tuc</a>
                    </li>
                    @yield('edit-tintuc')
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="javascript:;"><i class="fa fa-cube fa-fw"></i> Slide<span
                            class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/slide/danhsach">Danh sach slide</a>
                    </li>
                    <li>
                        <a href="admin/slide/them">Them slide</a>
                    </li>
                    @yield('edit-slide')
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="javascript:;"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="admin/user/danhsach">Danh sach nguoi dung</a>
                    </li>
                    <li>
                        <a href="admin/user/them">Them nguoi dung</a>
                    </li>
                    @yield('edit-user')
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>