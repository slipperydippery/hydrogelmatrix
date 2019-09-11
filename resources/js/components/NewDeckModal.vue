<template>
	<div 
		class="newdeckbutton--fixed"
		@mouseover="active = true"
	    @mouseleave="active = false"
	>
        <i class="material-icons md-3 clickable"  v-if="! active">
            add_circle_outline
        </i>
        <b-list-group v-if="active">
        	<b-list-group-item 
        		href="#" 
        		class="px-5"
        		v-b-modal.new-deck-modal
        	> 
        		Create new deck
        	</b-list-group-item>
        </b-list-group>
        <b-modal 
        	id="new-deck-modal" 
        	ref="newdeckmodal"
        	title="Create new Deck"
        	@ok="storeDeck"
        	@shown="focusMyElement"
    	>
		    <div class="form-group">
		        <label for="exampleInputEmail1">Deck name</label>
		        <input 
		        	type="text" 
		        	class="form-control" 
		        	id="titleInput"  
		        	placeholder="Give your deck a recognizable name" 
		        	v-model="deck.title" 
		        	ref="titleInput"
		        	@keyup.enter="okAndCloseModal"
	        	>
		      </div>
		</b-modal>
	</div>

</template>

<script>
    export default {
        props: [
        ],

        data() {
            return {
            	deck: {
            		title: ''
            	},
            	active: false,
            }
        },

        mounted() {
        	// this.$nextTick(() => this.$refs.titleInput.focus());	   // should be called on create
        },

        computed: {
        },

        methods: {
        	storeDeck() {
	        	var home = this;
        		axios.post('/api/deck', {
        			deck: home.deck
        		})
        		.then( response => {
        			this.$eventBus.$emit('addedDeck', response.data);
        			home.deck.title = '';
        		});
        	},

        	focusMyElement(e) {
				this.$refs.titleInput.focus()
    	    },

    	    okAndCloseModal() {
    	    	this.$root.$emit('bv::hide::modal', 'new-deck-modal', '#btnShow');
    	    	this.storeDeck();
    	    }
        }
    }
</script>