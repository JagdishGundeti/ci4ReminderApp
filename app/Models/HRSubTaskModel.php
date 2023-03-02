<?php
namespace App\Models;

class HRSubTaskModel extends GoBaseModel
{
    protected $table = 'hr_sub_task';
 
	protected $allowedFields = [
			'hr_task_id',
			'subtask_name',
			'start_date',
			'end_date',
		];
	protected $returnType = 'App\Entities\HRSubTask';

	protected $useTimestamps = true;

	protected $createdField  = 'created_at';

	protected $updatedField  = 'updated_at';

	public static $labelField = 'name';

	public function findAllWithCities(string $selcols='*', int $limit=null, int $offset = 0) { 
		$sql = 'SELECT * FROM ' . $this->table ; 
		if (!is_null($limit) && intval($limit) > 0) {
			$sql .= ' LIMIT ' . intval($limit);
		}

		if (!is_null($offset) && intval($offset) > 0) {
			$sql .= ' OFFSET ' . intval($offset);
		}

		$query = $this->db->query($sql);
		$result = $query->getResultObject();
		return $result;
	}
 
}