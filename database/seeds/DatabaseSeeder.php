<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = md5(hash('sha512', 'admin').hash('ripemd160', 'admin').md5("strongest"));
        DB::table('users')->insert([
            'name' => 'Fhoebe Kates Castillo',
            'address' => 'Dagupan City, Pangasinan',
            'email' => 'fhoebekatescastillo@yahoo.com',
            'mobile' => '09123456789',
            'image' => 'uploads/earthhub.png',
            'username' => 'superadmin',
            'password' => $password,
            'role' => 'superadmin',
            'approved' => 1,
            'created_at' => Carbon::now(),
        ]);

        $password = md5(hash('sha512', 'admin').hash('ripemd160', 'admin').md5("strongest"));
        DB::table('users')->insert([
            'name' => 'Admin John Doe',
            'address' => 'Dagupan City, Pangasinan',
            'email' => 'johndoe@gmail.com',
            'mobile' => '09123456789',
            'image' => 'uploads/earthhub.png',
            'username' => 'admin',
            'password' => $password,
            'role' => 'admin',
            'approved' => 1,
            'created_at' => Carbon::now(),
        ]);

        $password = md5(hash('sha512', 'admin').hash('ripemd160', 'admin').md5("strongest"));
        DB::table('users')->insert([
            'name' => 'User Pedro',
            'address' => 'Urdaneta City, Pangasinan',
            'email' => 'pedro@gmail.com',
            'mobile' => '09082220000',
            'image' => 'uploads/earthhub.png',
            'username' => 'user',
            'password' => $password,
            'role' => 'user',
            'approved' => 1,
            'created_at' => Carbon::now(),
        ]);
    }
}
