<script>
    export default {
        name: "NewDeckModalButton",

        props: [
        ],

        data() {
            return {
            }
        },

        methods: {
            newDeckInModal() {
                this.$eventBus.$emit('newDeckInModal')
            }
        }
    }
</script>

<style scoped>

</style>
