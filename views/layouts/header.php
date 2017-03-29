<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>TopShop</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/template/css/bootstrap.css">
    <link rel="stylesheet" href="/template/css/bootstrap-theme.css">
    <!--FONT_AWESOME-->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/template/css/font-awesome.min.css">
    <link rel="stylesheet" href="/template/css/main.css">
    <link rel="icon" href="../../favicon.ico" type="image/x-icon" />
</head>
<body>
<header class="header">
    <!--navigation bar-->
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#responsive-menu">
                    <span class="sr-only">Open Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/" ><i>Top</i>Shop</a>
            </div>
            <div class="collapse navbar-collapse" id="responsive-menu">
                <ul class="nav navbar-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="/about">About us</a></li>
                    <li><a href="/contacts">Contact</a></li>
                    <!--log-in-->

                    <ul id="log-in" class="nav navbar-nav">
                    <?php if (User::isGuest()): ?>
                        <li><a href="/user/login/"><i class="fa fa-lock"></i> Sign-In</a></li>
                    <?php else: ?>
                        <li><a href="/cabinet/"><i class="fa fa-user"></i> Account</a></li>
                        <li><a href="/user/logout/"><i class="fa fa-unlock"></i> Sing-Out</a></li>
                    <?php endif; ?>
                    </ul>
                    <!--end of log-in-->
                </ul>
            </div>
        </div>

    </nav>
    <!--end of navigation bar-->
</header>