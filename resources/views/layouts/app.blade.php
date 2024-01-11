<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />
    <title>CFPT Digital</title>
    @vite('resources/js/app.js')
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="/fonts/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/fonts/font-awesome/v6/css/all.css" rel="stylesheet" type="text/css" />
    <link href="/fonts/material-design-icons/material-icon.css" rel="stylesheet" type="text/css" />
    <!--bootstrap -->
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/summernote/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/plugins/flatpicker/css/flatpickr.min.css" />
    <!-- Material Design Lite CSS -->
    <link rel="stylesheet" href="/assets/plugins/material/material.min.css">
    <link rel="stylesheet" href="/assets/css/material_style.css">
    <!-- inbox style -->
    <link href="/assets/css/pages/inbox.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme Styles -->
    <link href="/assets/css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
    <link href="/assets/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/theme/light/style.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/pages/formlayout.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/theme/light/theme-color.css" rel="stylesheet" type="text/css" />
    <!-- dropzone -->
    <link href="/assets/plugins/dropzone/dropzone.css" rel="stylesheet" media="screen">
    <!-- data tables -->
    <link href="/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <!-- favicon -->
    <link rel="shortcut icon" href="/assets/img/logoCFPT--clr" />
</head>
<!-- END HEAD -->

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
    <div class="page-wrapper">
        <!-- start header -->
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <!-- logo start -->
                <div class="page-logo">
                    <a href="{{ route('admin_index') }}">
                        <span class="logo-icon material-icons fa-rotate-45">school</span>
                        <span class="logo-default">DFC</span> </a>
                </div>
                <!-- logo end -->
                <ul class="nav navbar-nav navbar-left in">
                    <li><a href="#" class="menu-toggler sidebar-toggler"><i data-feather="menu"></i></a></li>
                </ul>
                <form class="search-form-opened" action="#" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." name="query">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
                <!-- start mobile menu -->
                <a class="menu-toggler responsive-toggler" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                    <span></span>
                </a>
                <!-- end mobile menu -->
                <!-- start header menu -->
                @include('layouts.header')
                <!-- end header -->
                <!-- start color quick setting -->
                <div class="settingSidebar">
                    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
                    </a>
                    <div class="settingSidebar-body ps-container ps-theme-default">
                        <div class=" fade show active">
                            <div class="setting-panel-header">Setting Panel
                            </div>
                            <div class="quick-setting slimscroll-style">
                                <ul id="themecolors">
                                    <li>
                                        <p class="sidebarSettingTitle">Sidebar Color</p>
                                    </li>
                                    <li class="complete">
                                        <div class="theme-color sidebar-theme">
                                            <a href="#" data-theme="white"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="dark"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="blue"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="indigo"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="cyan"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="green"><span class="head"></span><span
                                                    class="cont"></span></a>
                                            <a href="#" data-theme="red"><span class="head"></span><span
                                                    class="cont"></span></a>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="sidebarSettingTitle">Header Brand color</p>
                                    </li>
                                    <li class="theme-option">
                                        <div class="theme-color logo-theme">
                                            <a href="#" data-theme="logo-white"><span
                                                    class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="logo-dark"><span
                                                    class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="logo-blue"><span
                                                    class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="logo-indigo"><span
                                                    class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="logo-cyan"><span
                                                    class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="logo-green"><span
                                                    class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="logo-red"><span class="head"></span><span
                                                    class="cont"></span></a>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="sidebarSettingTitle">Header color</p>
                                    </li>
                                    <li class="theme-option">
                                        <div class="theme-color header-theme">
                                            <a href="#" data-theme="header-white"><span
                                                    class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="header-dark"><span
                                                    class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="header-blue"><span
                                                    class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="header-indigo"><span
                                                    class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="header-cyan"><span
                                                    class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="header-green"><span
                                                    class="head"></span><span class="cont"></span></a>
                                            <a href="#" data-theme="header-red"><span
                                                    class="head"></span><span class="cont"></span></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end color quick setting -->
                <!-- start page container -->
                <div class="page-container">
                    <!-- start sidebar menu -->
                    @include('layouts.navbar')
                    <!-- end sidebar menu -->
                    <!-- start page content -->
                    @yield('content')
                    <!-- end page content -->
                    <!-- start chat sidebar -->
                    <div class="chat-sidebar-container" data-close-on-body-click="false">
                        <div class="chat-sidebar">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#quick_sidebar_tab_1" class="nav-link active tab-icon"
                                        data-bs-toggle="tab"> <i class="material-icons">chat</i>Chat
                                        <span class="badge badge-danger">4</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#quick_sidebar_tab_3" class="nav-link tab-icon" data-bs-toggle="tab">
                                        <i class="material-icons">settings</i>
                                        Settings
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- Start Doctor Chat -->
                                <div class="tab-pane active chat-sidebar-chat in active show" role="tabpanel"
                                    id="quick_sidebar_tab_1">
                                    <div class="chat-sidebar-list">
                                        <div class="chat-sidebar-chat-users slimscroll-style" data-rail-color="#ddd"
                                            data-wrapper-class="chat-sidebar-list">
                                            <div class="chat-header">
                                                <h5 class="list-heading">Online</h5>
                                            </div>
                                            <ul class="media-list list-items">
                                                <li class="media"><img class="media-object"
                                                        src="/assets/img/user/user3.jpg" width="35"
                                                        height="35" alt="...">
                                                    <i class="online dot"></i>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">John Deo</h5>
                                                        <div class="media-heading-sub">Spine Surgeon</div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <div class="media-status">
                                                        <span class="badge badge-success">5</span>
                                                    </div> <img class="media-object" src="/assets/img/user/user1.jpg"
                                                        width="35" height="35" alt="...">
                                                    <i class="busy dot"></i>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">Rajesh</h5>
                                                        <div class="media-heading-sub">Director</div>
                                                    </div>
                                                </li>
                                                <li class="media"><img class="media-object"
                                                        src="/assets/img/user/user5.jpg" width="35"
                                                        height="35" alt="...">
                                                    <i class="away dot"></i>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">Jacob Ryan</h5>
                                                        <div class="media-heading-sub">Ortho Surgeon</div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <div class="media-status">
                                                        <span class="badge badge-danger">8</span>
                                                    </div> <img class="media-object" src="/assets/img/user/user4.jpg"
                                                        width="35" height="35" alt="...">
                                                    <i class="online dot"></i>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">Kehn Anderson</h5>
                                                        <div class="media-heading-sub">CEO</div>
                                                    </div>
                                                </li>
                                                <li class="media"><img class="media-object"
                                                        src="/assets/img/user/user2.jpg" width="35"
                                                        height="35" alt="...">
                                                    <i class="busy dot"></i>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">Sarah Smith</h5>
                                                        <div class="media-heading-sub">Anaesthetics</div>
                                                    </div>
                                                </li>
                                                <li class="media"><img class="media-object"
                                                        src="/assets/img/user/user7.jpg" width="35"
                                                        height="35" alt="...">
                                                    <i class="online dot"></i>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">Vlad Cardella</h5>
                                                        <div class="media-heading-sub">Cardiologist</div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="chat-header">
                                                <h5 class="list-heading">Offline</h5>
                                            </div>
                                            <ul class="media-list list-items">
                                                <li class="media">
                                                    <div class="media-status">
                                                        <span class="badge badge-warning">4</span>
                                                    </div> <img class="media-object" src="/assets/img/user/user6.jpg"
                                                        width="35" height="35" alt="...">
                                                    <i class="offline dot"></i>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">Jennifer Maklen</h5>
                                                        <div class="media-heading-sub">Nurse</div>
                                                        <div class="media-heading-small">Last seen 01:20 AM</div>
                                                    </div>
                                                </li>
                                                <li class="media"><img class="media-object"
                                                        src="/assets/img/user/user8.jpg" width="35"
                                                        height="35" alt="...">
                                                    <i class="offline dot"></i>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">Lina Smith</h5>
                                                        <div class="media-heading-sub">Ortho Surgeon</div>
                                                        <div class="media-heading-small">Last seen 11:14 PM</div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <div class="media-status">
                                                        <span class="badge badge-success">9</span>
                                                    </div> <img class="media-object" src="/assets/img/user/user9.jpg"
                                                        width="35" height="35" alt="...">
                                                    <i class="offline dot"></i>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">Jeff Adam</h5>
                                                        <div class="media-heading-sub">Compounder</div>
                                                        <div class="media-heading-small">Last seen 3:31 PM</div>
                                                    </div>
                                                </li>
                                                <li class="media"><img class="media-object"
                                                        src="/assets/img/user/user10.jpg" width="35"
                                                        height="35" alt="...">
                                                    <i class="offline dot"></i>
                                                    <div class="media-body">
                                                        <h5 class="media-heading">Anjelina Cardella</h5>
                                                        <div class="media-heading-sub">Physiotherapist</div>
                                                        <div class="media-heading-small">Last seen 7:45 PM</div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Doctor Chat -->
                                <!-- Start Setting Panel -->
                                <div class="tab-pane chat-sidebar-settings" role="tabpanel" id="quick_sidebar_tab_3">
                                    <div class="chat-sidebar-settings-list slimscroll-style">
                                        <div class="chat-header">
                                            <h5 class="list-heading">Layout Settings</h5>
                                        </div>
                                        <div class="chatpane inner-content ">
                                            <div class="settings-list">
                                                <div class="setting-item">
                                                    <div class="setting-text">Sidebar Position</div>
                                                    <div class="setting-set">
                                                        <select
                                                            class="sidebar-pos-option form-control input-inline input-sm input-small ">
                                                            <option value="left" selected="selected">Left</option>
                                                            <option value="right">Right</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="setting-item">
                                                    <div class="setting-text">Header</div>
                                                    <div class="setting-set">
                                                        <select
                                                            class="page-header-option form-control input-inline input-sm input-small ">
                                                            <option value="fixed" selected="selected">Fixed
                                                            </option>
                                                            <option value="default">Default</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="setting-item">
                                                    <div class="setting-text">Footer</div>
                                                    <div class="setting-set">
                                                        <select
                                                            class="page-footer-option form-control input-inline input-sm input-small ">
                                                            <option value="fixed">Fixed</option>
                                                            <option value="default" selected="selected">Default
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chat-header">
                                                <h5 class="list-heading">Account Settings</h5>
                                            </div>
                                            <div class="settings-list">
                                                <div class="setting-item">
                                                    <div class="setting-text">Notifications</div>
                                                    <div class="setting-set">
                                                        <div class="switch">
                                                            <label
                                                                class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                                for="switch-1">
                                                                <input type="checkbox" id="switch-1"
                                                                    class="mdl-switch__input" checked>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setting-item">
                                                    <div class="setting-text">Show Online</div>
                                                    <div class="setting-set">
                                                        <div class="switch">
                                                            <label
                                                                class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                                for="switch-7">
                                                                <input type="checkbox" id="switch-7"
                                                                    class="mdl-switch__input" checked>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setting-item">
                                                    <div class="setting-text">Status</div>
                                                    <div class="setting-set">
                                                        <div class="switch">
                                                            <label
                                                                class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                                for="switch-2">
                                                                <input type="checkbox" id="switch-2"
                                                                    class="mdl-switch__input" checked>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setting-item">
                                                    <div class="setting-text">2 Steps Verification</div>
                                                    <div class="setting-set">
                                                        <div class="switch">
                                                            <label
                                                                class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                                for="switch-3">
                                                                <input type="checkbox" id="switch-3"
                                                                    class="mdl-switch__input" checked>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chat-header">
                                                <h5 class="list-heading">General Settings</h5>
                                            </div>
                                            <div class="settings-list">
                                                <div class="setting-item">
                                                    <div class="setting-text">Location</div>
                                                    <div class="setting-set">
                                                        <div class="switch">
                                                            <label
                                                                class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                                for="switch-4">
                                                                <input type="checkbox" id="switch-4"
                                                                    class="mdl-switch__input" checked>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setting-item">
                                                    <div class="setting-text">Save Histry</div>
                                                    <div class="setting-set">
                                                        <div class="switch">
                                                            <label
                                                                class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                                for="switch-5">
                                                                <input type="checkbox" id="switch-5"
                                                                    class="mdl-switch__input" checked>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setting-item">
                                                    <div class="setting-text">Auto Updates</div>
                                                    <div class="setting-set">
                                                        <div class="switch">
                                                            <label
                                                                class="mdl-switch mdl-js-switch mdl-js-ripple-effect"
                                                                for="switch-6">
                                                                <input type="checkbox" id="switch-6"
                                                                    class="mdl-switch__input" checked>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end chat sidebar -->
                </div>
                <!-- end page container -->
                <!-- start footer -->
                @include('layouts.footer')
                <!-- end footer -->
            </div>
            <!-- start js include path -->
            <script src="/assets/plugins/jquery/jquery.min.js"></script>
            <script src="/assets/plugins/popper/popper.js"></script>
            <script src="/assets/plugins/jquery-blockui/jquery.blockui.min.js"></script>
            <script src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
            <script src="/assets/plugins/feather/feather.min.js"></script>
            <!-- bootstrap -->
            <script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
            <script src="/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
            <script src="/assets/plugins/sparkline/jquery.sparkline.js"></script>
            <script src="/assets/js/pages/sparkline/sparkline-data.js"></script>
            <script src="/assets/plugins/flatpicker/js/flatpicker.min.js"></script>
            <script src="/assets/js/pages/date-time/date-time.init.js"></script>
            <!-- Common js-->
            <script src="/assets/js/app.js"></script>
            <script src="/assets/js/layout.js"></script>
            <script src="/assets/js/theme-color.js"></script>
            <!-- material -->
            <script src="/assets/plugins/material/material.min.js"></script>
            <script src="/assets/js/pages/material-select/getmdl-select.js"></script>
            <!--apex chart-->
            <script src="/assets/plugins/apexcharts/apexcharts.min.js"></script>
            <script src="/assets/js/pages/chart/apex/home-data.js"></script>
            <!-- summernote -->
            <script src="/assets/plugins/summernote/summernote.js"></script>
            <script src="/assets/js/pages/summernote/summernote-data.js"></script>
            <!-- dropzone -->
            <script src="/assets/plugins/dropzone/dropzone.js"></script>
            <script src="/assets/plugins/dropzone/dropzone-call.js"></script>
            <!-- data tables -->
          {{--   <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap5.min.js"></script>
            <script src="/assets/js/pages/table/table_data.js"></script> --}}
            <!-- end js include path -->


</body>

</html>
