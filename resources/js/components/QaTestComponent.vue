<template>
	<div class="hydrocard" :class="flipClass" @click="flipCard">
		<div class="front face d-flex align-items-center justify-content-center rounded shadow"> 
			<i class="material-icons md-inactive md-3 abosolute-top-right">
				{{ card.cardtype.materialicon }}
			</i>
			{{ card.front }} 
		</div>
		<div class="back face d-flex align-items-center justify-content-center rounded shadow"> 
			{{ card.back }} 
		</div>
	</div>
</template>

<script>
    export default {
        props: [
	        'card'
        ],

        data() {
            return {
            	flipped: false,
            	flipClass: ''
            }
        },

        mounted() {
        },

        computed: {
        },

        methods: {
        	flipCard() {
        		this.flipped = ! this.flipped;
        		this.flipClass = this.flipped ? 'flip-vertical-right' : 'flip-vertical-left';
        	}
        }
    }
</script>