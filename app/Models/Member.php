<?php
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Member extends Model
	{
		protected $table = "members";
		protected $fillable = [
			'first_name', 
			'last_name', 
			'id_card_number', 
			'object_name',
			'last_login_at'
		];
	}