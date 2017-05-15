<!DOCTYPE html>

<html class="ie8 no-js" lang="en"><html class="ie9 no-js" lang="en">
<html lang="en" class="no-js">
	<head>
		<title>wanderfirst</title>
		
		<meta charset="utf-8"/>
		<!--[if IE]>
		<meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1"/><![endif]-->
		<meta name="viewport"
		content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description"/>
		<meta content="" name="author"/>

		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

		{!! HTML::style('assets/css/style.css') !!}


		@yield('head')

	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body>
		<!-- start: HEADER -->
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<!-- start: RESPONSIVE MENU TOGGLER -->
					<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
						<span class="clip-list-2"></span>
					</button>
					<!-- end: RESPONSIVE MENU TOGGLER -->
					<!-- start: LOGO -->
					<a class="navbar-brand" href="{{asset('/index')}}"> <img src="{{asset('/assets/images/wf-logo-30.png')}}" width: "140px;" height: "26px;" alt="wanderFirst" /> </a>
					<!-- <a class="navbar-brand" href="{{asset('/index')}}"> Wander<i class="clip-clip"></i>First </a> -->
					<!-- end: LOGO -->
				</div>
				<div class="navbar-tools">
					<!-- start: TOP NAVIGATION MENU -->
					<ul class="nav navbar-right">

											
						<!-- end: NOTIFICATION DROPDOWN -->
						<!-- start: USER DROPDOWN -->
						<li class="dropdown current-user">
							<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true"
							href="#"> <span class="username"><?php echo $cmpname . $userName =  session('userName'); ?></span> <i class="clip-chevron-down"></i> </a>
							<ul class="dropdown-menu">
								<li>
									<a href={{asset('/myProfile')}}> <i class="clip-exit"></i> &nbsp;My Profile </a>
								</li>
								<li>
									<a href={{asset('/change_password')}}> <i class="clip-exit"></i> &nbsp;Change Password </a>
								</li>
								<li>
									<a href={{asset('/logout')}} id="logout"> <i class="clip-exit"></i> &nbsp;Log Out </a>
								</li>
							</ul>
						</li>
						<!-- end: USER DROPDOWN -->
					</ul>
					<!-- end: TOP NAVIGATION MENU -->
				</div>
			</div>
			<!-- end: TOP NAVIGATION CONTAINER -->
		</div>
		<!-- start: MAIN CONTAINER -->
		<div class="main-container">
			<div class="navbar-content">
				<!-- start: SIDEBAR -->
						
				<div class="main-navigation navbar-collapse collapse">
					<!-- start: MAIN MENU TOGGLER BUTTON -->
					<div class="navigation-toggler">
						<i class="clip-chevron-left"></i>
						<i class="clip-chevron-right"></i>
					</div>
					<!-- end: MAIN MENU TOGGLER BUTTON -->
					

					<!-- start: MAIN NAVIGATION MENU -->
					<ul class="main-navigation-menu" >
						<li class="highlight">
							<a href={{asset('index')}} class="highlight"><i class="clip-home-3"></i> <span class="title"> Dashboard </span><span class="selected"></span> </a>
						</li>						
					
						<li class="highlight analytics">
							<a href="javascript:void(0)" ><i class="clip-bars"></i> <span class="title"> Google Analytics </span><i class="icon-arrow"></i> <span class="selected"></span> </a>

							<ul class="sub-menu">						
								<li class="view">
									<a href={{asset('analytics/view')}}> <span class="title">Analytics Data</span> </a>
								</li>
								
							</ul>

						</li>

						<li class="highlight sharedtours">
							<a href="javascript:void(0)" class="highlight"><i class="clip-share"></i> <span class="title"> Shared / Wishlisted List </span><i class="icon-arrow"></i> </a>
							<ul class="sub-menu">
							
								<li class="list">
									<a href={{asset('sharedtours/list')}}> <span class="title"> Shared Tours </span> </a>
								</li>

								</ul>

						</li>

					</ul>
				</div>
				<!-- end: MAIN NAVIGATION MENU -->
				<!-- end: SIDEBAR -->
			</div>
			<!-- start: PAGE -->
			<div class="main-content">
				<!-- start: PANEL CONFIGURATION MODAL FORM -->
				<div class="modal fade" id="panel-config" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
									&times;
								</button>
								<h4 class="modal-title">Panel Configuration</h4>
							</div>
							<div class="modal-body">
								Here will be a configuration form
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">
									Close
								</button>
								<button type="button" class="btn btn-primary">
									Save changes
								</button>
							</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
				<!-- end: SPANEL CONFIGURATION MODAL FORM -->
				<!-- end: PAGE HEADER -->
				<!-- start: PAGE CONTENT -->

				@yield('content')

				<!-- end: PAGE CONTENT-->
			</div>
		</div>
		<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->
		<!-- start: FOOTER -->
		<div class="footer clearfix">
			<div class="footer-inner">
				2017 &copy; smart india.
			</div>
			<div class="footer-items">
				<span class="go-top"><i class="clip-chevron-up"></i></span>
			</div>
		</div>
		<!-- end: FOOTER -->

		{!! HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') !!}

		

		@stack('scripts')
		<!-- App scripts -->

	</body>
	<!-- end: BODY -->
</html>