<html lang="{{Session::get('language')}}">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="index,follow"/>
		
		<title>@yield('title')</title>

		<link href="{{asset('css/normalize.css')}}" rel="stylesheet">
		<!-- Bootstrap Core Css -->
		<link href="{{asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		
		<link href="{{asset('css/mobile.css')}}" rel="stylesheet">
        
		<!-- Jquery Core Js -->
		<script src="{{asset('js/jquery.js')}}"></script>
		<script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
		
		<script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>
		

		@yield('head')

	</head>
	<body>
		<div id="container">
			<div id="header">
				<div class="header-content">
					<div class="left"><a href="{{route('m_topPage')}}"><b>QED</b> อ่านไรดีนะ?</a></div>
					@if (Session::has('reader_id'))
						<?php
							$imgUrl = 'img/reader/'.Session::get('reader_id').'/'.Session::get('reader_image');
						?>
						<div class="user-img dropdown">
							<a href="javascript:void(0)" onclick="showUserMenu()" title="{{Session::get('email')}}"><img src="{{asset($imgUrl)}}" /></a>
							
							<div class="gb_tb"></div>
							<div class="gb_sb"></div>
							<div id="user_menu" >
								<a href="" class="btn-logout">แก้ไขข้อมูล</a>
								<a href="{{route('m_logout')}}" class="btn-logout">ออกจากระบบ</a>
							</div>
						</div>
						
					@else
						<div class="right"><a href="{{route('m_login')}}">เข้าสู่ระบบ</a> / 
						<a href="{{route('m_register')}}">ลงทะเบียน</a>
						</div>
					@endif
				</div>
			</div>
			<div id="body">
				@yield('content')
			</div>
			<div id="footer">
				<a href="https://www.facebook.com/read.qed/?ref=settings" target="_blank"><img src="{{asset('img/common/facebook-button-998c7500.svg')}}" alt="Facebook button"></a>
				<a href="https://twitter.com/QedRead" target="_blank"><img src="{{asset('img/common/twitter-button-f27fb77f.svg')}}" alt="Twitter button"></a>
			</div>
			
		</div>
	
	@yield('after-content')
<script>
	function show_full(post_id)
	{
		$("#a_"+post_id).hide();
		$("#short_review_"+post_id).hide();
		$("#full_review_"+post_id).show();
	}
	
	function showUserMenu()
	{
		if ($("#user_menu").is(":visible"))
		{
			$("#user_menu").hide();
			$(".gb_tb").hide();
			$(".gb_sb").hide();
		}
		else
		{
			$("#user_menu").show();
			$(".gb_tb").show();
			$(".gb_sb").show();
		}
	}
	
</script>
	</body>
</html>