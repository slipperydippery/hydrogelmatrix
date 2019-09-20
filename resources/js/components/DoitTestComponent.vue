<template>
	<div class="hydrocard" :class="flipClass">
		<div class="front face d-flex align-items-center justify-content-center rounded shadow"> 
            <i class="material-icons md-inactive md-3 abosolute-top-right">
                {{ card.cardtype.materialicon }}
            </i>
            <hydrocard-text-formatter
                v-model="card.front"
            >
            </hydrocard-text-formatter>
		</div>
		<div class="back face d-flex align-items-center justify-content-center rounded shadow"> 
            <hydrocard-text-formatter
                v-model="card.back"
            >
            </hydrocard-text-formatter>
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