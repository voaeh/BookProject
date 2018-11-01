<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Library\Queryhelper;
use DB;

class Post extends Model
{
    protected $table = 'post';
	
	public function searchByParams($params=array())
    {
        $select = DB::table($this->table)
                    ->selectRaw($this->table.".*");


        $queryHelper = new Queryhelper;

        $select = $queryHelper->bindParams($select, $params);

        return $select->get();
    }
	
	public function countByParams($params=array())
    {
        $select = DB::table($this->table)
                    ->select($this->table.'.*');


        $queryHelper = new Queryhelper;

        $select = $queryHelper->bindParams($select, $params);

        return $select->count();
    }
	
	public function searchReviews($params=array())
    {
        $select = DB::table($this->table)
					->leftJoin('reader', 'reader.reader_id', '=', $this->table.'.reader_id')
					->orderBy($this->table.'.create_date', 'DESC')
                    ->selectRaw($this->table.".*, username, display_name");


        $queryHelper = new Queryhelper;

        $select = $queryHelper->bindParams($select, $params);

        return $select->get();
    }
	
}
