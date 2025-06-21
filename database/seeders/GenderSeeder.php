<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Male'],
            ['name' => 'Female'],
            ['name' => 'None'],
        ];

        // Using Query Builder (insert all rows at once into db without any model login)
        DB::table('genders')->insert($data); 




        
    /*
        // Using Eloquent Model with save()
        foreach($data as $d){
            $gender = new Gender();
            $gender->name = $d['name'];
            $gender->save();  // save one row
        }
    */
    /*
        // Using Eloquent Model with create() and must define fillable in Model 
        foreach ($data as $d) {
            Gender::create($d);  // save one row
        }
    */
        //  model events, timestamps, accessors, or relationships are using there
        // short-hand : collect($data)->each(fn($item) => Gender::create($item));
        
    }
}
