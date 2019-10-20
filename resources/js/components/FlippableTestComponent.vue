<template>
    <div class="hydrocard relative bg-gray-850 text-orange-100 rounded shadow w-xs16 h-xs9 sm:w-sm16 sm:h-sm9 md:w-md16 md:h-md9 lg:w-md16 lg:h-md9 xl:w-xl16 xl:h-xl9" :class="flipClass" @click="flipCard">
        <div class="h-full front face flex items-center justify-center">
            <i class="material-icons md-inactive md-3 abosolute-top-right">
                {{ card.cardtype.materialicon }}
            </i>
            <hydrocard-text-formatter
                v-model="card.front"
            >
            </hydrocard-text-formatter>
		</div>
        <div class="h-full back face flex items-center justify-center">
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
        	flipCard() {
        		this.flipped = ! this.flipped;
        		this.flipClass = this.flipped ? 'flip-vertical-right' : 'flip-vertical-left';
        	},
        }
    }
</script>
