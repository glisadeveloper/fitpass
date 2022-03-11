<?php
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Log extends Model
	{
		protected $table = "logs";
		protected $fillable = [
			'member_id', 
			'object_name',
			'entry_time'
		];
	}