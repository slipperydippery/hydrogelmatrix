<script>
    export default {
        name: "ManageTestButton",

        methods: {
            openNewTestModal() {
                this.$eventBus.$emit('newTestInModal');
            }
        }
    }
</script>
