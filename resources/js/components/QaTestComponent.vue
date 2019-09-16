<template>
	<div class="hydrocard" :class="flipClass" @click="flipCard">
		<div class="front face d-flex align-items-center justify-content-center rounded shadow"> 
			<i class="material-icons md-inactive md-3 abosolute-top-right">
				{{ card.cardtype.materialicon }}
			</i>
			<span :style="{ fontSize: fontSize(card.front) + 'vw' }">{{ card.front }} </span>
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
        	},

            fontSize(string) {
                return ((Math.round((30 / Math.sqrt(string.length)) * 10))/ 10) ;
            },
        }
    }
</script>