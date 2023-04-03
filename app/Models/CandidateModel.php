<?php
namespace App\Models;

class CandidateModel extends GoBaseModel
{
    protected $table = 'candidate';
 
	protected $allowedFields = [
			'name',
			'email',
			'phone',
			'joining_date',
			'department',
			'job_title',
			'manager_id',
		];
	protected $returnType = 'App\Entities\Candidate';

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