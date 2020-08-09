<?php

use App\Models\Admin;
use App\Models\Language;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super Admin
        $admin = Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        // Languages
        Language::create([
            'name' => 'English',
            'code' => 'us',
            'locale' => 'en',
            'direction' => 'ltr'
        ]);
        Language::create([
            'name' => 'العربية',
            'code' => 'ae',
            'locale' => 'ar',
            'direction' => 'rtl'
        ]);
        Language::create([
            'name' => 'français',
            'code' => 'fr',
            'locale' => 'fr',
            'direction' => 'ltr'
        ]);

    }
}
