<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Library\Queryhelper;
use DB;

class Reader extends Model
{
    protected $table = 'reader';
	
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
	
	public function login($params, $type)
	{
		if ($type == 1)
		{
			$select = DB::table($this->table)
								->where('email', '=', $params['user_login'])
								->where('password', '=', $params['user_password'])
								->where($this->table.'.del_flg', '=', 0)
								->select($this->table.'.*');
		}
		else if ($type == 2)
		{
			$select = DB::table($this->table)
								->where('tel_no', '=', $params['user_login'])
								->where('password', '=', $params['user_password'])
								->where($this->table.'.del_flg', '=', 0)
								->select($this->table.'.*');
		}

		$data = $select->get();
		
		return $data;
	}
	
	public function registReader($params)
	{
		$id = DB::table($this->table)->insertGetId($params);
		
		return $id;
	}
	
}
