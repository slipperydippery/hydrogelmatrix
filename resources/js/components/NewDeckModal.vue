<template>
    <portal to="modals">
        <div class="fixed top-0 left-0 w-full h-full bg-gray-300" v-show="show" ref="portal" @click.self="closeModal">
            <div class="max-w-sm rounded overflow-hidden lg:shadow-lg lg:border mx-auto mt-10 pt-2 pb-2 bg-white">
                <div class="relative px-6 py-4">
                    <button class="absolute top-0 right-0 mr-4 text-gray-800 hover:text-red-800" @click="closeModal">
                        <i class="material-icons">
                            close
                        </i>
                    </button>
                    <div class="font-bold text-xl mb-6 text-center">New Deck</div>
                    <div class="block mb-3">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="input">Deck name</label>
                        <input
                            id="input"
                            name="input"
                            type="text"
                            ref="input"
                            class="form-input mt-1 block w-full"
                            placeholder="Give your deck a recognizable name"
                            required
                            v-model="deck.title"
                            @keyup.enter="okAndCloseModal"
                            @keydown.esc="closeModal"
                            >
                    </div>
                    <div class="flex mt-6">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox" v-model="deck.public" >
                            <span class="ml-2">Public</span>
                        </label>
                    </div>
                    <button type="submit" class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-5" @click="storeDeck">Create Deck</button>
                </div>
            </div>
        </div>
    </portal>
</template>

<script>
    export default {
        props: [
            'show'
        ],

        data() {
            return {
            	deck: {
            		title: '',
                    public: false,
            	},
            	active: false,
            }
        },

        mounted() {
        },

        watch: {
            show: function(newVal, oldVal) {
                if (newVal == true) {
                    setTimeout(() => this.$refs.input.focus(), 100);
                }
            }
        },

        computed: {
        },

        methods: {
        	storeDeck() {
	        	var home = this;
        		axios.post('/api/deck', {
        			deck: home.deck
        		})
        		.then( response => {
        			this.$eventBus.$emit('addedDeck', response.data);
        			home.deck.title = '';
        			home.closeModal();
        		});
        	},

        	focusMyElement(e) {
				this.$refs.titleInput.focus()
    	    },

    	    okAndCloseModal() {
    	    	this.$emit('close');
    	    	this.storeDeck();
    	    },

            closeModal() {
    	    	this.$emit('close');
            },
        }
    }
</script>
