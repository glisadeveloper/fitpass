<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gym;

class GymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gyms = array(
	    		[
	            'name' => 'GeekFit',	           
	        	],
	        	[
	            'name' => 'FitFit',
	        	]
	        );

    	Gym::truncate();
		foreach ($gyms as $gym) 
		{
        	Gym::create(['name' => $gym['name']]);
        }
    }
}
