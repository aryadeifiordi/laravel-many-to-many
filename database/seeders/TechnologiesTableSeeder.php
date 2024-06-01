<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $technologies = [
            ['name' => 'Laravel'],
            ['name' => 'Vue.js'],
            
            
        ];

        
        foreach ($technologies as $technology) {
            Technology::create($technology);
        }
    }
}
