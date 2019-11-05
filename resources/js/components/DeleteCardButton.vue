<template>
    <div>
        <button class="block w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-5" @click="showconfirm = true" v-if="! showconfirm">
            Delete card
        </button>
        <span class="block w-full bg-red-500 text-white font-bold py-2 px-4 rounded mt-5" v-if = showconfirm >
            <p>Are you sure you want to delete this card? All cards will be destroyed, and can't be reinstanted.</p>
            <button class="block w-full bg-white hover:bg-green-800 text-green-500 hover:text-white font-bold py-2 px-4 rounded mt-5" @click="showconfirm = false">
                Cancel
            </button>
            <button class="block w-full bg-white hover:bg-red-700 text-red-500 hover:text-white font-bold py-2 px-4 rounded mt-3" @click="deleteCard(card)">
                I'm sure, delete it
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        name: "DeleteCardButton",
        props: [
            'card'
        ],

        data() {
            return {
                'showconfirm': false
            }
        },

        methods: {
            deleteCard(card) {
                var home = this
                axios.delete('/api/card/' + home.card.id)
                    .then( response => {
                        this.showconfirm = false
                        this.$eventBus.$emit('deletedCard', card)
                    })
            }
        }
    }
</script>
