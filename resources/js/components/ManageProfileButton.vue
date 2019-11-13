<script>
    export default {
        name: "ManageProfileButton",
        methods: {
            manageProfile() {
                this.$eventBus.$emit('openProfileModal');
            }
        }
    }
</script>
