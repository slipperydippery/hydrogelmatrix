<template>
    <div class="row no-gutters">
		<div class="col-4" v-for="card in deck.cards" :key="card.id">
		    <a href="#">
		        <img :src="'https://dummyimage.com/600x400/c2c2c2/f2f2f2&text=' + card.front " alt="" class="img-fluid">
		    </a>
		</div>
	</div>
</template>

<script>

    export default {
        props: [
        	'deck'
        ],

        data() {
            return {
            }
        },

        mounted() {
        	this.$eventBus.$on('addedCard', this.addCard);
        },

        computed: {
        },

        methods: {
        	addCard(card) {
        		this.deck.cards.push(card);
        		this.$forceUpdate();
        	}
        }
    }
</script>