<?php

use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'page' => 'Home',
            'slug' => 'home',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'page' => 'Ad Collectors',
            'slug' => 'adcollectors',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'page' => 'Members',
            'slug' => 'members',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'page' => 'Advertisements',
            'slug' => 'all-ads',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'page' => 'Atharamedi Services',
            'slug' => 'services',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'page' => 'Atharamedi Ads',
            'slug' => 'atharamedi_ads',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'page' => 'Privacy Policy',
            'slug' => 'privacy_policy',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'page' => 'Terms & Conditions',
            'slug' => 'terms_conditions',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'page' => 'How to sell fast',
            'slug' => 'how_to_sell_fast',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'page' => 'Buy Now on Atharamediya.lk',
            'slug' => 'buy_now',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'page' => 'Banner Advertising',
            'slug' => 'banner_advertising',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('pages')->insert([
            'page' => 'Promote Your Ad',
            'slug' => 'promote_your_ad',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
