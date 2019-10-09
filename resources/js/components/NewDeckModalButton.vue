<template>
    <div>
        <button class="inline-block w-full px-8 py-2 mt-6 md:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold rounded"
                @click="newDeckInModal"
        >
            Make your first deck
        </button>

        <new-deck-modal
        >
        </new-deck-modal>

    </div>
</template>

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
