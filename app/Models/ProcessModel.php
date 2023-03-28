<?php
namespace App\Models;

class ProcessModel extends GoBaseModel
{
    protected $table = 'task_to_process';
    protected $join_table = 'candidate';
 
	protected $allowedFields = [
			'id',
			'hr_sub_task_id',
			'process_group_id',
			'process_group',
			'no_of_days',
			'note',
			'created_at',
			'updated_at',
			'deleted_at',
			'status',
		];
	protected $returnType = 'App\Entities\Process';

	protected $useTimestamps = true;

	protected $createdField  = 'created_at';

	protected $updatedField  = 'updated_at';

	public static $labelField = 'name';

	public function findAllWithCities(string $selcols='*', int $limit=null, int $offset = 0) { 
		$sql = 'SELECT * FROM ' . $this->table .
		' RIGHT JOIN  ' . $this->join_table  . ' ON process_group_id = candidate.id '
		;
		$sql = 'SELECT * FROM ' . 'candidate' .
		' RIGHT JOIN  ' . $this->join_table  . ' ON process_group_id = candidate.id '
		;

		$sql = 'SELECT * FROM hr_task 
					JOIN hr_sub_task ON hr_task.id = hr_sub_task.hr_task_id 
					JOIN candidate
				WHERE hr_sub_task.id NOT IN (
					SELECT hr_sub_task_id FROM task_to_process
				)'
		;
		
		$sql = 'SELECT
					hr_sub_task.id AS id,
					candidate.id AS candidate_id,
					name,
					department,
					phone,
					task_name,
					subtask_name,
					hr_sub_task.start_date,
					hr_sub_task.end_date,
					hr_sub_task.created_at,
					hr_sub_task.updated_at,
					hr_sub_task.deleted_at
				FROM hr_task 
						JOIN hr_sub_task ON hr_task.id = hr_sub_task.hr_task_id 
						JOIN candidate
				/*
				WHERE hr_sub_task.id NOT IN (
					SELECT hr_sub_task_id FROM task_to_process
				*/
				WHERE (hr_sub_task.id,candidate.id) NOT IN (
					SELECT hr_sub_task_id,process_group_id FROM task_to_process
				)'
		;
		
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
 
	public function findAllProcessList(string $selcols='*', int $limit=null, int $offset = 0) { 
		
		$sql = 'SELECT
					hr_sub_task.id AS id,
					candidate.id AS candidate_id,
					name,
					department,
					phone,
					task_name,
					subtask_name,
					hr_sub_task.start_date,
					hr_sub_task.end_date,
					hr_sub_task.created_at,
					hr_sub_task.updated_at,
					hr_sub_task.deleted_at,
					task_to_process.status
				FROM hr_task 
						JOIN hr_sub_task ON hr_task.id = hr_sub_task.hr_task_id 
						JOIN candidate
						JOIN task_to_process 
						  ON (hr_sub_task.id = hr_sub_task_id AND candidate.id = process_group_id AND process_group = "CAND")
				'
		;
		
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