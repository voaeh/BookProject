@extends('mobile.layout.master')
<?php
	$title = "Login";
?>
@section('title', $title)

@section('head')

@endsection

@section('content')
<form name="formLogin" id="formLogin" method="post" action="{{route('m_login')}}" >
	{{csrf_field()}}
	<div class="login-box">
		<div class="title">เข้าสู่ระบบ</div>
		<div class="form-group">
			<input type="text" class="form-control" id="user_login" name="user_login" placeholder="กรุณาใส่ email หรือ เบอร์โทร">
		</div>
		<div class="form-group">
			<input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
		</div>
		<div class="col-md-12 text-center">
			<button type="submit" class="btn btn-success">ตกลง</button>
		</div>
	</div>
</form>
@endsection

@section('after-content')
<script>
$(document).ready(function(){
	
	$.validator.addMethod("passwordRegex",
    function(value, element) {
		if (value != '')
		{
			return value.match(/^([a-zA-Z0-9_]+){6,20}$/);
		}
		else
		{
			return false;
		}
    },
    "รหัสผ่านต้องมีความยาว 6-20 ตัวอักษร ประกอบด้วยตัวอักษรภาษาอังกฤษ ตัวเลข และ เส้นใต้");
	
	$('#formLogin').validate({
        rules: {
            user_login: { 
				required: true
            },
			user_password: { 
				required: true,
				passwordRegex: true
            }
        },
        messages: {
            user_login: { // message declared
                required: "email หรือ เบอร์โทร ไม่สามารถเว้นว่างได้"
            },
			user_password: { // message declared
                required: "Password ไม่สามารถเว้นว่างได้"
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });
});
</script>
@endsection