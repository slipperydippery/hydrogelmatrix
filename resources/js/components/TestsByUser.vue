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
            this.$eventBus.$on('AddedDeckToTest', this.addedDeckToTest);
        },

        computed: {
        },

        methods: {
            addTest(test) {
                this.tests.push(test)
                this.$forceUpdate()
            },

            addedDeckToTest(response) {
                this.tests.find(x => x.id === response.test_id).decks.push(response.deck)
            },

            fontSize(string) {
                return ((Math.round((10 / Math.pow(string.length, 0.4)) * 10))/ 10)
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
