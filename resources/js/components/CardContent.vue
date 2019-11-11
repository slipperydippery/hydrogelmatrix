<template>
    <div class="hydrocard relative w-xs16 h-xs9 sm:w-sm16 sm:h-sm9 md:w-md16 md:h-md9 lg:w-md16 lg:h-md9 xl:w-xl16 xl:h-xl9" :class="flipClass" @click="flipCard">
        <div class="h-full front face flex flex-col rounded-xl overflow-hidden shadow-xl items-center justify-center text-teal-700">
            <i class="material-icons md-inactive text-gray-400 text-xl sm:text-2xl md:text-4xl xl:text-5xl abosolute-top-right">
                {{ card.cardtype.materialicon }}
            </i>
            <hydrocard-text-formatter
                v-model="card.front"
            >
            </hydrocard-text-formatter>
            <div class="min-w-1/2 mt-8" v-if="card.cardtype.slug == 'multiplechoice'">
                <div v-for="choice in card.choices" :key="choice.id"
                     class="bg-gray-200 hover:bg-teal-600 font-semibold text-black hover:text-white py-2 px-4 border rounded"
                     @click="setGuess(choice)"

                >
                    {{ choice.body }}
                </div>
            </div>
            <div class="abosolute-bottom-right bg-calmly-light shadow-xl shadow-inner h-4 w-4 md:h-6 md:w-6 rounded-full">
            </div>
        </div>
        <div class="h-full back face flex flex-col rounded-xl overflow-hidden shadow-xl items-center justify-center text-teal-700" v-if="hasBack">
            <hydrocard-text-formatter
                v-model="card.back"
            >
            </hydrocard-text-formatter>
            <div class="min-w-1/2 mt-8" v-if="card.cardtype.slug == 'multiplechoice'">
                <div v-for="choice in card.choices" :key="choice.id" @click="setGuess(choice)"
                     class="bg-gray-200 hover:bg-teal-600 font-semibold hover:text-white py-2 px-4 border border-gray-100 rounded"
                     :class="evalutatedChoiceClass(choice)"
                >
                    {{ choice.body }}
                </div>
            </div>
            <div class="abosolute-bottom-left bg-calmly-light shadow-xl shadow-inner h-4 w-4 md:h-6 md:w-6 rounded-full">
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
                    'text-white bg-teal-600': choice.correct && (! this.evalutateChoice(choice)),
                    'text-white bg-green-700': choice.correct && this.evalutateChoice(choice),
                    'text-white bg-red-700': (! choice.correct) && this.evalutateChoice(choice),
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
