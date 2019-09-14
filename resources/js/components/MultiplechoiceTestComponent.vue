<template>
	<div class="hydrocard" :class="flipClass" @click="flipCard">
		<div class="front face d-flex flex-column align-items-center justify-content-center rounded shadow"> 
            <i class="material-icons md-inactive md-3 abosolute-top-right">
                {{ card.cardtype.materialicon }}
            </i>
			<span>{{ card.front }} </span>
            <b-list-group>
                <b-list-group-item button v-for="choice in card.choices" :key="choice.id" @click="setGuess(choice)"> {{ choice.body }} </b-list-group-item>
            </b-list-group>
		</div>
		<div class="back face d-flex align-items-center justify-content-center rounded shadow"> 
            <b-list-group>
                <b-list-group-item button v-for="choice in card.choices" :key="choice.id" :active="choice.correct"> {{ choice.body }} </b-list-group-item>
            </b-list-group>
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
        	}
        }
    }
</script>