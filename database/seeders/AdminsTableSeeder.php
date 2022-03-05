<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $param = [
      'name' => '管理者ユーザー',
      'email' => 'admin@admin.com',
      'password' => Hash::make('password'),
    ];
    DB::table('admins')->insert($param);
  }
}
