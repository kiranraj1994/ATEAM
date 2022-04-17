<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
		<title>@yield('metaTitle','Ateam')</title>
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta name="description" content="@yield('metaDescription','Ateam')" />
		<meta name="keywords" content="@yield('metaKey','Ateam')" />
		<meta name="canonical" content="@yield('canonicalUrl','Ateam')" />
		{{-- bootstrap --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">	
		{{-- Custom --}}
		<link rel="stylesheet" href="{{ URL::asset('front/css/custom.css')}}">
		<!-- SweetAlert2 -->
		<link rel="stylesheet" href="{{ URL::asset('front/extras/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
		<!-- Select2 -->
		<link rel="stylesheet" href="{{ URL::asset('front/extras/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
		{{-- fonawsome --}}
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">
		{{-- daterangepicker --}}
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
		{{-- datatables --}}
		<link rel="stylesheet"
        href="{{ URL::asset('front/extras/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    	<link rel="stylesheet"
        href="{{ URL::asset('front/extras/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    	<link rel="stylesheet"
        href="{{ URL::asset('front/extras/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    
	</head>
	<body>
		
		<div class="loaderDiv" id="loaderImage">
      		<img src="{{URL::asset('front/img/loader.gif')}}" alt="" class="" id="">
    	</div>

		<header>
			<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
				<a class="navbar-brand" href="{{ url('/') }}">EVENTS</a>
				<ul class="navbar-nav mr-auto">
				  <li class="nav-item">
					<a class="nav-link" href="{{ url('/') }}">Home</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="{{ url('/statistics') }}">Statistics</a>
				  </li>
				  @auth
				  <li class="nav-item">
					<a class="nav-link" href="{{ url('/dashboard') }}">Your Events</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="{{ url('/logout') }}">Logout</a>
				  </li>
				  @else
				  <li class="nav-item">
					<a class="nav-link" href="{{ url('/login') }}">Login</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="{{ url('/sign-up') }}">Sign Up</a>
				  </li>
				  @endauth
				  
				</ul>

				

			  </nav>
		</header>

			@yield('content')

		<footer>

		</footer>




		<!--Code for Blank Multiple task -->
<div class="modal fade bs-modal-sm" id="alert_message_div" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm modal-dialog-centered">
	  <div class="modal-content">
		<div class="modal-header"  style="background:#00124b;color:#fff">
		 <h4 id="alert_message_div_header"></h4>
	   </div>
	   <div class="modal-body" id="alert_message_div_message">
		
	   </div>
	   <div class="modal-footer">
		<button class="btn badge btn-primary " data-dismiss="modal" aria-hidden="true">Ok <i class="fa fa-thumbs-up"></i></button>
	  </div>
	</div>
  </div>
  </div>
  {{-- END CODE FOR BLANK POPUP --}}
  
  
  
  <!--Code for Confirm Multiple Task-->
  <div class="modal fade bs-modal-sm" id="alert_confirm_div" tabindex="-1" role="dialog" aria-hidden="true" >
	<div class="modal-dialog modal-sm modal-dialog-centered" >
	  <div class="modal-content">
  
		<form role="form" method="post" action="" class="ajax_form" id="DeleteMultipleForm">
		  @csrf
		  <div class="modal-header" style="background:#00124b;color:#fff">
		   
			<h4 id="alert_message_div_header text-left" style="width: 100%;">Please Confirm </h4>
		  </div>
		  <input type="hidden" name="ids" value="" id="multiple_Ids">
		  <input type="hidden" name="task" value="" id="task">
		  
		  <div class="modal-body">
			<p id="confirm_alert_message_body"></p>
		  </div>
		  <div class="modal-footer">
			<button class="btn badge btn-danger" data-dismiss="modal">Cancel <i class="fa fa-times"></i></button>
			<button class="btn badge btn-success" type="submit">Confirm <i class="fa fa-check"></i></button>
		  </div>
		</form>     
	  </div>
	</div>
  </div>
  <!--End Code for Confirm Multiple Task-->
  
  


		<!-- jQuery -->
    	<script src="{{ URL::asset('front/extras/jquery/jquery.min.js') }}"></script>

    	<!-- jQuery UI 1.11.4 -->
    	<script src="{{ URL::asset('front/extras/jquery-ui/jquery-ui.min.js') }}"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  		<!-- SweetAlert2 -->
		<script src="{{ URL::asset('front/extras/sweetalert2/sweetalert2.min.js')}}"></script>
		{{-- Common Scripts --}}
		<script src="{{ URL::asset('front/js/common.js')}}"></script>
		{{-- Form Validation --}}
		<script src="{{ URL::asset('front/js/form.js')}}"></script>
		{{-- daterangepicker --}}
		<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
		{{-- datatables --}}
		
    	
    	
		<!-- DataTables  & Plugins -->
		<script src="{{ URL::asset('front/extras/datatables/jquery.dataTables.min.js') }}"></script>
		<script src="{{ URL::asset('front/extras/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
		<script src="{{ URL::asset('front/extras/datatables-responsive/js/dataTables.responsive.min.js') }}">
		</script>
		<script src="{{ URL::asset('front/extras/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
		</script>
		<script src="{{ URL::asset('front/extras/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
		<script src="{{ URL::asset('front/extras/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
	
		@include('flash-message')

		
		
  		