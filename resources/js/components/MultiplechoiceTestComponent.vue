<template>
    <div class="hydrocard relative bg-gray-850 text-orange-100 rounded shadow w-xs16 h-xs9 sm:w-sm16 sm:h-sm9 md:w-md16 md:h-md9 lg:w-md16 lg:h-md9 xl:w-xl16 xl:h-xl9" :class="flipClass" @click="flipCard">
        <div class="h-full front face flex flex-col items-center justify-center">
            <i class="material-icons md-inactive md-3 abosolute-top-right">
                {{ card.cardtype.materialicon }}
            </i>
            <hydrocard-text-formatter
                v-model="card.front"
            >
            </hydrocard-text-formatter>
            <div class="min-w-1/2 mt-8">
                <div v-for="choice in card.choices" :key="choice.id" @click="setGuess(choice)"
                     class="bg-transparent hover:bg-blue-300 font-semibold hover:text-white py-2 px-4 border rounded"

                >
                    {{ choice.body }}
                </div>
            </div>

		</div>
        <div class="h-full back face flex items-center justify-center">
            <div class="min-w-1/2 mt-8">
                <div v-for="choice in card.choices" :key="choice.id" @click="setGuess(choice)"
                     class="bg-transparent hover:bg-blue-300 font-semibold hover:text-white py-2 px-4 border border-gray-100 rounded"
                     :class="{'bg-blue-300' : choice.correct}"
                >
                    {{ choice.body }}
                </div>
            </div>
		</div>
	</div>
</template>

<script>
    export default {
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

            setGuess(choice) {
                // for later to check if you clicked on the right one
                // need to set: variant="danger"
                // for incorrect list-items
            }
        },

        methods: {
        	flipCard() {
        		this.flipped = ! this.flipped;
        		this.flipClass = this.flipped ? 'flip-vertical-right' : 'flip-vertical-left';
        	},
        }
    }
</script>
