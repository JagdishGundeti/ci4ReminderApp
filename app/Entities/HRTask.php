<?php
namespace App\Entities;

class HRTask extends GoBaseEntity
{ 
	protected $attributes = [
			'id' => null,
			'task_name' => null,
			'start_date' => null,
			'end_date' => null,
		];
	protected $casts = [
			'city_id' => '?int',
			'enabled' => 'boolean',
			'score' => '?float',
		]; 
}