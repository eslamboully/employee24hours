<?php

use App\Models\Admin;
use App\Models\Agreement;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
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
        $super_admin = Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        // Writer Admin
        $writer_admin = Admin::create([
            'name' => 'Writer Admin',
            'email' => 'writer@writer.com',
            'password' => bcrypt('writer')
        ]);

        // Company Test Account
        $company = Company::create([
            'name' => 'Company Account',
            'email' => 'company@company.com',
            'password' => bcrypt('company')
        ]);

        // Employee Test Account
        $employee = Employee::create([
            'name' => 'Employee Account',
            'email' => 'employee@employee.com',
            'password' => bcrypt('employee'),
            'languages' => '["Arabic","English"]',
            'work_from' => '1:00 AM',
            'work_to' => '9:00 PM',
            'work_days_in_week' => '4'
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

        // Un category Department for product
        $agreement3 = new Department();
        $agreement3->translateOrNew('ar')->title = 'غير مصنف';
        $agreement3->translateOrNew('en')->title = 'unclassified';
        $agreement3->translateOrNew('fr')->title = 'non classé';
        $agreement3->save();


    }
}
