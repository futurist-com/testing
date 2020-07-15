<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\Test;
use App\Model\Question;
use App\Model\Answer_variant;
use App\Model\Category;
use App\Model\ResultTest;

class CreateTestsOfTestdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tests=DB::connection("mysql_testd")->select("select * from modx_testd_tests");
        foreach ($tests as $test_testd){
            $test=Test::where('name', '=' , $test_testd->name)->first();
            //если нету записываем
            //$category=$this->getIdCategory(10001);
            
            if ($test==null){
                $test=new Test();
                $test->name=$test_testd->name;
                $test->description=$test_testd->text;
                $test->time_limit=$test_testd->number_seconds;
                $test->catecory=$this->getIdCategory($test_testd->resource);
                $test->save();
                //
                $testResult=new ResultTest();
                $testResult->id=$test->id;
                $testResult->min_count=$test_testd->number_correct;
                $testResult->save();
                //сохраним вопросы отдельной  функцией
                $this->saveGuestion($test_testd->id);
            }

            dd($test_testd);

        }
    }
    public function getIdCategory($idResourse){
        
        $resource=DB::connection('mysql_testd')->
        table('modx_site_content')->
        where('id', '=', $idResourse)->
        first();
        //dd($resource);
        if ($resource->parent!=9 and $resource->parent!=0){
            $parent=$this->getIdCategory($resource->parent);
        } else{
            $parent=0;
        }
        $category=Category::where('name', '=', $resource->pagetitle)->first();
            if ($category==null){
                $category= new Category();
                $category->name=$resource->pagetitle;
                $category->description=$resource->content;
                $category->parent_id=$parent;
                $category->save();
                return $category->id;
            }
        return $category->id;    

    }
    public function saveQuestion($testId){
        $questionsTestd=DB::connection("mysql_testd")->select("select * from modx_testd_questions where test=$testId");
        foreach($questionsTestd as $questionTestd){
            $question=  new Question();
            $question->test_id=$questionTestd->test_id;
            $question->text=$questionTestd->text;
            $question->ball=$questionTestd->scores;
            $question->video_link=$questionTestd->youtobe;

        }        
    }
}
