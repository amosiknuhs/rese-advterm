<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ReservesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $param = [
      'user_id' => 1,
      'shop_id' => 1,
      'date' => '2022-01-01',
      'time' => '11:00:00',
      'number' => 1,
    ];
    DB::table('reserves')->insert($param);
    $param = [
      'user_id' => 1,
      'shop_id' => 4,
      'date' => '2022-02-01',
      'time' => '12:30:00',
      'number' => 2,
    ];
    DB::table('reserves')->insert($param);
    $param = [
      'user_id' => 1,
      'shop_id' => 8,
      'date' => '2022-03-01',
      'time' => '15:00:00',
      'number' => 4,
    ];
    DB::table('reserves')->insert($param);
    $param = [
      'user_id' => 1,
      'shop_id' => 12,
      'date' => '2022-04-01',
      'time' => '17:00:00',
      'number' => 6,
    ];
    DB::table('reserves')->insert($param);
    $param = [
      'user_id' => 1,
      'shop_id' => 16,
      'date' => '2022-05-01',
      'time' => '20:00:00',
      'number' => 8,
    ];
    DB::table('reserves')->insert($param);
    $param = [
      'user_id' => 1,
      'shop_id' => 20,
      'date' => '2022-06-01',
      'time' => '22:30:00',
      'number' => 10,
    ];
    DB::table('reserves')->insert($param);
  }
}
