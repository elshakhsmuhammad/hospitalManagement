<header class="main-header">
  <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>LT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Admin</b>LTE</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    @include('admin.layouts.menu')
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ url('design/adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ admin()->user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header"></li>

      <li class="treeview {{ active_menu('')[0] }}">
        <a href="#">
          <i class="fa fa-list"></i> <span>{{ trans('admin.dashboard') }}</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('admin')[1] }}">
          <li class=""><a href="{{ aurl('dashboard') }}">
            <i class="fa fa-cog"></i> <span>{{ trans('admin.dashboard') }}</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class=""><a href="{{ aurl('settings') }}">
          <i class="fa fa-cog"></i> <span>{{ trans('admin.settings') }}</span>
          <span class="pull-right-container">
          </span>
        </a>
      </li>
    </ul>
  </li>
  <li class="treeview {{ active_menu('admin')[0] }}">
    <a href="#">
      <i class="fa fa-users"></i> <span>{{ trans('admin.admin') }}</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" style="{{ active_menu('admin')[1] }}">
      <li class=""><a href="{{ aurl('admin') }}"><i class="fa fa-users"></i> {{ trans('admin.admin') }}</a></li>
    </ul>
  </li>
  <li class="treeview {{ active_menu('users')[0] }}">
    <a href="#">
      <i class="fa fa-users"></i> <span>{{ trans('admin.users') }}</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    
     <ul class="treeview-menu" style="{{ active_menu('staff')[1] }}">
      <li class=""><a href="{{ aurl('staff') }}"><i class="fa fa-staff"></i> {{ trans('admin.staff') }}</a></li>
      <li class=""><a href="{{ aurl('staff') }}?job=nursing"><i class="fa fa-staff"></i> {{ trans('admin.nursing') }}</a></li>
      <li class=""><a href="{{ aurl('staff') }}?job=management"><i class="fa fa-staff"></i> {{ trans('admin.management') }}</a></li>
      <li class=""><a href="{{ aurl('staff') }}?job=worker"><i class="fa fa-staff"></i> {{ trans('admin.worker') }}</a></li>
      
    </ul>
  </li>
   <li class="treeview {{ active_menu('countries')[0] }}">
    <a href="#">
      <i class="fa fa-flag"></i> <span>{{ trans('admin.countries') }}</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" style="{{ active_menu('countries')[1] }}">
      <li class=""><a href="{{ aurl('countries') }}"><i class="fa fa-flag"></i> {{ trans('admin.countries') }}</a></li>
      <li class=""><a href="{{ aurl('countries/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
    </ul>
  </li>
  <li class="treeview {{ active_menu('doctors')[0] }}">
    <a href="#">
      <i class="fa fa-flag"></i> <span>{{ trans('admin.doctors') }}</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" style="{{ active_menu('doctors')[1] }}">
      <li class=""><a href="{{ aurl('doctors') }}"><i class="fa fa-flag"></i> {{ trans('admin.doctors') }}</a></li>
      <li class=""><a href="{{ aurl('doctors/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
    </ul>
  </li>
<li class="treeview {{ active_menu('patients')[0] }}">
    <a href="#">
      <i class="fa fa-flag"></i> <span>{{ trans('admin.patients') }}</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" style="{{ active_menu('patients')[1] }}">
      <li class=""><a href="{{ aurl('patients') }}"><i class="fa fa-flag"></i> {{ trans('admin.patients') }}</a></li>
      <li class=""><a href="{{ aurl('patients/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
    </ul>
  </li>
  <li class="treeview {{ active_menu('medicines')[0] }}">
    <a href="#">
      <i class="fa fa-medicine"></i> <span>{{ trans('admin.medicines') }}</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" style="{{ active_menu('medicines')[1] }}">
      <li class=""><a href="{{ aurl('medicines') }}"><i class="fa fa-flag"></i> {{ trans('admin.medicines') }}</a></li>
      <li class=""><a href="{{ aurl('medicines/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
    </ul>
  </li>
      <li class="treeview {{ active_menu('reckonings')[0] }}">
        <a href="#">
          <i class="fa fa-flag"></i> <span>{{ trans('admin.reckonings') }}</span>
          <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('reckonings')[1] }}">
          <li class=""><a href="{{ aurl('reckonings') }}"><i class="fa fa-flag"></i> {{ trans('admin.reckonings') }}</a></li>
          <li class=""><a href="{{ aurl('reckonings/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
        </ul>
      </li>
      <li class="treeview {{ active_menu('examinations')[0] }}">
        <a href="#">
          <i class="fa fa-flag"></i> <span>{{ trans('admin.examinations') }}</span>
          <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('examinations')[1] }}">
          <li class=""><a href="{{ aurl('examinations') }}"><i class="fa fa-flag"></i> {{ trans('admin.examinations') }}</a></li>
          <li class=""><a href="{{ aurl('examinations/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
        </ul>
      </li>
      </li>
      <li class="treeview {{ active_menu('purchases')[0] }}">
        <a href="#">
          <i class="fa fa-flag"></i> <span>{{ trans('admin.purchases') }}</span>
          <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('purchases')[1] }}">
          <li class=""><a href="{{ aurl('purchases') }}"><i class="fa fa-flag"></i> {{ trans('admin.purchases') }}</a></li>
          <li class=""><a href="{{ aurl('purchases/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
        </ul>
      </li>
      </li>
      <li class="treeview {{ active_menu('transactions')[0] }}">
        <a href="#">
          <i class="fa fa-flag"></i> <span>{{ trans('admin.transactions') }}</span>
          <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
        </a>
        <ul class="treeview-menu" style="{{ active_menu('transactions')[1] }}">
          <li class=""><a href="{{ aurl('transactions') }}"><i class="fa fa-flag"></i> {{ trans('admin.transactions') }}</a></li>
          <li class=""><a href="{{ aurl('transactions/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
        </ul>
      </li>
  <li class="treeview {{ active_menu('cities')[0] }}">
    <a href="#">
      <i class="fa fa-flag"></i> <span>{{ trans('admin.cities') }}</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" style="{{ active_menu('cities')[1] }}">
      <li class=""><a href="{{ aurl('cities') }}"><i class="fa fa-flag"></i> {{ trans('admin.cities') }}</a></li>
      <li class=""><a href="{{ aurl('cities/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
    </ul>
  </li>

  <li class="treeview {{ active_menu('states')[0] }}">
    <a href="#">
      <i class="fa fa-flag"></i> <span>{{ trans('admin.states') }}</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" style="{{ active_menu('states')[1] }}">
      <li class=""><a href="{{ aurl('states') }}"><i class="fa fa-flag"></i> {{ trans('admin.states') }}</a></li>
      <li class=""><a href="{{ aurl('states/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
    </ul>
  </li>

  <li class="treeview {{ active_menu('departments')[0] }}">
    <a href="#">
      <i class="fa fa-list"></i> <span>{{ trans('admin.departments') }}</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" style="{{ active_menu('departments')[1] }}">
      <li class=""><a href="{{ aurl('departments') }}"><i class="fa fa-list"></i> {{ trans('admin.departments') }}</a></li>
      <li class=""><a href="{{ aurl('departments/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
    </ul>
  </li>

   <li class="treeview {{ active_menu('trademarks')[0] }}">
    <a href="#">
      <i class="fa fa-cube"></i> <span>{{ trans('admin.trademarks') }}</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" style="{{ active_menu('trademarks')[1] }}">
      <li class=""><a href="{{ aurl('trademarks') }}"><i class="fa fa-cube"></i> {{ trans('admin.trademarks') }}</a></li>
      <li class=""><a href="{{ aurl('trademarks/create') }}"><i class="fa fa-plus"></i> {{ trans('admin.add') }}</a></li>
    </ul>
  </li>


</ul>
</section>
<!-- /.sidebar -->
</aside>