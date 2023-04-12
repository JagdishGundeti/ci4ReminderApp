<?php
namespace App\Models;

class CandidateHistModel extends GoBaseModel
{
    protected $table = 'candidate';
    protected $tableT2PH = 'task_to_process_history';
 
	protected $allowedFields = [
			'name',
			'email',
			'phone',
			'joining_date',
			'department',
			'job_title',
			'manager_id',
		];
	protected $returnType = 'App\Entities\CandidateHist';

	protected $useTimestamps = true;

	protected $createdField  = 'created_at';

	protected $updatedField  = 'updated_at';

	public static $labelField = 'name';

	public function findAllCandidates(string $selcols='*', int $limit=null, int $offset = 0) { 
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
	public function findCandidateHist(int $id) { 
		$sql = 'SELECT
					ttph.id AS id,
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
					ttph.created_at,
					ttph.updated_at,
					ttph.deleted_at,
					ttph.note,
					si.text as status_text
				FROM hr_task ht
						JOIN hr_sub_task hst ON (ht.id = hst.hr_task_id AND hst.active = 1)
						JOIN task_to_process_history ttph ON (hst.id = ttph.hr_sub_task_id)
						JOIN candidate cand ON (cand.id = ttph.process_group_id AND ttph.process_group = "CAND")
						JOIN status_info si ON (si.status_info_id = ttph.status_info_id )';
		$sql .= ' WHERE 1 = 1 ';
		if (!is_null($id) && intval($id) > 0) {
			$sql .= ' AND ttph.process_group_id = ' . intval($id);
		}

		$query = $this->db->query($sql);
		$result = $query->getResultObject();
		return $result;
	}
 
}