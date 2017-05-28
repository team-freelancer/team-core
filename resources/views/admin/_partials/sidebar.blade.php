<li class="treeview team-cars">
    <a href="#">
    <i class="fa fa-car"></i>
    <span>Hãng xe</span>
    </a>
    <ul class="treeview-menu">
    <li><a href="{{ url('admin/category/cars') }}"><i class="fa fa-circle-o text-danger"></i> Danh sách</a></li>
    <li><a href="{{ url('admin/category/cars/create') }}"><i class="fa fa-circle-o text-danger"></i> Thêm</a></li>
    </ul>
</li>
<li class="treeview team-groups">
    <a href="#">
    <i class="fa fa-folder"></i>
    <span>Nhóm</span>
    </a>
    <ul class="treeview-menu">
    <li><a href="{{ url('admin/category/groups') }}"><i class="fa fa-circle-o text-danger"></i> Danh sách</a></li>
    <li><a href="{{ url('admin/category/groups/create') }}"><i class="fa fa-circle-o text-danger"></i> Thêm</a></li>
    </ul>
</li>
<li class="treeview team-adapters">
    <a href="#">
    <i class="fa fa-gear"></i>
    <span>Phụ tùng</span>
    </a>
    <ul class="treeview-menu">
    <li><a href="{{ url('admin/category/adapters') }}"><i class="fa fa-circle-o text-danger"></i> Danh sách</a></li>
    <li><a href="{{ url('admin/category/adapters/create') }}"><i class="fa fa-circle-o text-danger"></i> Thêm</a></li>
    </ul>
</li>

<li class="treeview team-product">
    <a href="#">
    <i class="fa fa-wrench"></i>
    <span>Sản phẩm</span>
    </a>
    <ul class="treeview-menu">
    <li><a href="{{ url('admin/product') }}"><i class="fa fa-circle-o text-danger"></i> Danh sách</a></li>
    <li><a href="{{ url('admin/product/create') }}"><i class="fa fa-circle-o text-danger"></i> Thêm</a></li>
    </ul>
</li>
<li class="treeview team-new">
    <a href="#">
    <i class="fa fa-newspaper-o"></i>
    <span>Tin tức</span>
    </a>
    <ul class="treeview-menu">
    <li><a href="{{ url('admin/new') }}"><i class="fa fa-circle-o text-danger"></i> Danh sách</a></li>
    <li><a href="{{ url('admin/new/create') }}"><i class="fa fa-circle-o text-danger"></i> Thêm</a></li>
    </ul>
</li>
<li class="header">Cấu hình</li>
<li class="treeview team-cart">
    <a href="{{ url('admin/cart') }}">
    <i class="fa fa-truck"></i>
    <span>Quản lý đơn hàng</span>
    </a>
</li>
<li class="treeview team-config">
    <a href="{{ url('admin/config') }}">
    <i class="fa fa-gears"></i>
    <span>Cấu Hình Website</span>
    </a>
</li>