<!DOCTYPE html>

<html class="ie8 no-js" lang="en"><html class="ie9 no-js" lang="en">
<html lang="en" class="no-js">
	<head>
		<title>Smart India</title>
		
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
		

		
		{!! HTML::style('css/app.css') !!}
		

		{!! HTML::style('plugins/bootstrap/css/bootstrap.min.css', array('media' => 'screen')) !!}
		{!! HTML::style('plugins/font-awesome/css/font-awesome.min.css') !!}
		{!! HTML::style('fonts/style.css') !!}
		{!! HTML::style('css/main.css') !!}
		{!! HTML::style('css/main-responsive.css') !!}
		
		{!! HTML::style('css/theme_light.css', array('id' => 'skin_color')) !!}

		{!! HTML::style('plugins/select2/select2.css') !!}
		
		<!-- Datatables -->
		{!! HTML::style('//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css') !!}
		
		{!! HTML::style('css/style.css') !!}

		{!! HTML::style('favicon.ico', array('rel' => 'shortcut icon')) !!}

		{!! HTML::style('plugins/DataTables/media/css/DT_bootstrap.css') !!}

		{!! HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') !!}


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
					<a class="navbar-brand" href="{{asset('/index')}}"> <img src="{{asset('/images/logo.png')}}" width=140 alt="Smart India" /> </a>
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
							href="#"> <span class="username">Admin</span> <i class="clip-chevron-down"></i> </a>
							<ul class="dropdown-menu">
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
					
						<li class="highlight">
							<a href="javascript:void(0)" ><i class="clip-users"></i> <span class="title">Users</span><i class="icon-arrow"></i> <span class="selected"></span> </a>

							<ul class="sub-menu">						
								<li class="list">
									<a href={{asset('users/list')}}> <span class="title">User List</span> </a>
								</li>
								
							</ul>

						</li>

						<li class="highlight">
							<a href="javascript:void(0)" ><i class="fa fa-edit "></i> <span class="title">Topics</span><i class="icon-arrow"></i> <span class="selected"></span> </a>

							<ul class="sub-menu">						
								<li class="list">
									<a href={{asset('topics/list')}}> <span class="title">Topic List</span> </a>
								</li>
								<li class="add">
									<a href={{asset('topics/add')}}> <span class="title">Add Topic</span> </a>
								</li>
								
							</ul>

						</li>
                        
                        <li class="highlight">
							<a href={{asset('gallery/listImages/all')}} class="highlight"><i class="clip-images"></i> <span class="title"> Gallery </span><span class="selected"></span> </a>
						</li>

						<li class="highlight">
							<a href="javascript:void(0)" ><i class="fa fa-comments"></i> <span class="title">Feedback</span><i class="icon-arrow"></i> <span class="selected"></span> </a>

							<ul class="sub-menu">						
								<li class="list">
									<a href={{asset('feedback/userfeedbacklist')}}> <span class="title">User Feedback List</span> </a>
								</li>
								<li class="add">
									<a href={{asset('feedback/teamfeedbacklist')}}> <span class="title">Team Feedback List</span> </a>
								</li>
								
							</ul>

						</li>
						<li class="highlight">
							<a href="javascript:void(0)" ><i class="fa fa-bell"></i> <span class="title">Notifications</span><i class="icon-arrow"></i> <span class="selected"></span> </a>

							<ul class="sub-menu">						
								<li class="list">
									<a href={{asset('notification/list')}}> <span class="title">Notifications List</span> </a>
								</li>
								<li class="add">
									<a href={{asset('notification/add')}}> <span class="title">Add Notifications</span> </a>
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

		
		

		{!! HTML::script('plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js') !!}

		{!! HTML::script('plugins/blockUI/jquery.blockUI.js') !!}
		{!! HTML::script('plugins/iCheck/jquery.icheck.min.js') !!}

		{!! HTML::script('plugins/perfect-scrollbar/src/jquery.mousewheel.js') !!}
		{!! HTML::script('plugins/perfect-scrollbar/src/perfect-scrollbar.js') !!}

		{!! HTML::script('js/main.js') !!}

		{!! HTML::script('plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}

		{!! HTML::script('plugins/less/less-1.5.0.min.js') !!}
		{!! HTML::script('plugins/jquery-cookie/jquery.cookie.js') !!}
		{!! HTML::script('plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js') !!}

		{!! HTML::script('js/index.js') !!}

		{!! HTML::script('plugins/jquery-validate/jquery.validate.min.js') !!}
		
		<!-- Datatables -->
		{!! HTML::script('//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js') !!}
		{!! HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') !!}
		
		{!! HTML::script('plugins/select2/select2.min.js') !!}
		{!! HTML::script('js/form-validation.js') !!}
		{!! HTML::script('plugins/summernote/build/summernote.min.js') !!}

		{!! HTML::script('plugins/ckeditor/ckeditor.js') !!}
		{!! HTML::script('plugins/ckeditor/adapters/jquery.js') !!}

		{!! HTML::script('js/form-elements.js') !!}
		{!! HTML::script('plugins/colorbox/jquery.colorbox-min.js') !!}

		{!! HTML::script('js/moment.js') !!}
		{!! HTML::script('js/script.js') !!}

		<script>
			$(document).ready(function() {

				Main.init();
				menuSelect("{{asset('/')}}");

				
				function menuSelect(base_url){
					var url = window.location.href.split('#')[0];
					if(url.indexOf(base_url) > -1){
						url = url.substring(base_url.length);
						var sel = url.split('/');
						$('.'+sel[0]).addClass('active open');
						if(sel.length > 1)
							$('.'+sel[0] +' .'+sel[1] ).addClass('active');
					}
					else{
				console.log('URL not found');
				}
				} 


				$('.search-select').select2();
				$.ajaxSetup({
					headers : {
						'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
					}
				});

				
			});

		</script>

		@stack('scripts')
		<!-- App scripts -->

	</body>
	<!-- end: BODY -->
</html>