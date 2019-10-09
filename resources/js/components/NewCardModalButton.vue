<script>
    export default {
        name: "NewCardModalButton",

        props: [
            'deck_id',
            'cardtypes'
        ],

        data() {
            return {
            }
        },

        watch: {
        },

        mounted() {
        },

        computed: {
        },

        methods: {
            openNewCardModal() {
                this.$eventBus.$emit('openNewCardModal')
            }
        }
    }

</script>
