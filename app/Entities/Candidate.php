<?php
namespace App\Entities;

class Person extends GoBaseEntity
{ 
	protected $attributes = [
			'id' => null,
			'name' => null,
			'phone' => null,
			'email' => null,
			'start_date' => null,
			'department' => null,
			'job_title' => null,
			'manager_id' => null,
			'created_at' => null,
			'updated_at' => null,
		];
}