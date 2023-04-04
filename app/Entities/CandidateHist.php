<?php
namespace App\Entities;

class CandidateHist extends GoBaseEntity
{ 
	protected $attributes = [
			'id' => null,
			'task_to_process_id' => null,
			'name' => null,
			'phone' => null,
			'email' => null,
			'joining_date' => null,
			'department' => null,
			'job_title' => null,
			'manager_id' => null,
			'created_at' => null,
			'updated_at' => null,
		];
}