<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $param = [
      'name' => 'テストユーザー',
      'email' => 'test@test.com',
      'password' => Hash::make('password'),
      'email_verified_at' => new DateTime(),
    ];
    DB::table('users')->insert($param);
    $param = [
      'name' => 'ForEvaluations',
      'email' => 'evaluation@evaluation',
      'password' => Hash::make('password'),
      'email_verified_at' => new DateTime(),
    ];
    DB::table('users')->insert($param);
  }
}
