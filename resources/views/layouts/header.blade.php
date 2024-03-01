<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <li><a class="fullscreen-btn"><i data-feather="maximize"></i></a></li>
        <!-- start language menu -->
 
        <!-- end language menu -->
        <!-- start notification dropdown -->
        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
            <a class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
                data-close-others="true">
                <i data-feather="bell"></i>
                <span class="badge headerBadgeColor1"> 6 </span>
            </a>
            <ul class="dropdown-menu">
                <li class="external">
                    <h3><span class="bold">Notifications</span></h3>
                    <span class="notification-label purple-bgcolor">New 6</span>
                </li>
                <li>
                    <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                        <li>
                            <a href="javascript:;">
                                <span class="time">just now</span>
                                <span class="details">
                                    <span class="notification-icon circle deepPink-bgcolor"><i
                                            class="fa fa-check"></i></span>
                                    Congratulations!. </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <span class="time">3 mins</span>
                                <span class="details">
                                    <span class="notification-icon circle purple-bgcolor"><i
                                            class="fa fa-user o"></i></span>
                                    <b>John Micle </b>is now following you. </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <span class="time">7 mins</span>
                                <span class="details">
                                    <span class="notification-icon circle blue-bgcolor"><i
                                            class="fa fa-comments-o"></i></span>
                                    <b>Sneha Jogi </b>sent you a message. </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <span class="time">12 mins</span>
                                <span class="details">
                                    <span class="notification-icon circle pink"><i
                                            class="fa fa-heart"></i></span>
                                    <b>Ravi Patel </b>like your photo. </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <span class="time">15 mins</span>
                                <span class="details">
                                    <span class="notification-icon circle yellow"><i
                                            class="fa fa-warning"></i></span> Warning! </span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <span class="time">10 hrs</span>
                                <span class="details">
                                    <span class="notification-icon circle red"><i
                                            class="fa fa-times"></i></span> Application error. </span>
                            </a>
                        </li>
                    </ul>
                    <div class="dropdown-menu-footer">
                        <a href="javascript:void(0)"> All notifications </a>
                    </div>
                </li>
            </ul>
        </li>
        <!-- end notification dropdown -->
        <!-- start message dropdown -->
        <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
            <a class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
                data-close-others="true">
                <i data-feather="mail"></i>
                <span class="badge headerBadgeColor2"> 2 </span>
            </a>
            <ul class="dropdown-menu">
                <li class="external">
                    <h3><span class="bold">Messages</span></h3>
                    <span class="notification-label cyan-bgcolor">New 2</span>
                </li>
                <li>
                    <ul class="dropdown-menu-list small-slimscroll-style" data-handle-color="#637283">
                        <li>
                            <a href="#">
                                <span class="photo">
                                    <img src="/assets/img/user/user2.jpg" class="img-circle" alt="">
                                </span>
                                <span class="subject">
                                    <span class="from"> Sarah Smith </span>
                                    <span class="time">Just Now </span>
                                </span>
                                <span class="message"> Jatin I found you on LinkedIn... </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo">
                                    <img src="/assets/img/user/user3.jpg" class="img-circle" alt="">
                                </span>
                                <span class="subject">
                                    <span class="from"> John Deo </span>
                                    <span class="time">16 mins </span>
                                </span>
                                <span class="message"> Fwd: Important Notice Regarding Your Domain
                                    Name... </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo">
                                    <img src="/assets/img/user/user1.jpg" class="img-circle" alt="">
                                </span>
                                <span class="subject">
                                    <span class="from"> Rajesh </span>
                                    <span class="time">2 hrs </span>
                                </span>
                                <span class="message"> pls take a print of attachments. </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo">
                                    <img src="/assets/img/user/user8.jpg" class="img-circle" alt="">
                                </span>
                                <span class="subject">
                                    <span class="from"> Lina Smith </span>
                                    <span class="time">40 mins </span>
                                </span>
                                <span class="message"> Apply for Ortho Surgeon </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="photo">
                                    <img src="/assets/img/user/user5.jpg" class="img-circle" alt="">
                                </span>
                                <span class="subject">
                                    <span class="from"> Jacob Ryan </span>
                                    <span class="time">46 mins </span>
                                </span>
                                <span class="message"> Request for leave application. </span>
                            </a>
                        </li>
                    </ul>
                    <div class="dropdown-menu-footer">
                        <a href="#"> All Messages </a>
                    </div>
                </li>
            </ul>
        </li>
        <!-- end message dropdown -->
        <!-- start manage user dropdown -->
        <li class="dropdown dropdown-user">
            <a class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
                data-close-others="true">
                <img alt="" class="img-circle" src="{{ asset('/storage/' . Auth::user()->photo) }}" />
                <span class="username username-hide-on-mobile"> {{Auth::user()->nom}}
            </a>
            <ul class="dropdown-menu dropdown-menu-default">
                <li>
                    <a  href="/utilisateur/profil">
                        <i class="icon-user"></i> Profil </a>
                </li>
      
                <li class="divider"> </li>
          
                <li>
                    <a href="{{ route('logout') }}">
                        <i class="icon-logout"></i> Déconnexion </a>
                </li>
            </ul>
        </li>
        <!-- end manage user dropdown -->
        <li class="dropdown dropdown-quick-sidebar-toggler">
            <a id="headerSettingButton" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                data-upgraded=",MaterialButton">
                <i class="material-icons">more_vert</i>
            </a>
        </li>
    </ul>
</div>
</div>
</div>