<?php

use App\Models\Admin;
use App\Models\Agreement;
use App\Models\Company;
use App\Models\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

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

        // Company Test Account
        $admin = Company::create([
            'name' => 'Company Account',
            'email' => 'company@company.com',
            'password' => bcrypt('company')
        ]);

        // Languages
        Language::create([
            'name' => 'English',
            'code' => 'us',
            'locale' => 'en',
            'direction' => 'ltr'
        ]);
        Language::create([
            'name' => 'Arabic',
            'code' => 'ae',
            'locale' => 'ar',
            'direction' => 'rtl'
        ]);
        Language::create([
            'name' => 'French',
            'code' => 'fr',
            'locale' => 'fr',
            'direction' => 'ltr'
        ]);

        // First Agreement
        $agreement1 = new Agreement();
        $agreement1->translateOrNew('ar')->title = 'راتب شهري ثابت';
        $agreement1->translateOrNew('en')->title = 'A fixed monthly salary';
        $agreement1->translateOrNew('fr')->title = 'Une allocation mensuelle fixe';
        $agreement1->save();

        // Second Agreement
        $agreement2 = new Agreement();
        $agreement2->translateOrNew('ar')->title = 'راتب مع مكافأه علي نسبة انجاز';
        $agreement2->translateOrNew('en')->title = 'A salary with a bonus on the percentage of completion';
        $agreement2->translateOrNew('fr')->title = 'Un salaire avec une prime sur le pourcentage d\'avancement';
        $agreement2->save();

        // Third Agreement
        $agreement3 = new Agreement();
        $agreement3->translateOrNew('ar')->title = 'مكافأه علي نسبة انجاز';
        $agreement3->translateOrNew('en')->title = 'Reward for achievement';
        $agreement3->translateOrNew('fr')->title = 'Récompense pour réussite';
        $agreement3->save();

    }
}
