<template>
	<div 
		class="newdeckbutton--fixed active"
		@mouseover="active = true"
	    @mouseleave="active = false"
	>
        <i class="material-icons md-3 clickable" v-if="! active">
            add_circle_outline
        </i>
		<b-list-group v-if="active">
			<b-list-group-item class="px-5 noselect"><b>New card</b></b-list-group-item>
			<b-list-group-item 
				href="#" 
				class="px-5"
				v-for="cardtype in cardtypes" 
				@click="setAndShowCardmodal(cardtype)"
			> 
				{{ cardtype.name }} 
			</b-list-group-item>
		</b-list-group>
		<new-card-modal
	        :deckid="deckid"
	        :activecardtype="activecardtype"
		>
		</new-card-modal>
    </div>
</template>

<script>
    export default {
        props: [
        	'cardtypes',
        	'deckid'
        ],

        data() {
            return {
            	active: false,
            	activecardtype: ''
            }
        },

        mounted() {
        	this.activecardtype = this.cardtypes[0]
        },

        computed: {
        },

        methods: {
        	setAndShowCardmodal(cardtype) {
        		this.activecardtype = cardtype;
        		this.$bvModal.show('newcardmodal');
        	}
        }
    }
</script>