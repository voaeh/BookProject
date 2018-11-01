@extends('mobile.layout.master')
<?php
	$title = "Register";
?>
@section('title', $title)

@section('head')

@endsection

@section('content')
<form name="formRegister" id="formRegister" method="post" action="{{route('m_register')}}" >
	{{csrf_field()}}
	<div class="login-box">
		<div class="title">ลงทะเบียน</div>
		<div class="form-group">
			<input type="text" class="form-control" id="user_login" name="user_login" placeholder="กรุณาใส่ email หรือ เบอร์โทร">
			<div class="warn-label">(เบอร์โทรต้องเป็นตัวเลขเท่านั้น)</div>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
		</div>
		<div class="form-group">
			<input type="password" class="form-control" id="confirm_user_password" name="confirm_user_password" placeholder="ยืนยัน Password">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" id="display_name" name="display_name" placeholder="ชื่อที่ต้องการใช้">
			<div class="warn-label">(สามารถเปลี่ยนได้ภายหลัง)</div>
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
	
	$.validator.addMethod("userRegex",
    function(value, element) {
		if (value != '')
		{
			var isEmail = value.match(/^[^@]+@[^@]+\.[^@]+$/);
			var isTelno = value.match(/^[0-9]+$/);
			var isValid = isEmail || isTelno;
			
			return isValid;
		}
		else
		{
			return false;
		}
    },
    "email หรือ เบอร์โทรไม่ถูกต้อง");
	
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
	
	$.validator.addMethod("confirmPassword",
    function(value, element) {
		if (value != '')
		{
			if (value != $("#user_password").val())
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			return false;
		}
    },
    "ยืนยัน Password ไม่ถูกต้อง");
	
	$('#formRegister').validate({
        rules: {
            user_login: { 
				required: true,
				userRegex: true
            },
			user_password: { 
				required: true,
				passwordRegex: true
            },
			confirm_user_password: {
				required: true,
				confirmPassword: true
			},
			display_name: {
				required: true
			}
        },
        messages: {
            user_login: { // message declared
                required: "email หรือ เบอร์โทร ไม่สามารถเว้นว่างได้"
            },
			user_password: { // message declared
                required: "Password ไม่สามารถเว้นว่างได้"
            },
			confirm_user_password: { // message declared
                required: "ยืนยัน Password ไม่สามารถเว้นว่างได้"
            },
			display_name: { // message declared
                required: "ชื่อผู้ใช้ ไม่สามารถเว้นว่างได้"
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