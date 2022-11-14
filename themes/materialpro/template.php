<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex,nofollow" />
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png" />
    {{arc:header}}
</head>

<body>
    <div class="preloader">
        <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z"
                stroke="#1e88e5" stroke-width="2"></path>
            <path
                d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34"
                stroke="#1e88e5" stroke-width="2"></path>
            <path id="teabag" fill="#1e88e5" fill-rule="evenodd" clip-rule="evenodd"
                d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z">
            </path>
            <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" stroke="#1e88e5"></path>
            <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#1e88e5" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-lg navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="{{arc:sitelogo}}" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="{{arc:sitelogo}}" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                    <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent">

                    <div class="menusearch">
                        <form method="post" name="srchm" action="/search/" onsubmit="return validateSearch('srchm')">
                            <div class="input-group no-border">
                                <input type="text" class="form-control" name="search" placeholder="Search...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" aria-label="Search"><i
                                            class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <ul class="navbar-nav me-auto">
                    </ul>
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item d-none d-md-block search-box">
                            <a class="nav-link d-none d-md-block waves-effect waves-dark" href="javascript:void(0)"><i
                                    class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter" />
                                <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-message"></i>
                                <div class="notify">
                                    <span class="heartbit"></span> <span class="point"></span>
                                </div>
                            </a>
                            <div class="
                    dropdown-menu dropdown-menu-end
                    mailbox
                    dropdown-menu-animate-up
                  ">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="border-bottom rounded-top py-3 px-4">
                                            <div class="mb-0 font-weight-medium fs-4">
                                                Notifications
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center notifications position-relative"
                                            style="height: 230px">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          ">
                                                <span class="btn btn-light-danger text-danger btn-circle">
                                                    <i data-feather="link" class="feather-sm fill-white"></i>
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                        Luanch Admin
                                                    </h5>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                                fw-normal
                                text-muted
                                mt-1
                              ">Just see the my new admin!</span>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              ">9:30 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          ">
                                                <span class="
                              btn btn-light-success
                              text-success
                              btn-circle
                            ">
                                                    <i data-feather="calendar" class="feather-sm fill-white"></i>
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                        Event today
                                                    </h5>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                                fw-normal
                                text-muted
                                mt-1
                              ">Just a reminder that you have event</span>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              ">9:10 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          ">
                                                <span class="btn btn-light-info text-info btn-circle">
                                                    <i data-feather="settings" class="feather-sm fill-white"></i>
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                        Settings
                                                    </h5>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                                fw-normal
                                text-muted
                                mt-1
                              ">You can customize this template as you want</span>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              ">9:08 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          ">
                                                <span class="
                              btn btn-light-primary
                              text-primary
                              btn-circle
                            ">
                                                    <i data-feather="users" class="feather-sm fill-white"></i>
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                        Pavan kumar
                                                    </h5>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                                fw-normal
                                text-muted
                                mt-1
                              ">Just see the my admin!</span>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              ">9:02 AM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link border-top text-center text-dark pt-3"
                                            href="javascript:void(0);">
                                            <strong>Check all notifications</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-email"></i>
                                <div class="notify">
                                    <span class="heartbit"></span> <span class="point"></span>
                                </div>
                            </a>
                            <div class="
                    dropdown-menu
                    mailbox
                    dropdown-menu-end dropdown-menu-animate-up
                  " aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="border-bottom rounded-top py-3 px-4">
                                            <div class="mb-0 font-weight-medium fs-4">
                                                You have 4 new messages
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center message-body position-relative"
                                            style="height: 230px">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          ">
                                                <span class="user-img position-relative d-inline-block">
                                                    <img src="../../assets/images/users/1.jpg" alt="user"
                                                        class="rounded-circle w-100" />
                                                    <span class="profile-status rounded-circle online"></span>
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                        Pavan kumar
                                                    </h5>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                                fw-normal
                                mt-1
                              ">Just see the my admin!</span>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              ">9:30 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          ">
                                                <span class="user-img position-relative d-inline-block">
                                                    <img src="../../assets/images/users/2.jpg" alt="user"
                                                        class="rounded-circle w-100" />
                                                    <span class="profile-status rounded-circle busy"></span>
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                        Sonu Nigam
                                                    </h5>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                              ">I've sung a song! See you at</span>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              ">9:10 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          ">
                                                <span class="user-img position-relative d-inline-block">
                                                    <img src="../../assets/images/users/3.jpg" alt="user"
                                                        class="rounded-circle w-100" />
                                                    <span class="profile-status rounded-circle away"></span>
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                        Arijit Sinh
                                                    </h5>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                              ">I am a singer!</span>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              ">9:08 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="
                            message-item
                            d-flex
                            align-items-center
                            border-bottom
                            px-3
                            py-2
                          ">
                                                <span class="user-img position-relative d-inline-block">
                                                    <img src="../../assets/images/users/4.jpg" alt="user"
                                                        class="rounded-circle w-100" />
                                                    <span class="profile-status rounded-circle offline"></span>
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">
                                                        Pavan kumar
                                                    </h5>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                time
                                text-truncate
                              ">Just see the my admin!</span>
                                                    <span class="
                                fs-2
                                text-nowrap
                                d-block
                                subtext
                                text-muted
                              ">9:02 AM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link border-top text-center text-dark pt-3"
                                            href="javascript:void(0);">
                                            <b>See all e-Mails</b> <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown mega-dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="mdi mdi-view-grid"></i></a>
                            <div class="dropdown-menu dropdown-menu-animate-up">
                                <div class="mega-dropdown-menu row">
                                    <div class="col-lg-3 col-xl-2 mb-4">
                                        <h4 class="mb-3">CAROUSEL</h4>
                                        <!-- CAROUSEL -->
                                        <div id="carouselExampleControls" class="carousel slide carousel-dark"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img class="d-block img-fluid"
                                                        src="../../assets/images/big/img1.jpg" alt="First slide" />
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block img-fluid"
                                                        src="../../assets/images/big/img2.jpg" alt="Second slide" />
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block img-fluid"
                                                        src="../../assets/images/big/img3.jpg" alt="Third slide" />
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls"
                                                role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls"
                                                role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </a>
                                        </div>
                                        <!-- End CAROUSEL -->
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <h4 class="mb-3">ACCORDION</h4>
                                        <!-- Accordian -->
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                        aria-expanded="false" aria-controls="flush-collapseOne">
                                                        Accordion Item #1
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingOne"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod
                                                        high life accusamus terry richardson ad squid.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingTwo">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                        aria-expanded="false" aria-controls="flush-collapseTwo">
                                                        Accordion Item #2
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingTwo"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod
                                                        high life accusamus terry richardson ad squid.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingThree">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                                        aria-expanded="false" aria-controls="flush-collapseThree">
                                                        Accordion Item #3
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingThree"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod
                                                        high life accusamus terry richardson ad squid.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mb-4">
                                        <h4 class="mb-3">CONTACT US</h4>
                                        <!-- Contact -->
                                        <form>
                                            <div class="mb-3 form-floating">
                                                <input type="text" class="form-control" id="exampleInputname1"
                                                    placeholder="Enter Name" />
                                                <label>Enter Name</label>
                                            </div>
                                            <div class="mb-3 form-floating">
                                                <input type="email" class="form-control" placeholder="Enter email" />
                                                <label>Enter Email address</label>
                                            </div>
                                            <div class="mb-3 form-floating">
                                                <textarea class="form-control" id="exampleTextarea" rows="3"
                                                    placeholder="Message"></textarea>
                                                <label>Enter Message</label>
                                            </div>
                                            <button type="submit" class="btn px-4 rounded-pill btn-info">
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-lg-3 col-xlg-4 mb-4">
                                        <h4 class="mb-3">List style</h4>
                                        <!-- List style -->
                                        <ul class="list-style-none">
                                            <li>
                                                <a href="#" class="font-weight-medium"><i data-feather="check-circle"
                                                        class="feather-sm text-success me-2"></i>
                                                    You can give link</a>
                                            </li>
                                            <li>
                                                <a href="#" class="font-weight-medium"><i data-feather="check-circle"
                                                        class="feather-sm text-success me-2"></i>
                                                    Give link</a>
                                            </li>
                                            <li>
                                                <a href="#" class="font-weight-medium"><i data-feather="check-circle"
                                                        class="feather-sm text-success me-2"></i>
                                                    Another Give link</a>
                                            </li>
                                            <li>
                                                <a href="#" class="font-weight-medium"><i data-feather="check-circle"
                                                        class="feather-sm text-success me-2"></i>
                                                    Forth link</a>
                                            </li>
                                            <li>
                                                <a href="#" class="font-weight-medium"><i data-feather="check-circle"
                                                        class="feather-sm text-success me-2"></i>
                                                    Another fifth link</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="
                    nav-link
                    dropdown-toggle
                    text-muted
                    waves-effect waves-dark
                  " href="" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="flag-icon flag-icon-us"></i></a>
                            <div class="
                    dropdown-menu dropdown-menu-end dropdown-menu-animate-up
                  ">
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="../../assets/images/users/1.jpg" alt="user" width="30"
                                    class="profile-pic rounded-circle" />
                            </a>
                            <div class="
                    dropdown-menu dropdown-menu-end
                    user-dd
                    animated
                    flipInY
                  ">
                                <div class="
                      d-flex
                      no-block
                      align-items-center
                      p-3
                      bg-info
                      text-white
                      mb-2
                    ">
                                    <div class="">
                                        <img src="../../assets/images/users/1.jpg" alt="user" class="rounded-circle"
                                            width="60" />
                                    </div>
                                    <div class="ms-2">
                                        <h4 class="mb-0 text-white">Steave Jobs</h4>
                                        <p class="mb-0">varun@gmail.com</p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="#"><i data-feather="user"
                                        class="feather-sm text-info me-1 ms-1"></i>
                                    My Profile</a>
                                <a class="dropdown-item" href="#"><i data-feather="credit-card"
                                        class="feather-sm text-info me-1 ms-1"></i>
                                    My Balance</a>
                                <a class="dropdown-item" href="#"><i data-feather="mail"
                                        class="feather-sm text-success me-1 ms-1"></i>
                                    Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i data-feather="settings"
                                        class="feather-sm text-warning me-1 ms-1"></i>
                                    Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i data-feather="log-out"
                                        class="feather-sm text-danger me-1 ms-1"></i>
                                    Logout</a>
                                <div class="dropdown-divider"></div>
                                <div class="pl-4 p-2">
                                    <a href="#" class="btn d-block w-100 btn-info rounded-pill">View Profile</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                {{arc:menu}}
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">{{arc:title}}</h3>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                {{arc:impersonate}}

                                {{arc:content}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer text-center">
                All Rights Reserved by Materialpro admin.
            </footer>
        </div>
    </div>
    <aside class="customizer">
        <a href="javascript:void(0)" class="service-panel-toggle"><i class="fa fa-spin fa-cog"></i></a>
        <div class="customizer-body">
            <ul class="nav customizer-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true"><i class="mdi mdi-wrench fs-6"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#chat" role="tab"
                        aria-controls="chat" aria-selected="false"><i class="mdi mdi-message-reply fs-6"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false"><i class="mdi mdi-star-circle fs-6"></i></a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Tab 1 -->
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="p-3 border-bottom">
                        <!-- Sidebar -->
                        <h5 class="font-weight-medium mb-2 mt-2">Layout Settings</h5>
                        <div class="form-check mt-3">
                            <input type="checkbox" name="theme-view" class="form-check-input" id="theme-view" />
                            <label class="form-check-label" for="theme-view">
                                <span>Dark Theme</span>
                            </label>
                        </div>
                        <div class="form-check mt-2">
                            <input type="checkbox" class="sidebartoggler form-check-input" name="collapssidebar"
                                id="collapssidebar" />
                            <label class="form-check-label" for="collapssidebar">
                                <span>Collapse Sidebar</span>
                            </label>
                        </div>
                        <div class="form-check mt-2">
                            <input type="checkbox" name="sidebar-position" class="form-check-input"
                                id="sidebar-position" />
                            <label class="form-check-label" for="sidebar-position">
                                <span>Fixed Sidebar</span>
                            </label>
                        </div>
                        <div class="form-check mt-2">
                            <input type="checkbox" name="header-position" class="form-check-input"
                                id="header-position" />
                            <label class="form-check-label" for="header-position">
                                <span>Fixed Header</span>
                            </label>
                        </div>
                        <div class="form-check mt-2">
                            <input type="checkbox" name="boxed-layout" class="form-check-input" id="boxed-layout" />
                            <label class="form-check-label" for="boxed-layout">
                                <span>Boxed Layout</span>
                            </label>
                        </div>
                    </div>
                    <div class="p-3 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-weight-medium mb-2 mt-2">Logo Backgrounds</h5>
                        <ul class="theme-color m-0 p-0">
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-logobg="skin1"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-logobg="skin2"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-logobg="skin3"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-logobg="skin4"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-logobg="skin5"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-logobg="skin6"></a>
                            </li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                    <div class="p-3 border-bottom">
                        <!-- Navbar BG -->
                        <h5 class="font-weight-medium mb-2 mt-2">Navbar Backgrounds</h5>
                        <ul class="theme-color m-0 p-0">
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-navbarbg="skin1"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-navbarbg="skin2"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-navbarbg="skin3"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-navbarbg="skin4"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-navbarbg="skin5"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-navbarbg="skin6"></a>
                            </li>
                        </ul>
                        <!-- Navbar BG -->
                    </div>
                    <div class="p-3 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-weight-medium mb-2 mt-2">Sidebar Backgrounds</h5>
                        <ul class="theme-color m-0 p-0">
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-sidebarbg="skin1"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-sidebarbg="skin2"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-sidebarbg="skin3"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-sidebarbg="skin4"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-sidebarbg="skin5"></a>
                            </li>
                            <li class="theme-item list-inline-item me-1">
                                <a href="javascript:void(0)" class="theme-link rounded-circle d-block"
                                    data-sidebarbg="skin6"></a>
                            </li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                </div>
                <!-- End Tab 1 -->
                <!-- Tab 2 -->
                <div class="tab-pane fade" id="chat" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <ul class="mailbox list-style-none mt-3">
                        <li>
                            <div class="message-center chat-scroll position-relative">
                                <a href="javascript:void(0)" class="
                      message-item
                      d-flex
                      align-items-center
                      border-bottom
                      px-3
                      py-2
                    " id="chat_user_1" data-user-id="1">
                                    <span class="user-img position-relative d-inline-block">
                                        <img src="../../assets/images/users/1.jpg" alt="user"
                                            class="rounded-circle w-100" />
                                        <span class="profile-status rounded-circle online"></span>
                                    </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Pavan kumar</h5>
                                        <span class="
                          fs-2
                          text-nowrap
                          d-block
                          text-muted text-truncate
                        ">Just see the my admin!</span>
                                        <span class="fs-2 text-nowrap d-block text-muted">9:30 AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="
                      message-item
                      d-flex
                      align-items-center
                      border-bottom
                      px-3
                      py-2
                    " id="chat_user_2" data-user-id="2">
                                    <span class="user-img position-relative d-inline-block">
                                        <img src="../../assets/images/users/2.jpg" alt="user"
                                            class="rounded-circle w-100" />
                                        <span class="profile-status rounded-circle busy"></span>
                                    </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Sonu Nigam</h5>
                                        <span class="
                          fs-2
                          text-nowrap
                          d-block
                          text-muted text-truncate
                        ">I've sung a song! See you at</span>
                                        <span class="fs-2 text-nowrap d-block text-muted">9:10 AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="
                      message-item
                      d-flex
                      align-items-center
                      border-bottom
                      px-3
                      py-2
                    " id="chat_user_3" data-user-id="3">
                                    <span class="user-img position-relative d-inline-block">
                                        <img src="../../assets/images/users/3.jpg" alt="user"
                                            class="rounded-circle w-100" />
                                        <span class="profile-status rounded-circle away"></span>
                                    </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Arijit Sinh</h5>
                                        <span class="
                          fs-2
                          text-nowrap
                          d-block
                          text-muted text-truncate
                        ">I am a singer!</span>
                                        <span class="fs-2 text-nowrap d-block text-muted">9:08 AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="
                      message-item
                      d-flex
                      align-items-center
                      border-bottom
                      px-3
                      py-2
                    " id="chat_user_4" data-user-id="4">
                                    <span class="user-img position-relative d-inline-block">
                                        <img src="../../assets/images/users/4.jpg" alt="user"
                                            class="rounded-circle w-100" />
                                        <span class="profile-status rounded-circle offline"></span>
                                    </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Nirav Joshi</h5>
                                        <span class="
                          fs-2
                          text-nowrap
                          d-block
                          text-muted text-truncate
                        ">Just see the my admin!</span>
                                        <span class="fs-2 text-nowrap d-block text-muted">9:02 AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="
                      message-item
                      d-flex
                      align-items-center
                      border-bottom
                      px-3
                      py-2
                    " id="chat_user_5" data-user-id="5">
                                    <span class="user-img position-relative d-inline-block">
                                        <img src="../../assets/images/users/5.jpg" alt="user"
                                            class="rounded-circle w-100" />
                                        <span class="profile-status rounded-circle offline"></span>
                                    </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Sunil Joshi</h5>
                                        <span class="
                          fs-2
                          text-nowrap
                          d-block
                          text-muted text-truncate
                        ">Just see the my admin!</span>
                                        <span class="fs-2 text-nowrap d-block text-muted">9:02 AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="
                      message-item
                      d-flex
                      align-items-center
                      border-bottom
                      px-3
                      py-2
                    " id="chat_user_6" data-user-id="6">
                                    <span class="user-img position-relative d-inline-block">
                                        <img src="../../assets/images/users/6.jpg" alt="user"
                                            class="rounded-circle w-100" />
                                        <span class="profile-status rounded-circle offline"></span>
                                    </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Akshay Kumar</h5>
                                        <span class="
                          fs-2
                          text-nowrap
                          d-block
                          text-muted text-truncate
                        ">Just see the my admin!</span>
                                        <span class="fs-2 text-nowrap d-block text-muted">9:02 AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="
                      message-item
                      d-flex
                      align-items-center
                      border-bottom
                      px-3
                      py-2
                    " id="chat_user_7" data-user-id="7">
                                    <span class="user-img position-relative d-inline-block">
                                        <img src="../../assets/images/users/7.jpg" alt="user"
                                            class="rounded-circle w-100" />
                                        <span class="profile-status rounded-circle offline"></span>
                                    </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Pavan kumar</h5>
                                        <span class="
                          fs-2
                          text-nowrap
                          d-block
                          text-muted text-truncate
                        ">Just see the my admin!</span>
                                        <span class="fs-2 text-nowrap d-block text-muted">9:02 AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="
                      message-item
                      d-flex
                      align-items-center
                      border-bottom
                      px-3
                      py-2
                    " id="chat_user_8" data-user-id="8">
                                    <span class="user-img position-relative d-inline-block">
                                        <img src="../../assets/images/users/8.jpg" alt="user"
                                            class="rounded-circle w-100" />
                                        <span class="profile-status rounded-circle offline"></span>
                                    </span>
                                    <div class="w-75 d-inline-block v-middle ps-3">
                                        <h5 class="message-title mb-0 mt-1">Varun Dhavan</h5>
                                        <span class="
                          fs-2
                          text-nowrap
                          d-block
                          text-muted text-truncate
                        ">Just see the my admin!</span>
                                        <span class="fs-2 text-nowrap d-block text-muted">9:02 AM</span>
                                    </div>
                                </a>
                                <!-- Message -->
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- End Tab 2 -->
                <!-- Tab 3 -->
                <div class="tab-pane fade p-3" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <h6 class="mt-3 mb-3">Activity Timeline</h6>
                    <div class="steamline">
                        <div class="sl-item">
                            <div class="sl-left bg-light-success text-success">
                                <i data-feather="user" class="feather-sm fill-white"></i>
                            </div>
                            <div class="sl-right">
                                <div class="font-weight-medium">
                                    Meeting today <span class="sl-date"> 5pm</span>
                                </div>
                                <div class="desc">you can write anything</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-light-info text-info">
                                <i data-feather="camera" class="feather-sm fill-white"></i>
                            </div>
                            <div class="sl-right">
                                <div class="font-weight-medium">Send documents to Clark</div>
                                <div class="desc">Lorem Ipsum is simply</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left">
                                <img class="rounded-circle" alt="user" src="../../assets/images/users/2.jpg" />
                            </div>
                            <div class="sl-right">
                                <div class="font-weight-medium">
                                    Go to the Doctor <span class="sl-date">5 minutes ago</span>
                                </div>
                                <div class="desc">Contrary to popular belief</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left">
                                <img class="rounded-circle" alt="user" src="../../assets/images/users/1.jpg" />
                            </div>
                            <div class="sl-right">
                                <div>
                                    <a href="javascript:void(0)">Stephen</a>
                                    <span class="sl-date">5 minutes ago</span>
                                </div>
                                <div class="desc">Approve meeting with tiger</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-light-primary text-primary">
                                <i data-feather="user" class="feather-sm fill-white"></i>
                            </div>
                            <div class="sl-right">
                                <div class="font-weight-medium">
                                    Meeting today <span class="sl-date"> 5pm</span>
                                </div>
                                <div class="desc">you can write anything</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-light-info text-info">
                                <i data-feather="send" class="feather-sm fill-white"></i>
                            </div>
                            <div class="sl-right">
                                <div class="font-weight-medium">Send documents to Clark</div>
                                <div class="desc">Lorem Ipsum is simply</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left">
                                <img class="rounded-circle" alt="user" src="../../assets/images/users/4.jpg" />
                            </div>
                            <div class="sl-right">
                                <div class="font-weight-medium">
                                    Go to the Doctor <span class="sl-date">5 minutes ago</span>
                                </div>
                                <div class="desc">Contrary to popular belief</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left">
                                <img class="rounded-circle" alt="user" src="../../assets/images/users/6.jpg" />
                            </div>
                            <div class="sl-right">
                                <div>
                                    <a href="javascript:void(0)">Stephen</a>
                                    <span class="sl-date">5 minutes ago</span>
                                </div>
                                <div class="desc">Approve meeting with tiger</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Tab 3 -->
            </div>
        </div>
    </aside>
    <div class="chat-windows"></div>
    {{arc:footer}}
</body>

</html>