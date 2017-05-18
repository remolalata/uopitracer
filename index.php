<?php
session_start();
include'admin/php/db_connection.php';
header("Location: login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UPang Alumni Tracer</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="admin/plugins/font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">UPang iTracer</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">News & Events</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Gallery</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Bigger, Better, Best</h1>
                <hr>
                <p>PHINMA University of Pangasinan</p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">We've got what you need!</h2>
                    <hr class="light">
                    <p class="text-faded">Learn how you can dream BIGGER dreams and become the BETTER version of yourself with the BEST education you can get from PHINMA University of Pangasinan!</p>
                    <a href="#" class="btn btn-default btn-xl">Get Started!</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Latest News & Events</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <h3>Sturdy Templates</h3>
                        <img src="admin/images/news_events/Twice_Members_in_2015_-_3x3.jpg" class="img-responsive" height="150">
                        <p class="text-muted">Our templates are updated regularly so they don't break.</p>
                    	<a href="#" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <h3>Sturdy Templates</h3>
                        <img src="admin/images/news_events/Twice_Members_in_2015_-_3x3.jpg" class="img-responsive" height="150">
                        <p class="text-muted">Our templates are updated regularly so they don't break.</p>
                    	<a href="#" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <h3>Sturdy Templates</h3>
                        <img src="admin/images/news_events/Twice_Members_in_2015_-_3x3.jpg" class="img-responsive" height="150">
                        <p class="text-muted">Our templates are updated regularly so they don't break.</p>
                    	<a href="#" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <h3>Sturdy Templates</h3>
                        <img src="admin/images/news_events/Twice_Members_in_2015_-_3x3.jpg" class="img-responsive" height="150">
                        <p class="text-muted">Our templates are updated regularly so they don't break.</p>
                    	<a href="#" class="btn btn-primary btn-sm">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="no-padding" id="portfolio">
    	<div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Gallery</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-4 col-xs-6"><img class="img-responsive" src="http://placehold.it/300x200" /></div>
				<div class="col-md-3 col-sm-4 col-xs-6"><img class="img-responsive" src="http://placehold.it/300x200" /></div>
				<div class="col-md-3 col-sm-4 col-xs-6"><img class="img-responsive" src="http://placehold.it/300x200" /></div>
				<div class="col-md-3 col-sm-4 col-xs-6"><img class="img-responsive" src="http://placehold.it/300x200" /></div>
				<div class="col-md-3 col-sm-4 col-xs-6"><img class="img-responsive" src="http://placehold.it/300x200" /></div>
				<div class="col-md-3 col-sm-4 col-xs-6"><img class="img-responsive" src="http://placehold.it/300x200" /></div>
				<div class="col-md-3 col-sm-4 col-xs-6"><img class="img-responsive" src="http://placehold.it/300x200" /></div>
				<div class="col-md-3 col-sm-4 col-xs-6"><img class="img-responsive" src="http://placehold.it/300x200" /></div>
		    </div>
		</div>
		<div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
					<a href="#" class="btn btn-primary btn-xl">View More</a>
                </div>
            </div>
        </div>
    </section>

    <section class="footer">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-6">
    				<address>
    					&copy; Copyright PHINMA - University of Pangasinan, 2016.<br>
    					Arellano St.<br>
    					Dagupan City 2400<br>
    					Philippines<br>
    				</address>
    			</div>
    			<div class="col-md-6 text-right hidden-xs">
    				<img src="images/upang_logo.png" class="img-responsive">
    				<img src="images/upang_logo1.png" class="img-responsive">
    			</div>
    		</div>
    	</div>
    </section>

    <!-- jQuery -->
    <script src="admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>

</body>

</html>
