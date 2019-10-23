<template>
    <div class="hydrocard relative bg-gray-850 text-orange-100 rounded shadow-xl w-xs16 h-xs9 sm:w-sm16 sm:h-sm9 md:w-md16 md:h-md9 lg:w-md16 lg:h-md9 xl:w-xl16 xl:h-xl9" :class="flipClass" @click="flipCard">
        <div class="h-full front face flex flex-col items-center justify-center">
            <i class="material-icons md-inactive md-3 abosolute-top-right">
                {{ card.cardtype.materialicon }}
            </i>
            <hydrocard-text-formatter
                v-model="card.front"
            >
            </hydrocard-text-formatter>
            <div class="min-w-1/2 mt-8" v-if="card.cardtype.slug == 'multiplechoice'">
                <div v-for="choice in card.choices" :key="choice.id"
                     class="bg-gray-200 hover:bg-blue-300 font-semibold text-black hover:text-white py-2 px-4 border rounded"
                     @click="setGuess(choice)"

                >
                    {{ choice.body }}
                </div>
            </div>

        </div>
        <div class="h-full back face flex flex-col items-center justify-center" v-if="hasBack">
            <hydrocard-text-formatter
                v-model="card.back"
            >
            </hydrocard-text-formatter>
            <div class="min-w-1/2 mt-8" v-if="card.cardtype.slug == 'multiplechoice'">
                <div v-for="choice in card.choices" :key="choice.id" @click="setGuess(choice)"
                     class="bg-gray-200 hover:bg-blue-300 font-semibold hover:text-white py-2 px-4 border border-gray-100 rounded"
                     :class="evalutatedChoiceClass(choice)"
                >
                    {{ choice.body }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CardContent",
        props: [
            'card'
        ],

        data() {
            return {
                flipped: false,
                flipClass: '',
                myGuess: {},
            }
        },

        mounted() {
        },

        computed: {
            correctChoice() {
                var correctChoice = 'sorry';
                this.card.choices.forEach( thischoice => {
                    if( thischoice.correct ) {
                        correctChoice = thischoice.body;
                    }
                });
                return correctChoice;
            },

            hasBack() {
                return this.card.cardtype.slug != 'doit'
            },
        },

        methods: {
            flipCard() {
                if(this.card.cardtype.slug != 'doit') {
                    this.flipped = ! this.flipped;
                    this.flipClass = this.flipped ? 'flip-vertical-right' : 'flip-vertical-left';
                }
            },

            evalutatedChoiceClass(choice) {
                return {
                    'text-white bg-blue-300': choice.correct && (! this.evalutateChoice(choice)),
                    'text-white bg-green-300': choice.correct && this.evalutateChoice(choice),
                    'text-white bg-red-600': (! choice.correct) && this.evalutateChoice(choice),
                }
            },

            evalutateChoice(choice) {
                return (choice.id == this.myGuess.id)
            },

            setGuess(choice) {
                this.myGuess = choice
            }
        }
    }
</script>
