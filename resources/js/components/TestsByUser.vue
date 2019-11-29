<script
>
    export default {
        name: "TestsByUser",

        props: [
            'tests'
        ],

        data() {
            return {
                testsToShow: null
            }
        },

        mounted() {
            this.$eventBus.$on('addedTest', this.addTest);
        },

        computed: {
        },

        methods: {
            addTest(test) {
                this.tests.push(test)
                this.$forceUpdate()
            },

            addTestToTest(test){
                console.log('adding ' + test.id + ' to test');
                this.$eventBus.$emit('AddTestToTest', test)
            },

            deckCounter(test) {
                if('decks' in test) {
                    return test.decks.length
                }
                return 0
            },

            fontSize(string) {
                return ((Math.round((10 / Math.pow(string.length, 0.4)) * 10))/ 10)
            },

            stringLimit(str) {
                if(str == null || str.length < 150) {
                    return str
                }
                return str.substring(0,150) + '...'
            },

            startTest(test) {
                window.location.href = '/test/' + test.slug + '/test'
            },

            editTest(test) {
                window.location.href = '/test/' + test.slug
            },

            showAll() {
                this.testsToShow = null
            },

            showDefault() {
                this.testsToShow = 3
            }
        }
    }
</script>
