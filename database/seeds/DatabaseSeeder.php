<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Scale;
use App\OptionAnswer;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('scales')->delete();

        $scales = [
            ['id' => 1, 'description' => 'Very poor - Neutral - Good - Very Good - Excelent'],
            ['id' => 2, 'description' => 'Poor - Fair - Good - Very Good'],
            ['id' => 3, 'description' => 'Very Poor - Poor - Fair - Good - Very good '],
            ['id' => 4, 'description' => 'Very bad - Bad - Neutral - Good - Very good - Extremely good'],
            ['id' => 5, 'description' => 'Extremely bad - Very bad - Bad - Somewhat good - Good - Very good - Extremely good'],
           
        ];

        foreach($scales as $scale){
    		Scale::create($scale);
		}
        
        DB::table('option_answers')->delete();
        
        $option1 = [
            ['answer' => 'Very poor', 'neutral' => false , 'good' => false ,'scale_id' => 1],
            ['answer' => 'Neutral', 'neutral' => true , 'good' => false,'scale_id' => 1],
            ['answer' => 'Good', 'neutral' => false , 'good' => true,'scale_id' => 1],
            ['answer' => 'Very Good', 'neutral' => false , 'good' => false,'scale_id' => 1],
            ['answer' => 'Excelent', 'neutral' => false , 'good' => false,'scale_id' => 1],
        ];

        foreach($option1 as $option){
            OptionAnswer::create($option);
        }

        $option2 = [
            ['answer' => 'poor', 'neutral' => false , 'good' => false ,'scale_id' => 2],
            ['answer' => 'Fair', 'neutral' => true , 'good' => false,'scale_id' => 2],
            ['answer' => 'Good', 'neutral' => false , 'good' => true,'scale_id' => 2],
            ['answer' => 'Very Good', 'neutral' => false , 'good' => false,'scale_id' => 2],
        ];

        foreach($option2 as $option){
            OptionAnswer::create($option);
        }

        $option3 = [
            ['answer' => 'Very poor', 'neutral' => false , 'good' => false ,'scale_id' => 3],
            ['answer' => 'Poor', 'neutral' => false , 'good' => false,'scale_id' => 3],
            ['answer' => 'Fair', 'neutral' => true , 'good' => false,'scale_id' => 3],
            ['answer' => 'Good', 'neutral' => false , 'good' => true,'scale_id' => 3],
            ['answer' => 'Very Good', 'neutral' => false , 'good' => false,'scale_id' => 3],
        ];

        foreach($option3 as $option){
            OptionAnswer::create($option);
        }

        $option4 = [
            ['answer' => 'Very bad', 'neutral' => false , 'good' => false,'scale_id' => 4],
            ['answer' => 'Bad', 'neutral' => false , 'good' => false,'scale_id' => 4],
            ['answer' => 'Neutral', 'neutral' => true , 'good' => false,'scale_id' => 4],
            ['answer' => 'Good', 'neutral' => false , 'good' => true,'scale_id' => 4],
            ['answer' => 'Very Good', 'neutral' => false , 'good' => false,'scale_id' => 4],
            ['answer' => 'Extremely good', 'neutral' => false , 'good' => false ,'scale_id' => 4],
        ];
        foreach($option4 as $option){
            OptionAnswer::create($option);
        }

        $option5 = [
            ['answer' => 'Extremely good', 'neutral' => false , 'good' => false ,'scale_id' => 5],
            ['answer' => 'Very bad', 'neutral' => false , 'good' => false,'scale_id' => 5],
            ['answer' => 'Bad', 'neutral' => false , 'good' => false,'scale_id' => 5],
            ['answer' => 'Somewhat good', 'neutral' => true , 'good' => false,'scale_id' => 5],
            ['answer' => 'Good', 'neutral' => false , 'good' => true,'scale_id' => 5],
            ['answer' => 'Very Good', 'neutral' => false , 'good' => false,'scale_id' => 5],
            ['answer' => 'Extremely good', 'neutral' => false , 'good' => false ,'scale_id' => 5],
        ];
        foreach($option5 as $option){
            OptionAnswer::create($option);
        }
        

    }
}
