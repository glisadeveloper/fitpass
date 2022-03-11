<?php
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Gym extends Model
	{
		protected $table = "gyms";
		protected $fillable = [
			'name'
		];
	}
