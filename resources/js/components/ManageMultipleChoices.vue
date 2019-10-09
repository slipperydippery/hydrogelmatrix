<template>
	<div class="mt-4">
        <div v-for="choice in value" :key="choice.id" @click="setCorrectChoice(choice)"
            class="bg-transparent hover:bg-blue-300 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
            :class="{ 'bg-blue-500 text-white' : isCorrect(choice), 'text-blue-700' : ! isCorrect(choice)}"
        >
            {{ choice.body }}
            <button type="button" class="close float-right" aria-label="Close" @click="removeChoice(choice)">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
	    <input type="text" class="form-input mt-1 block w-full" placeholder="A possible answer is..." v-model="newChoice" @keydown.enter="saveChoice()">
	</div>
</template>

<script>
    export default {
        props: [
        	'value'
        ],

        data() {
            return {
                newChoice: '',
            }
        },

        mounted() {
        },

        computed: {
        },

        methods: {
        	saveChoice() {
        		var choices = this.value;
        		choices.push({
        	        body: this.newChoice,
        	        correct: false
        		});
        		this.newChoice = '';
        	    this.$emit('input', choices);
        	},

        	removeChoice(choice) {
                var newValue = this.value.slice()
                newValue.splice(newValue.indexOf(choice), 1)
        	    this.$emit('input', newValue);
        	},

        	setCorrectChoice(choice) {
        		var choices = this.value;
        	    choices.forEach( thischoice => {
        	    	thischoice.correct = false;
        	    	if (thischoice == choice || ('id'in choice) && thischoice.id == choice.id) {
        	    		thischoice.correct = true;
        	    	}
        	    });
                this.$forceUpdate()
        	    this.$emit('input', choices);
        	},

            isCorrect(choice){
                return (choice.correct == 0 || choice.correct == false) ? false : true
            },
        }
    }
</script>
