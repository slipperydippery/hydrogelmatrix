<?php

use App\CardType;
use Illuminate\Database\Seeder;

class CardTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('card_types')->delete();

        $qa = new CardType([
            'name' 			=> 'Question and Answer',
            'slug' 			=> 'qa',
            'description' 	=> 'A card with a question on the front and the answer on the back. Can be reversed in Jeopardy mode',
        ]);
        $qa->save();

        $flippable = new CardType([
            'name' 			=> 'Flippable',
            'slug' 			=> 'flippable',
            'description' 	=> 'A card that can be tested both ways. Language cards can work like this. Can be tested in strict or priority mode, where preference is given to the front as question.',
        ]);
        $flippable->save();

        $multiplechoice = new CardType([
            'name' 			=> 'Multiple choice',
            'slug' 			=> 'multiplechoice',
            'description' 	=> 'A question with multiple answer options, of which one is the final answer.',
        ]);
        $multiplechoice->save();

        $dothis = new CardType([
            'name' 			=> 'Do it!',
            'slug' 			=> 'doit',
            'description' 	=> 'A card with a simple task - does not have an answer or backside.',
        ]);
        $dothis->save();
    }
}
