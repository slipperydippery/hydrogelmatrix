<template>
    <div class="">
        <img src="https://dummyimage.com/600x400/f2f2f2/c2c2c2&text=new card" alt="" class="img-fluid clickable" v-b-modal.newcardblockmodal>
        <b-modal 
        	id="newcardblockmodal" 
        	title="Create new Card"
            size="lg"
            centered
        	@ok="storeDeck"
    	>
            <div class="row">
                <div class="col-12">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary" v-for="cardtype in cardtypes">
                            <input type="radio" name="options" id="option1" autocomplete="off"> {{ cardtype.name }}
                        </label>
                    </div>
                </div>
            </div>
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
            'deckid',
            'cardtypes'
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