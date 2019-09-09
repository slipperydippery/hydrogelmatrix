<template>
	<div class="hydrocard" :class="flipClass">
		<div class="front face d-flex align-items-center justify-content-center rounded shadow"> 
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
        }
    }
</script>