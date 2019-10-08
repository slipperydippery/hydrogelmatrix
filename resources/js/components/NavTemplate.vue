<script>
    export default {
        data() {
            return {
                'isHidden': true
            }
        },

        methods: {
            toggleHidden() {
                console.log('toggle hidden');
                this.isHidden = ! this.isHidden
            }

        }
    }
</script>

