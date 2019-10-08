<template>
    <div>
        <button class="inline-block w-full px-8 py-2 mt-6 lg:w-auto bg-blue-500 hover:bg-blue-700 text-white font-bold rounded"
                @click="modalOpen = true"
        >
            Make your first deck
        </button>

        <new-deck-modal
            :show="modalOpen"
            @close="modalOpen = false"
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
                modalOpen: false
            }
        }
    }
</script>

<style scoped>

</style>
