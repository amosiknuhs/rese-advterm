<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $param = [
      'shop_id' => 1,
      'name' => '仙人オーナー',
      'email' => 'sennin@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 2,
      'name' => '牛助オーナー',
      'email' => 'gyusuke@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 3,
      'name' => '戦慄オーナー',
      'email' => 'senritsu@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 4,
      'name' => 'ルークオーナー',
      'email' => 'ruku@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 5,
      'name' => '志摩屋オーナー',
      'email' => 'shimaya@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 6,
      'name' => '香オーナー',
      'email' => 'kaoru@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 7,
      'name' => 'JJオーナー',
      'email' => 'jj@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 8,
      'name' => 'らーめん極みオーナー',
      'email' => 'kiwami@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 9,
      'name' => '鳥雨オーナー',
      'email' => 'chouu@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 10,
      'name' => '築地色合オーナー',
      'email' => 'tsukiji@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 11,
      'name' => '晴海オーナー',
      'email' => 'harumi@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 12,
      'name' => '三子オーナー',
      'email' => 'sanshi@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 13,
      'name' => '八戒オーナー',
      'email' => 'hakkai@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 14,
      'name' => '福助オーナー',
      'email' => 'fukusuke@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 15,
      'name' => 'ラー北オーナー',
      'email' => 'rapei@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 16,
      'name' => '翔オーナー',
      'email' => 'sho@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 17,
      'name' => '経緯オーナー',
      'email' => 'keii@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 18,
      'name' => '漆オーナー',
      'email' => 'urushi@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 19,
      'name' => 'THE TOOLオーナー',
      'email' => 'thetool@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
    $param = [
      'shop_id' => 20,
      'name' => '木船オーナー',
      'email' => 'mokusen@owner.com',
      'password' => Hash::make('password'),
    ];
    DB::table('owners')->insert($param);
  }
}
