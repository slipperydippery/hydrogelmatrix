<template>
	<div class="newdeckbutton--fixed">
        <i class="material-icons md-3 clickable" v-b-modal.modal-1>
            add_circle_outline
        </i>
        <b-modal 
        	id="modal-1" 
        	title="Create new Deck"
        	@ok="storeDeck"
    	>
		    <div class="form-group">
		        <label for="exampleInputEmail1">Title</label>
		        <input type="text" class="form-control" id="titleInput"  placeholder="Enter title" v-model="deck.title">
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
            	}
            }
        },

        mounted() {
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
        			console.log(response.data);
        		});
        	}
        }
    }
</script>