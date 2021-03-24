<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $faker = Faker::create();

        for ($i=0; $i < 5 ; $i++) { 
           
            $data = [
                'username' => $faker->userName,
                'password' => $faker->password,
                'department_id' => $faker->randomDigit,
                'jabatan_id' => $faker->randomDigit,
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'email' => $faker->email,
                'telp' => $faker->phoneNumber
            ];
    
            Users::create($data);
            
        }

        
    }
}
