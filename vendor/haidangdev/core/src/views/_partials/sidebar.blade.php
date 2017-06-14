<ul class="sidebar-menu">
  @if($admin->role->super_admin)
  <li class="header">SUPER ADMIN</li>
  <li class="treeview team-module">
    <a href="#">
      <i class="fa fa-cubes"></i>
      <span>Module</span>
      <span class="label label-primary pull-right"></span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ url('admin/module') }}"><i class="fa fa-list text-danger"></i> Danh sách</a></li>
      <li><a href="{{ url('admin/module/create') }}"><i class="fa fa-plus-square text-danger"></i> Thêm</a></li>
    </ul>
  </li>
  <li class="treeview team-role">
      <a href="#">
        <i class="fa fa-key"></i>
        <span>Quyền</span>
        <span class="label label-primary pull-right"></span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ url('admin/role') }}"><i class="fa fa-list text-danger"></i> Danh sách</a></li>
        <li><a href="{{ url('admin/role/create') }}"><i class="fa fa-plus-square text-danger"></i> Thêm</a></li>
      </ul>
  </li>
  <li class="treeview team-manager">
      <a href="#">
        <i class="fa fa-users"></i>
        <span>Admin</span>
        <span class="label label-primary pull-right"></span>
      </a>
      <ul class="treeview-menu">
        <li><a href="{{ url('admin/manager') }}"><i class="fa fa-list text-danger"></i> Danh sách</a></li>
        <li><a href="{{ url('admin/manager/create') }}"><i class="fa fa-plus-square text-danger"></i> Thêm</a></li>
      </ul>
  </li>
  @endif
  <li class="header">ADMIN NORMAL</li>
  <li class="treeview team-module-item">
    <a href="#">
      <i class="fa fa-tasks"></i>
      <span>Quản lý các module</span>
      <span class="label label-primary pull-right"></span>
    </a>
    <ul class="treeview-menu">
      @foreach($team_modules as $module)
      <li>
        <a href="#"><i class="{{ $module->icon ? $module->icon : 'fa fa-circle-o text-danger' }}"></i> {{ $module->name }} <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu team-child-{{$module->path}}">
          <li><a href="{{ url('admin/module/'.$module->path) }}"><i class="fa fa-list text-danger"></i> Danh sách</a></li>
          <li><a href="{{ url('admin/module/'.$module->path.'/create') }}"><i class="fa fa-plus-square text-danger"></i> Thêm</a></li>
        </ul>
      </li>
      @endforeach
    </ul>
  </li>
    @includeIf('admin._partials.sidebar')
</ul>
<script>
  var activeMenu = '{{isset($active) ? $active : "index"}}',
      activeChild = '{{isset($activeChild) ? $activeChild : "default"}}';
</script>