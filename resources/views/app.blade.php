<!doctype html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Issue Tracker</title>
    <meta name="description" content="Dashboard UI Kit">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/main.min.css">

</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- Add your site or application content here -->
    <header class="c-navbar">
        <a class="c-navbar__brand">
            <img src="img/logo.png" alt="Dashboard UI Kit">
        </a>

        <!-- Navigation items that will be collapes and toggle in small viewports -->
        <nav class="c-nav collapse" id="main-nav">
            <ul class="c-nav__list">

            </ul>
        </nav>
        <!-- // Navigation items  -->

        <div class="c-dropdown u-ml-auto dropdown">
            <a class="c-avatar c-avatar--xsmall has-dropdown dropdown-toggle" href="#" id="dropdwonMenuAvatar"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="c-avatar__img u-mr-xsmall" src="img/avatar-72.jpg" alt="User's Profile Picture">
                <span>{{auth()->user()->name}}</span>
            </a>

            <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
                <a class="c-dropdown__item dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log Out</a>
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>


        </div>

        <button class="c-nav-toggle" data-toggle="collapse" data-target="#main-nav">
            <span class="c-nav-toggle__bar"></span>
            <span class="c-nav-toggle__bar"></span>
            <span class="c-nav-toggle__bar"></span>
        </button><!-- // .c-nav-toggle -->
    </header>

    <div class="container-fluid u-mt-small" id="app">

        <main-app :inj-boards="{{$boards}}">

        </main-app>


    </div>


    <script src="js/app.js"></script>
</body>

</html>