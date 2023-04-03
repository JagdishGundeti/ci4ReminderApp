<?php
namespace App\Models;
define('STATUS_INFO_COMPLETED',     800);

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
			'status_info_id',
		];
	protected $returnType = 'App\Entities\Process';

	protected $useTimestamps = true;

	protected $createdField  = 'created_at';

	protected $updatedField  = 'updated_at';

	public static $labelField = 'name';

	public function findAllWithCities(string $selcols='*', int $limit=null, int $offset = 0) { 
	/*
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
	*/
		$sql = 'SELECT
					hst.id AS id,
					candidate.id AS candidate_id,
					name,
					department,
					phone,
					task_name,
					subtask_name,
					candidate.joining_date,
					hst.no_of_days,
					DATE_ADD( joining_date, INTERVAL hst.no_of_days DAY) AS task_date,
					hst.end_date,
					hst.created_at,
					hst.updated_at,
					hst.deleted_at
				FROM hr_task 
						JOIN hr_sub_task hst ON hr_task.id = hst.hr_task_id 
						JOIN candidate
				WHERE (hst.id,candidate.id) NOT IN (
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
 //https://stackoverflow.com/questions/18302181/mysql-function-to-count-days-between-2-dates-excluding-weekends
 //https://stackoverflow.com/questions/38522170/mysql-add-working-days-to-date
	//public function findAllProcessList(string $selcols='*', int $limit=null, int $offset = 0) { 
	public function findAllProcessList(string $selcols='*', int $id = null, int $limit=null, int $offset = 0) { 

		$sql = 'SELECT
					ttp.id AS id,
					hst.id AS hr_sub_task_id,
					cand.id AS candidate_id,
					name,
					department,
					phone,
					task_name,
					subtask_name,
					cand.joining_date,
					hst.no_of_days,
					DATE_ADD( cand.joining_date, INTERVAL hst.no_of_days DAY) AS task_date,
					hst.end_date,
					hst.created_at,
					hst.updated_at,
					hst.deleted_at,
					si.text as status_text
				FROM hr_task ht
						JOIN hr_sub_task hst ON (ht.id = hst.hr_task_id)
						JOIN task_to_process ttp ON (hst.id = ttp.hr_sub_task_id)
						JOIN candidate cand ON (cand.id = ttp.process_group_id AND ttp.process_group = "CAND")
						JOIN status_info si ON (si.status_info_id = ttp.status_info_id
						     AND si.status_info_id <> ' . STATUS_INFO_COMPLETED . ')'
						 
		;
		$sql .= ' WHERE 1 = 1 ';
		if (!is_null($id) && intval($id) > 0) {
			$sql .= ' AND ttp.id = ' . intval($id);
		}
		
		if (!is_null($limit) && intval($limit) > 0) {
			$sql .= ' LIMIT ' . intval($limit);
		}

		if (!is_null($offset) && intval($offset) > 0) {
			$sql .= ' OFFSET ' . intval($offset);
		}

		$query = $this->db->query($sql);
		$result = null;
		if (!is_null($id) && intval($id) > 0) {
			$result =  $query->getResultObject()[0];
		}
		else{
			$result = $query->getResultObject();
		}
		return $result;
	}
}