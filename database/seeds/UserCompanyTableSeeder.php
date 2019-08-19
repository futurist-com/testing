<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();
        $company = App\Model\Company::all();

        $limit = 1000;

        foreach ($users as $user) {
            $cLimit = rand(1, 4);
            for ($userCompany = 1; $userCompany <= $cLimit; $userCompany++) {
                $companyRand = $company->random();
                \DB::table('user_companies')->insert([
                    'user_id' => $user->id,
                    'company_id' => $companyRand->id,
                    'role' => rand(1, 2),
                ]);
            }
        }
    }
}
