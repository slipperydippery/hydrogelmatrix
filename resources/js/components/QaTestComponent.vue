<template>
	<div class="hydrocard" :class="flipClass" @click="flipCard">
		<div class="front face"> {{ card.front }} </div>
		<div class="back face"> {{ card.back }} </div>
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