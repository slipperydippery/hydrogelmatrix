<template>
    <portal to="deck">
        <div class="absolute top-0 left-0 w-full min-h-full bg-gray-300-8 z-100" v-show="show" ref="portal" @click.self="resetModal">
            <div class="max-w-sm md:max-w-md lg:max-w-lg rounded-xl lg:shadow-lg lg:border mx-auto mt-10 pt-2 pb-2 bg-white overflow-auto">
                <div class="relative px-6 py-4">
                    <button class="absolute top-0 right-0 mr-4 text-gray-800 hover:text-red-800" @click="resetModal">
                        <i class="material-icons">
                            close
                        </i>
                    </button>
                    <div class="font-bold text-xl mb-6 text-center"> Nieuwe Deck </div>
                    <div class="block mb-3 text-gray-700 text-sm font-bold">
                        <label class="block mb-2" for="input">Naam</label>
                        <input
                            id="input"
                            name="input"
                            type="text"
                            ref="input"
                            class="form-input mt-1 block w-full"
                            placeholder="Geef je deck een heldere naam"
                            required
                            v-model="deck.title"
                            @keydown.esc="resetModal"
                            >
                        <label class="block mb-2 mt-4">
                            <span class="text-gray-700"> Omschrijving </span>
                            <textarea class="form-textarea mt-1 block w-full" rows="3" placeholder="Alvast een korte omschrijving, dit kan je later altijd aanpassen" v-model="deck.description"></textarea>
                        </label>
                    </div>
                    <div class="flex mt-6">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox" v-model="deck.public" >
                            <span class="ml-2"> Openbaar </span>
                        </label>
                    </div>
                    <button type="submit" class="block w-full bg-secondary hover:bg-secondary-dark text-white font-bold py-2 px-4 rounded mt-5" @click="storeDeck">
                        <span v-if="newDeck">
                            Creëer je deck!
                        </span>
                        <span v-else>
                            Update je deck
                        </span>
                    </button>
                    <delete-deck-button
                        :deck=deck
                        v-if="! newDeck"
                    >
                    </delete-deck-button>
                </div>
            </div>
        </div>
    </portal>
</template>

<script>
    export default {
        props: [
        ],

        data() {
            return {
                show: false,
                newDeck: true,
            	deck: {
            		title: '',
                    description: '',
                    public: false,
            	},
            	active: false,
            }
        },

        mounted() {
            this.$eventBus.$on('editDeckInModal', this.editDeck)
            this.$eventBus.$on('newDeckInModal', this.openModal)
        },

        watch: {
            show (newVal) {
                if (newVal) {
                    document.body.style.setProperty('overflow', 'hidden')
                    setTimeout(() => this.$refs.input.focus(), 100);
                } else {
                    document.body.style.removeProperty('overflow')
                }
            }
        },

        computed: {
        },

        methods: {
            storeDeck() {
                if (this.newDeck) {
                    this.storeNewDeck()
                }
                this.updateDeck()
            },

            updateDeck() {
                var home = this;
                axios.patch('/api/deck/' + this.deck.id, {
                    deck: home.deck
                })
                .then( response => {
                    home.resetModal()
                } )
            },

        	storeNewDeck() {
	        	var home = this;
        		axios.post('/api/deck', {
        			deck: home.deck
        		})
        		.then( response => {
        			this.$eventBus.$emit('addedDeck', response.data);
        			home.resetModal()
        		});
        	},

        	focusMyElement(e) {
				this.$refs.titleInput.focus()
    	    },

            resetModal() {
                this.deck = {
                    title: '',
                    description: '',
                    public: false
                }
    	    	this.show = false
            },

            openModal() {
        	    this.show = true
            },

            editDeck(deck) {
        	    this.newDeck = false
        	    this.deck = deck
                this.show = true
            }
        }
    }
</script>
