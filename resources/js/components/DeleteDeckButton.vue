<template>
    <div>
        <button class="block w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-5" @click="showconfirm = true" v-if="! showconfirm">
            Verwijder deck
        </button>
        <span class="block w-full bg-red-500 text-white font-bold py-2 px-4 rounded mt-5" v-if = showconfirm >
            <p> Weet je zeker dat je je deck wilt verwijderen? Alle bijbehorende kaarten worden ook verwijderd en kunnen niet meer teruggehaald worden. </p>
            <button class="block w-full bg-white hover:bg-green-800 text-green-500 hover:text-white font-bold py-2 px-4 rounded mt-5" @click="showconfirm = false">
                Annuleer
            </button>
            <button class="block w-full bg-white hover:bg-red-700 text-red-500 hover:text-white font-bold py-2 px-4 rounded mt-3" @click="deleteDeck(deck)">
                Ik weet het zeker, verwijder hem
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        name: "DeleteDeckButton",
        props: [
            'deck'
        ],

        data() {
            return {
                'showconfirm': false
            }
        },

        methods: {
            deleteDeck(deck) {
                var home = this
                axios.delete('/api/deck/' + home.deck.slug)
                    .then( response => {
                        window.location.href = "/"
                    })
            }
        }
    }
</script>
