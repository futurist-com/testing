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
                $comp->departaments()->saveMany(factory(App\Model\Departament::class, 4)
                    ->create(array('company_id' => $comp->id))
                    ->each(function ($dep) {
                        $dep->posts()->saveMany(factory(App\Model\Post::class, 4))
                            ->create(array('departament_id' => $dep->id))
                            ->each(
                                function ($post) {
                                    $post->workers()->saveMany(factory(App\Model\Worker::class, 4)->make());
                                }
                            );
                    }));
            }
        );
    }
}
