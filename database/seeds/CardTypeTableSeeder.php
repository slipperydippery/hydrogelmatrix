<?php

use App\Cardtype;
use Illuminate\Database\Seeder;

class CardtypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cardtypes')->delete();

        $qa = new Cardtype([
            'name' 				=> 'Vraag en antwoord',
            'slug' 				=> 'qa',
            'description' 		=> 'Een kaart met een duidelijke vraag op de voorkant en een antwoord op de achterkant. Kan worden omgedraaid in Jeopardy mode.',
            'materialicon'		=> 'question_answer',
            'fronttext'			=> 'Vraag',
            'frontplaceholder'	=> 'Wat is de vraag..?',
            'backtext'			=> 'Antwoord',
            'backplaceholder'	=> 'Dit is het antwoord!',
        ]);
        $qa->save();

        $flippable = new Cardtype([
            'name' 				=> 'Flippable',
            'slug' 				=> 'flippable',
            'description' 		=> 'Een kaart die beide richtingen op getest kan worden. Taal-kaarten werken bijvoorbeeld op deze manier. Kunnen ook in strikte modus getest worden, waarbij de moedertaal of juist vreemde taal wordt gevraagd.',
            'materialicon'		=> 'swap_calls',
            'fronttext'			=> 'A zijde',
            'frontplaceholder'	=> 'De natuurlijke term',
            'backtext'			=> 'B zijde',
            'backplaceholder'	=> 'De vreemde term',
        ]);
        $flippable->save();

        $multiplechoice = new Cardtype([
            'name' 				=> 'Meerkeuzevraag',
            'slug' 				=> 'multiplechoice',
            'description' 		=> 'Een vraag met meerdere antwoord mogelijkheden, waarvan een de correcte is.',
            'materialicon'		=> 'format_list_bulleted',
            'fronttext'			=> 'Vraag',
            'frontplaceholder'	=> 'Wat is de vraag..?',
            'backtext'			=> 'Keuze',
            'backplaceholder'	=> 'Een mogelijk antwoord is...',
        ]);
        $multiplechoice->save();

        $dothis = new Cardtype([
            'name' 				=> 'Do het!',
            'slug' 				=> 'doit',
            'description' 		=> 'Een kaart met een eenvoudige taak - heeft geen antwoord of achterkant',
            'materialicon'		=> 'double_arrow',
            'fronttext'			=> 'Doe het!',
            'frontplaceholder'	=> 'De taak is om te...',
            'backtext'			=> '',
            'backplaceholder'	=> '',
        ]);
        $dothis->save();
    }
}
