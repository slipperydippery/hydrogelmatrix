<template>
    <b-modal 
    	id="flippablemodal" 
    	title="Create new Card"
        size="lg"
    	@ok="storeCard"
	>
        <div class="form-group">
            <label for="exampleInputEmail1">Side A</label>
            <textarea class="form-control" id="titleInput"  placeholder="This is the native term" v-model="card.sidea"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Side B</label>
            <textarea class="form-control" id="titleInput"  placeholder="The foreign term is" v-model="card.sideb"></textarea>
        </div>
	</b-modal>
</template>

<script>

    export default {
        props: [
        	'deckid',
        ],

        data() {
            return {
            	card: {
            		cardtype: 'flippable',
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
        	storeCard() {
	        	var home = this;
        		axios.post('/api/card', {
        			card: home.card,
        		})
        		.then( response => {
        			console.log(response.data);
        		});
        	}
        }
    }
</script>