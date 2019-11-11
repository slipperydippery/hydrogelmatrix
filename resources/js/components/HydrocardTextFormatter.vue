<template>
	<span class="select-none" :style="{ fontSize: fontSize(value) + 'vw' }" v-if="value">
		<vue-markdown :source="value" v-if="value"></vue-markdown>
	</span>
</template>

<script>
    import VueMarkdown from 'vue-markdown';
    export default {
        props: [
        	'value'
        ],

        data() {
            return {
            }
        },

        components: {
	        VueMarkdown
        },

        mounted() {
        },

        computed: {
        },

        methods: {
            fontSize(string) {
                return ((Math.round((15 / Math.pow(string.length, 0.4)) * 10))/ 10) * .6 ;
            },
        }
    }
</script>
