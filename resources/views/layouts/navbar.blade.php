<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu">
        <div id="remove-scroll" class="left-sidemenu">
            <ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false"
                data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <li class="sidebar-user-panel">
                    <div class="sidebar-user">
                        <div class="sidebar-user-picture">
                            <img alt="image" src="{{ asset('/storage/' . Auth::user()->photo) }}">
                        </div>
                        <div class="sidebar-user-details">
                            <div class="user-name">{{Auth::user()->nom}} {{Auth::user()->prenom}}</div>
                            <div class="user-role">@yield('fonction')</div>
                        </div>
                    </div>
                </li>
                <li class="nav-item start active open">
                    <a href="{{ route('admin_index') }}" class="nav-link nav-toggle">
                        <i data-feather="airplay"></i>
                        <span class="title">Tableau de Bord</span>
                        <span class="selected"></span>
                        {{-- <span class="arrow open"></span> --}}
                    </a>
                    {{-- <ul class="sub-menu">
                        <li class="nav-item active">
                            <a href="index.html" class="nav-link ">
                                <span class="title">Dashboard 1</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="dashboard2.html" class="nav-link ">
                                <span class="title">Dashboard 2</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="dashboard3.html" class="nav-link ">
                                <span class="title">Dashboard 3</span>
                            </a>
                        </li>
                    </ul> --}}
                </li>
              
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i data-feather="user"></i>
                        <span class="title">Utilisateurs</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="{{route('utilisateur_index')}}" class="nav-link "> <span
                                    class="title">Liste Utilisateur</span>
                            </a>
                        </li>
                      {{--   <li class="nav-item">
                            <a href="add_professor.html" class="nav-link "> <span
                                    class="title">Add
                                    Professor</span>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{route('utilisateur_create')}}" class="nav-link "> <span
                                    class="title">Nouvel Utilisateur</span>
                            </a>
                        </li>
                       {{--  <li class="nav-item">
                            <a href="edit_professor.html" class="nav-link "> <span
                                    class="title">Edit
                                    Professor</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="professor_profile.html" class="nav-link "> <span
                                    class="title">About
                                    Professor</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="event.html" class="nav-link nav-toggle"> <i
                            data-feather="calendar"></i>
                        <span class="title">Inscription</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"><i data-feather="users"></i>
                        <span class="title">Paramétres</span><span class="arrow"></span></a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="all_students.html" class="nav-link "> <span
                                    class="title">Service</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_student.html" class="nav-link "> <span
                                    class="title">Direction</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_student_bootstrap.html" class="nav-link "> <span
                                    class="title">Département</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit_student.html" class="nav-link "> <span
                                    class="title">Classe</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="student_profile.html" class="nav-link "> <span
                                    class="title">Filière</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="student_profile.html" class="nav-link "> <span
                                    class="title">Type Formation</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="student_profile.html" class="nav-link "> <span
                                    class="title">Batiment</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="student_profile.html" class="nav-link "> <span
                                    class="title">Salle</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="student_profile.html" class="nav-link "> <span
                                    class="title">Message Alerte</span>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i data-feather="book"></i>
                        <span class="title">Courses</span> <span class="arrow"></span>
                        <span class="label label-rouded label-menu label-success">new</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="all_courses.html" class="nav-link "> <span
                                    class="title">All
                                    Courses</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_course.html" class="nav-link "> <span class="title">Add
                                    Course</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_course_bootstrap.html" class="nav-link "> <span
                                    class="title">Add
                                    Course Bootstrap</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit_course.html" class="nav-link "> <span
                                    class="title">Edit
                                    Course</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="course_details.html" class="nav-link "> <span
                                    class="title">About
                                    Course</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
               {{--  <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i
                            data-feather="book-open"></i>
                        <span class="title">Library</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="all_assets.html" class="nav-link "> <span class="title">All
                                    Library
                                    Assets</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_library.html" class="nav-link "> <span
                                    class="title">Add Library
                                    Asset</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_library_bootstrap.html" class="nav-link "> <span
                                    class="title">Add
                                    Asset Bootstrap</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit_library.html" class="nav-link "> <span
                                    class="title">Edit
                                    Asset</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
               {{--  <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i
                            data-feather="briefcase"></i>
                        <span class="title">Departments</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="all_department.html" class="nav-link "> <span
                                    class="title">All
                                    Departments</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_department.html" class="nav-link "> <span
                                    class="title">Add
                                    Department</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_department_bootstrap.html" class="nav-link "> <span
                                    class="title">Add Department Bootstrap</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit_department.html" class="nav-link "> <span
                                    class="title">Edit
                                    Department</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i data-feather="smile"></i>
                        <span class="title">Staff</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="all_staffs.html" class="nav-link "> <span class="title">All
                                    Staff</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_staff.html" class="nav-link "> <span class="title">Add
                                    Staff</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_staff_bootstrap.html" class="nav-link "> <span
                                    class="title">Add
                                    Staff Bootstrap</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit_staff.html" class="nav-link "> <span
                                    class="title">Edit
                                    Staff</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="staff_profile.html" class="nav-link "> <span
                                    class="title">Staff
                                    Profile</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i data-feather="coffee"></i>
                        <span class="title">Holiday</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="all_holidays.html" class="nav-link "> <span
                                    class="title">All
                                    Holiday</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_holiday.html" class="nav-link "> <span
                                    class="title">Add
                                    Holiday</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_holiday_bootstrap.html" class="nav-link "> <span
                                    class="title">Add
                                    Holiday Bootstrap</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit_holiday.html" class="nav-link "> <span
                                    class="title">Edit
                                    Holiday</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle">
                        <i data-feather="mail"></i>
                        <span class="title">Email</span>
                        <span class="arrow"></span>
                        <span class="label label-rouded label-menu label-danger">new</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="email_inbox.html" class="nav-link ">
                                <span class="title">Inbox</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="email_view.html" class="nav-link ">
                                <span class="title">View Mail</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="email_compose.html" class="nav-link ">
                                <span class="title">Compose Mail</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i
                            data-feather="dollar-sign"></i>
                        <span class="title">Fees</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="fees_collection.html" class="nav-link "> <span
                                    class="title">Fees
                                    Collection</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_fees.html" class="nav-link "> <span class="title">Add
                                    Fees </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add_fees_bootstrap.html" class="nav-link "> <span
                                    class="title">Add
                                    Fees Bootstrap</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="fees_receipt.html" class="nav-link "> <span
                                    class="title">Fee
                                    Receipt</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle"> <i data-feather="layout"></i>
                        <span class="title">Layouts</span> <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="layout_verticle.html" class="nav-link "> <span
                                    class="title">Verticle</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="layout_boxed.html" class="nav-link "> <span
                                    class="title">Boxed </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="layout_collapse.html" class="nav-link "> <span
                                    class="title">Collapse</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="layout_hover_menu.html" class="nav-link "> <span
                                    class="title">Hover
                                    Menu</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="layout_right_sidebar.html" class="nav-link "> <span
                                    class="title">Right
                                    Sidebar</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="widget.html" class="nav-link nav-toggle"> <i
                            data-feather="gift"></i>
                        <span class="title">Widget</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle">
                        <i data-feather="copy"></i>
                        <span class="title">UI Elements</span>
                        <span class="label label-rouded label-menu label-warning">new</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="ui_buttons.html" class="nav-link ">
                                <span class="title">Buttons</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ui_sweet_alert.html" class="nav-link ">
                                <span class="title">Sweet Alert</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ui_tabs_accordions_navs.html" class="nav-link ">
                                <span class="title">Tabs &amp; Accordions</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ui_typography.html" class="nav-link ">
                                <span class="title">Typography</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="notification.html" class="nav-link ">
                                <span class="title">Notification</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ui_icons.html" class="nav-link ">
                                <span class="title">Icons</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ui_panels.html" class="nav-link ">
                                <span class="title">Panels</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ui_grid.html" class="nav-link ">
                                <span class="title">Grids</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ui_tree.html" class="nav-link ">
                                <span class="title">Tree View</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ui_carousel.html" class="nav-link ">
                                <span class="title">Carousel</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link nav-toggle">
                        <i data-feather="layers"></i>
                        <span class="title">Material Elements</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="material_button.html" class="nav-link ">
                                <span class="title">Buttons</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="material_tab.html" class="nav-link ">
                                <span class="title">Tabs</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="material_chips.html" class="nav-link ">
                                <span class="title">Chips</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="material_grid.html" class="nav-link ">
                                <span class="title">Grid</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="material_icons.html" class="nav-link ">
                                <span class="title">Icon</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="material_form.html" class="nav-link ">
                                <span class="title">Form</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="material_datepicker.html" class="nav-link ">
                                <span class="title">DatePicker</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="material_select.html" class="nav-link ">
                                <span class="title">Select Item</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="material_loading.html" class="nav-link ">
                                <span class="title">Loading</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="material_menu.html" class="nav-link ">
                                <span class="title">Menu</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="material_slider.html" class="nav-link ">
                                <span class="title">Slider</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="material_tables.html" class="nav-link ">
                                <span class="title">Tables</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="material_toggle.html" class="nav-link ">
                                <span class="title">Toggle</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="material_badges.html" class="nav-link ">
                                <span class="title">Badges</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i data-feather="server"></i>
                        <span class="title">Forms </span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="layouts_form.html" class="nav-link ">
                                <span class="title">Form Layout</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="advance_form.html" class="nav-link ">
                                <span class="title">Advance Component</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="wizard.html" class="nav-link ">
                                <span class="title">Form Wizard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="validation_form.html" class="nav-link ">
                                <span class="title">Form Validation</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="editable_form.html" class="nav-link ">
                                <span class="title">Editor</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i data-feather="grid"></i>
                        <span class="title">Data Tables</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="basic_table.html" class="nav-link ">
                                <span class="title">Basic Tables</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="advanced_table.html" class="nav-link ">
                                <span class="title">Advance Tables</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="export_table.html" class="nav-link ">
                                <span class="title">Export Tables</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="child_row_table.html" class="nav-link ">
                                <span class="title">Child Row Tables</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="group_table.html" class="nav-link ">
                                <span class="title">Grouping</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="tableData.html" class="nav-link ">
                                <span class="title">Tables With Sourced Data</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i data-feather="pie-chart"></i>
                        <span class="title">Charts</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="charts_apexchart.html" class="nav-link ">
                                <span class="title">Apex chart</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="charts_amchart.html" class="nav-link ">
                                <span class="title">amChart</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="charts_plotly.html" class="nav-link ">
                                <span class="title">Plotly Charts</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="charts_echarts.html" class="nav-link ">
                                <span class="title">eCharts</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="charts_morris.html" class="nav-link ">
                                <span class="title">Morris Charts</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="charts_chartjs.html" class="nav-link ">
                                <span class="title">Chartjs</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i data-feather="map-pin"></i>
                        <span class="title">Maps</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="google_maps.html" class="nav-link ">
                                <span class="title">Google Maps</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="vector_maps.html" class="nav-link ">
                                <span class="title">Vector Maps</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle"> <i
                            data-feather="anchor"></i>
                        <span class="title">Extra pages</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="login.html" class="nav-link "> <span
                                    class="title">Login</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="sign_up.html" class="nav-link "> <span class="title">Sign
                                    Up</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="forgot_password.html" class="nav-link "> <span
                                    class="title">Forgot
                                    Password</span>
                            </a>
                        </li>
                        <li class="nav-item"><a href="user_profile.html" class="nav-link "><span
                                    class="title">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="contact.html" class="nav-link "> <span
                                    class="title">Contact Us</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="lock_screen.html" class="nav-link "> <span
                                    class="title">Lock
                                    Screen</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="page-404.html" class="nav-link "> <span class="title">404
                                    Page</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="page-500.html" class="nav-link "> <span class="title">500
                                    Page</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="blank_page.html" class="nav-link "> <span
                                    class="title">Blank
                                    Page</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i data-feather="chevrons-down"></i>
                        <span class="title">Multi Level Menu</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i data-feather="alert-octagon"></i> Item 1
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i data-feather="aperture"></i> Arrow Toggle
                                        <span class="arrow "></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item">
                                            <a href="javascript:;" class="nav-link">
                                                <i data-feather="battery"></i> Sample Link 1</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i data-feather="award"></i> Sample Link 2</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i data-feather="box"></i> Sample Link 3</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i data-feather="clock"></i> Sample Link 1</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i data-feather="database"></i> Sample Link 2</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i data-feather="edit"></i> Sample Link 3</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i data-feather="folder"></i> Arrow Toggle
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i data-feather="film"></i> Sample Link 1</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i data-feather="file"></i> Sample Link 1</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i data-feather="heart"></i> Sample Link 1
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i data-feather="lock"></i> Item 3 </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item">
                  
                    <a href="{{ route('logout') }}" class="nav-link nav-toggle"> <i
                        class="icon-logout"></i>
                        <span class="title">Déconnexion</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>