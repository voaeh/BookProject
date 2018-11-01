@extends('mobile.layout.master')
<?php
	$title = "Register Success";
?>
@section('title', $title)

@section('head')

@endsection

@section('content')
	<div class="text-center m-t-30">
		<img src="{{asset('img/common/right_icon.png')}}" />
		<div>ลงทะเบียนสำเร็จ</div>
		<a href="{{route('m_topPage')}}" class="btn btn-success">กลับไปหน้าหลัก</a>
	</div>
@endsection

@section('after-content')
<script>
$(document).ready(function(){
	
  setTimeout(function() {
	url = "{{route('m_topPage')}}";
    window.location.replace(url);
  }, 5000);
	
});
</script>
@endsection