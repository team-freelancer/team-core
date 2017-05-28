<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin Control Manager</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="stylesheet" href="{{ asset('public/vendor/admin/css/bootstrap.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('public/vendor/admin/css/AdminLTE.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('public/vendor/admin/css/dataTables.bootstrap.css') }}"/>
  <link rel="stylesheet" href="{{ asset('public/vendor/admin/css/font-awesome.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('public/vendor/admin/css/skin-red.css') }}"/>
  <link rel="stylesheet" href="{{ asset('public/vendor/admin/plugins/file-input/css/fileinput.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('public/vendor/admin/css/custom.css') }}"/>
  <link href="{{ asset('public/vendor/admin/css/blue.css')}}" rel="stylesheet" type="text/css" />
  <!-- script -->
  <script>var baseUrl = '{{ url("admin") }}'</script>
  <script src="{{ asset('public/vendor/admin/js/jquery.min.js') }}"></script>
  <script src="{{ asset('public/vendor/admin/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('public/vendor/admin/js/dataTables.bootstrap.js') }}"></script>
  <script src="{{ asset('public/vendor/admin/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/vendor/admin/plugins/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('public/vendor/admin/js/config.js') }}"></script>
  <script src="{{ asset('public/vendor/admin/js/app.min.js') }}"></script>
  {{-- <script src="{{ asset('public/vendor/admin/js/require.js') }}"></script> --}}
  <script src="{{ asset('public/vendor/admin/js/icheck.min.js') }}"></script>
  <script src="{{ asset('public/vendor/admin/plugins/file-input/js/fileinput.min.js') }}"></script>
  <script src="{{ asset('public/vendor/admin/js/core.js') }}"></script>

</head>
<body>
  <div class="skin-red">
    <div class="wrapper">
      
      @include('admin::_partials.header')

      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ !empty($admin->avatar) && $admin->avatar != '[]' ? asset(json_decode($admin->avatar)[0]->thumb) : asset('public/vendor/admin/img/avatar_default.jpg') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>{{ $admin->name }}</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Trực tuyến</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Tìm kiếm..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          @include('admin::_partials.sidebar')
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          @yield('content')
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0 build with Laravel 5.4 and <i class="text-danger fa fa-heart"></i>
        </div>
        <strong>Copyright &copy; 2017 <a href="#">My Team</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->
  </div>

  
</body>
</html>
