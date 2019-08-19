<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Model\Company::class, 100)->create()->each(
            function ($comp) {
                $comp->departament()->saveMany(factory(App\Model\Departament, 4)
                    ->create(array('company_id' => $comp->id))
                    ->each(function ($dep) {
                        $dep->post()->saveMany(factory(App\Model\Post, 10))->make();
                    }));
            }
        );
    }
}
