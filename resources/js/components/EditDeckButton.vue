
<script>
    export default {
        name: "EditDeckModalButton",

        props: [
            'deck'
        ],

        methods: {
            editDeckInModal() {
                this.$eventBus.$emit('editDeckInModal', this.deck)
            }
        }
    }
</script>
