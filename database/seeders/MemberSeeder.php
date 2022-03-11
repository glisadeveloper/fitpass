<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $members = array(
	    		[
	            'first_name' => 'John',
	            'last_name' => 'Doe',
	            'id_card_number' => 'b25dbd5d0b92',
	            'object_name' => 'GeekFit',
		        'last_login_at' => ''
	        	],
	        	[
	            'first_name' => 'Gligorije',
	            'last_name' => 'Saric',
	            'id_card_number' => 'f6295d76bc1a',
	            'object_name' => 'GeekFit',
                'last_login_at' => ''
	        	]
	        );

    	Member::truncate();
	    foreach ($members as $member) 
		{
        	Member::create([
        		'first_name' => $member['first_name'],
            	'last_name' => $member['last_name'],
            	'id_card_number' => $member['id_card_number'],
            	'object_name' => $member['object_name'],
		        'last_login_at' => $member['last_login_at']
    		]);
        }
    }
}
