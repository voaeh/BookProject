<?php 
namespace App\Library;

class Queryhelper 
{
	
    public function bindParams($table, $params)
	{
		foreach($params as $key=>$value)
		{

			if ($value != '')
			{
				switch($key)
				{
					case 'take':
							$table->take($value);
						break;
					case 'skip':
							$table->skip($value);
						break;
					case 'dispRow':
						$table->take($value);
						break;
					case 'dispPage':
						$perPage = $params['dispRow'];
						$page = $value;
						$pageStart = (($perPage*$page)-$perPage);
						$table->skip($pageStart);
						break;
					default:
						$table->where($key, '=', $value);
				}
			}
				
		}
		
		return $table;
	}
    
}

?>