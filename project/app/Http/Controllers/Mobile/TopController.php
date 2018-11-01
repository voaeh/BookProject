<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Post;

class TopController extends Controller
{
	public $data = array();
	
    public function init()
    {
		$postModel = new Post;
		
		$reviewList = $postModel->searchReviews();
		
		if (count($reviewList) > 0)
		{
			$this->data['reviewList'] = $reviewList;
		}
		
        return view('mobile.index', $this->data);
    }
}