<template>
    <b-modal 
    	id="doitmodal" 
    	title="Create new Card"
        size="lg"
    	@ok="storeCard"
	>
        <div class="form-group">
            <label for="exampleInputEmail1">Do it!</label>
            <textarea class="form-control" id="titleInput"  placeholder="The task is to.." v-model="card.sidea"></textarea>
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
            		cardtype: 'doit',
            		sidea: '',
            		sideb: 'nothing',
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