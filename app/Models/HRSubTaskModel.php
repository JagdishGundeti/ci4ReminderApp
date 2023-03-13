<?php
namespace App\Models;

class HRSubTaskModel extends GoBaseModel
{
    protected $table = 'hr_sub_task';
    protected $tableHRTask = 'hr_task';
 
	protected $allowedFields = [
			'id',
			'subtask_name',
			'task_name',
			'start_date',
			'end_date',
		];
	protected $returnType = 'App\Entities\HRSubTask';

	protected $useTimestamps = true;

	protected $createdField  = 'created_at';

	protected $updatedField  = 'updated_at';

	public static $labelField = 'name';

	public function findAllWithCities(string $selcols='*', int $limit=null, int $offset = 0) { 
		//$sql = 'SELECT * FROM ' . $this->table . ' JOIN ' . $tableHRTask . ' ON hr_task_id = hr_task.id';
		$sql = 'SELECT hr_sub_task.id,subtask_name,task_name,hr_sub_task.start_date,hr_sub_task.end_date,task_name		
		 FROM hr_sub_task JOIN hr_task on hr_task_id = hr_task.id';
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