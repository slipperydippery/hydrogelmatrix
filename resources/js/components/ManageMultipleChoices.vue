<template>
	<div class="form-group">
	    <b-list-group>
	        <b-list-group-item v-for="choice in value" @click="setActiveChoice(choice)" :active="choice.active">
	            {{ choice.choice }}
	            <button type="button" class="close float-right" aria-label="Close" @click="removeChoice(choice)">
	              <span aria-hidden="true">&times;</span>
	            </button>
	        </b-list-group-item>
	    </b-list-group>
	    <input type="text" class="form-control" placeholder="A possible answer is..." v-model="newChoice" @keydown.enter="saveChoice()">
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
        	        choice: this.newChoice,
        	        active: false
        		});
        		this.newChoice = '';
        	    this.$emit('input', choices);
        	},

        	removeChoice(choice) {
        	    this.$emit('input', this.value.splice(this.value.indexOf(choice), 1));
        	},

        	setActiveChoice(choice) {
        		var choices = this.value;
        	    choices.forEach( thischoice => {
        	    	thischoice.active = false;
        	    	if (thischoice == choice) {
        	    		thischoice.active = true;
        	    	}
        	    });
        	    this.$emit('input', choices);
        	}
        }
    }
</script>