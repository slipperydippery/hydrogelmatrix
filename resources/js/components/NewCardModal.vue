<template>
	<div class="newdeckbutton--fixed">
        <i class="material-icons md-3 clickable" v-b-modal.modal-1>
            add_circle_outline
        </i>
        <b-modal 
        	id="modal-1" 
        	title="Create new Card"
            size="lg"
        	@ok="storeDeck"
    	>
            <div class="form-group">
                <label for="exampleInputEmail1">Side A</label>
                <textarea class="form-control" id="titleInput"  placeholder="Text side A" v-model="card.sidea"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Side A</label>
                <textarea class="form-control" id="titleInput"  placeholder="Text side B" v-model="card.sideb"></textarea>
            </div>
		</b-modal>
	</div>

</template>

<script>
    export default {
        props: [
            'deckid'
        ],

        data() {
            return {
            	card: {
            		sidea: '',
                    sideb: '',
            	}
            }
        },

        mounted() {
            this.card.deckid = this.deckid;
        },

        computed: {
        },

        methods: {
        	storeDeck() {
	        	var home = this;
        		axios.post('/api/card', {
        			card: home.card
        		})
        		.then( response => {
        			console.log(response.data);
        		});
        	}
        }
    }
</script>