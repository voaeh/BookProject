@extends('mobile.layout.master')
<?php
	$title = "QED";
?>
@section('title', $title)

@section('head')
<link rel="stylesheet" href="{{asset('plugins/jquery-ui-1.12.1/jquery-ui.css')}}">
<script src="{{asset('plugins/jquery-ui-1.12.1/jquery-ui.js')}}"></script>
@endsection

@section('content')
	<input type="button" class="add-post-btn" value="+ เพิ่มโพสใหม่" >
	@if (isset($reviewList))
		@foreach ($reviewList as $review)
		<?php
			$post_date = new \DateTime($review->create_date);
			$today = new \DateTime();
			$interval = $post_date->diff($today);
			$year = 0;
			$month = 0;
			$day = 0;
			$hour = 0;
			$minute = 0;
			
			$year = $interval->format('%Y');
			$time_text = "ปี";
			
			if ($year == 0)
			{
				$month = $interval->format('%m');
				$time_text = "เดือน";
				
				if ($month == 0)
				{
					$day = $interval->format('%d');
					$time_text = "วัน";
					
					if ($day == 0)
					{
						$hour = $interval->format('%h');
						$time_text = "ชั่วโมง";
						
						if ($hour == 0)
						{
							$minute = $interval->format('%i');
							$time_text = "นาที";
						}
					}
				}
			}
		?>
		<div class="review-box">
			<div class="user-img"><img src="{{asset('img/common/admin_user.jpg')}}" /></div>
			<div class="user-text">{{$review->display_name}} <div class="time">{{$review->username}} &#183; 
			@if ($year > 0)
				{{$year}} 
			@elseif ($month > 0)
				{{$month}} 
			@elseif ($day > 0)
				{{$day}} 
			@elseif ($hour > 0)
				{{$hour}} 
			@elseif ($minute > 0)
				{{$minute}} 
			@endif
			
			{{$time_text}}</div></div>
			<div class="clearfix"></div>
			<?php
				$readerFolder =  public_path()."/img/reader/".$review->reader_id;
				$imgFile = $readerFolder."/".$review->image;
				
				$imgUrl = "";
				
				if (file_exists($imgFile))
				{
					$imgUrl = asset('img/reader/'.$review->reader_id.'/'.$review->image);
					
					list($width, $height, $type, $attr) = getimagesize($imgFile);
				}
			?>
			
			@if ($imgUrl != "")
				@if ($width > 270)
				<div class="book-img popup">
					<img src="{{$imgUrl}}" class="book-image portrait" alt="{{$review->title}}" />
				</div>
				@else
					<img src="{{$imgUrl}}" alt="{{$review->title}}" />
				@endif
			@endif
			
			<div class="book-title">
				{{$review->title}}
			</div>
			<div class="book-detail" id="short_review_{{$review->post_id}}">
			<?php
				$length = mb_strlen($review->detail);
				$read_more = false;
				
				if ($length > 120)
				{
					$short_review = mb_substr($review->detail, 0, 120)."...";
					$read_more = true;
				}
				else
				{
					$short_review = $review->detail;
				}
			?>
				{{$short_review}}
				@if ($read_more)
				<a href="javascript:void(0)" id="a_{{$review->post_id}}" onclick="show_full({{$review->post_id}})" class="read-more">
					อ่านต่อ
				</a>
				@endif
			</div>
			<div class="book-detail" id="full_review_{{$review->post_id}}" style="display:none">
				<?php echo nl2br($review->detail); ?>
			</div>
			
		</div>
		@endforeach
	@endif
	<div id="dialog_image" title="">
	  <img id="bookShow" src="" />
	</div>
@endsection

@section('after-content')
<script>
$(function () {
	
	$(".book-image").on( "click", function() {
		
	  imgUrl = $(this).attr('src');
	  title = $(this).attr('alt');
	  $("#bookShow").attr('src', imgUrl);

	  width = $(window).width();
	  height = $(window).height();
	  
	  if (width > 720)
	  {
		  width = 720;
	  }
	  
	  if (height > 600)
	  {
		  height = 600;
	  }
	  else
	  {
		  height = height - 20;
	  }
	  
      $( "#dialog_image" ).dialog({
		  modal: true,
		  title: title,
		  width: width,
		  height: height,
		  buttons: {
			'ปิด': function() {
			  $( this ).dialog( "close" );
			}
		  }
		});
    });
	
});
</script>
@endsection