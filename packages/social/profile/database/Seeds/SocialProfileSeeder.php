<?php
/**
 * Created by PhpStorm.
 * User: kousha
 * Date: 8/11/18
 * Time: 6:50 PM
 */


namespace social\profile\Database\Seeds;

use Illuminate\Database\Seeder;


class SocialProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SocialBaseSettingSeeder::class);
        $this->call(SocialSettingSeeder::class);
    }
}
