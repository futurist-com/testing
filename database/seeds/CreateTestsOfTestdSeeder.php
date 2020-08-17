<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Model\Test;
use App\Model\Question;
use App\Model\Answer_variant;
use App\Model\Category;
use App\Model\ResultTest;
use Illuminate\Support\Facades\Storage;

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
                $test->category_id=$this->getIdCategory($test_testd->resource);
                $test->save();
                //dd($test);
                //
                $testResult=new ResultTest();
                $testResult->test_id=$test->id;
                $testResult->min_count=$test_testd->number_correct;
                $testResult->save();
                //сохраним вопросы отдельной  функцией
                $this->saveQuestion($testResult->id, $test_testd->id);
            
            }
            else{
                //
            }
            //dd($test_testd);

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
    public function saveQuestion($testId, $testIdTestd){
        $questionsTestd=DB::connection("mysql_testd")->
        select("select * from modx_testd_tests_questions where test_id=$testIdTestd");
        //$path="/media/futurist/Новый том/sert_testd_ru/testd.ru/asset$/img";
        foreach($questionsTestd as $questionTestd){
            $question=  new Question();
            $question->test_id=$testId;
            $question->text=$questionTestd->text;
            $question->ball=$questionTestd->scores;
            $question->video_link=$questionTestd->youtube;
            $question->image=$questionTestd->file;
            $question->pn=$questionTestd->question_id;

            $question->save();
            //dd($questionTestd);
            $this->saveVariants($question->id, $questionTestd->question_id, $questionTestd->test_id);
            //поиск фаила путь коирования фаилов /media/futurist/Новый том/sert_testd_ru/testd.ru/asset$ img
        }

    }
    public function setImage($link){
        $path="/media/futurist/Новый том/sert_testd_ru/testd.ru/asset$/img/";
        //$image=Storage::get($path.$link);
        Storage::copy($path.$link, '/test_images/'.$link);
    }
    public function saveVariants($questionId, $questionIdtestd, $testId){
        $variantsTestd=DB::connection("mysql_testd")->
        select("select * from modx_testd_tests_questions_variants
                                    where test_id=$testId and question_id=$questionIdtestd");
        $pn=0;
        foreach ($variantsTestd as $variantTestd)
        {
            $answer= new Answer_variant();
            $answer->question_id=$questionId;
            $answer->text=$variantTestd->value;
            $answer->valid=$variantTestd->is_right;
            $answer->image=$variantTestd->file;
            //$answer->ball=$variantTestd->file;
            $answer->pn=$variantTestd->variant_id;
            $pn++;
        }                            
    } 
}
