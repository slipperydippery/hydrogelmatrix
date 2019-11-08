<template>
    <portal to="deck">
        <div class="fixed overflow-y-auto top-0 left-0 w-full h-full bg-gray-300 z-100" v-show="show" ref="portal" @click.self="resetModal">
            <div class="max-w-sm md:max-w-md lg:max-w-lg rounded-xl lg:shadow-lg lg:border mx-auto my-10 pt-2 pb-2 bg-white overflow-auto">
                <div class="relative px-6 py-4">
                    <button class="absolute top-0 right-0 mr-4 text-gray-800 hover:text-red-800" @click="resetModal">
                        <i class="material-icons">
                            close
                        </i>
                    </button>
                    <div class="font-semibold text-2xl text-teal-800 mb-6 text-center uppercase border-b pb-5">
                        <span v-if="newDeck">Nieuwe Deck</span>
                        <span v-else>Bewerk Deck</span>
                    </div>
                    <div class="block mb-3 text-gray-700 text-sm font-bold">
                        <label class="block mb-2" for="input">Naam</label>
                        <input
                            type="text"
                            id="input"
                            class="form-input mt-1 block w-full mb-1"
                            :class="{error: errors.title}"
                            ref="input"
                            name="input"
                            placeholder="Geef je deck een heldere naam"
                            v-model="deck.title"
                            @input="morphSlug"
                            @keydown.esc="resetModal"
                            required
                        >
                        <span class="p-2 text-red-600" v-if="errors.title" v-for="error in errors.title"> {{ error }} </span>

                        <label class="block mb-2 mt-4" for="input">Slug</label>
                        <span class="font-medium block h-5"> {{ deck.slug }} </span>
                        <span class="p-2 text-red-600" v-if="errors.slug" v-for="error in errors.slug"> {{ error }} </span>

                        <label class="block mb-2 mt-4">
                            <span class="text-gray-700"> Omschrijving </span>
                            <textarea
                                    class="form-textarea mt-1 block w-full"
                                    rows="3"
                                    placeholder="Alvast een korte omschrijving, dit kan je later altijd aanpassen"
                                    v-model="deck.description"
                                    :class="{error: errors.description}">
                            </textarea>
                            <span class="p-2 text-red-600" v-if="errors.description" v-for="error in errors.description"> {{ error }} </span>
                        </label>
                    </div>
                    <div class="flex mt-6">
                        <label class="flex items-center switch">
                            <input type="checkbox" class="form-checkbox" v-model="deck.public" >
                            <span class="slider round"></span>
                        </label>
                        <span class="ml-2 text-gray-400" :class="{ 'text-teal-700 font-semibold': deck.public }"> Openbaar </span>
                    </div>
                    <button type="submit" class="block w-full bg-secondary hover:bg-secondary-dark text-white font-bold py-2 px-4 rounded mt-5" @click="storeDeck" v-if="! updating">
                        <span v-if="newDeck">
                            Creëer je deck!
                        </span>
                        <span v-else>
                            Update je deck
                        </span>
                    </button>
                    <button class="block w-full bg-gray-400  text-white font-bold py-2 px-4 rounded mt-5" v-if="updating" disabled>
                        <span v-if="newDeck">
                            Aan het creëeren...
                        </span>
                        <span v-else>
                            Aan het updaten...
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
            'slugs'
        ],

        data() {
            return {
                show: false,
                newDeck: true,
                originaldeck: {},
            	deck: {
            		title: '',
            		slug: '',
                    description: '',
                    public: false,
            	},
            	active: false,
                errors: {
                    title: null,
                    slug: null,
                    description: null
                },
                updating: false
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
                this.updating = true
                if (this.newDeck) {
                    this.storeNewDeck()
                    return
                }
                this.updateDeck()
            },

            updateDeck() {
                var home = this;
                axios.patch('/api/deck/' + home.originaldeck.slug, {
                    title: home.deck.title,
                    slug: home.deck.slug,
                    description: home.deck.description,
                    public: home.deck.public,
                })
                    .then( response => {
                        home.resetModal()
                        if(home.originaldeck.slug != response.data.slug) {
                            window.location.href = "/deck/" + response.data.slug
                        }
                        home.$eventBus.$emit('updatedDeckInfo', response.data)
                    })
                    .catch(error => {
                        home.errors = error.response.data.errors
                        home.updating = false
                    })
            },

        	storeNewDeck() {
	        	var home = this;
        		axios.post('/api/deck', {
                    title: home.deck.title,
                    slug: home.deck.slug,
                    description: home.deck.description,
                    public: home.deck.public,
        		})
        		.then( response => {
        			home.$eventBus.$emit('addedDeck', response.data);
        			home.resetModal()
        		})
                    .catch(error => {
                        home.errors = error.response.data.errors
                        home.updating = false
                    })
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
                this.updating = false
                this.errors = {
                    title: null,
                    slug: null,
                    description: null
                }
            },

            openModal() {
        	    this.show = true
            },

            editDeck(deck) {
        	    this.newDeck = false
        	    this.deck = deck
                this.originaldeck = JSON.parse(JSON.stringify(deck))
                this.show = true
            },

            morphSlug() {
                var regex = /\s/g
                this.deck.slug = this.deck.title
                                            .toLowerCase()
                                            .replace(/[^\w ]+/g,'')
                                            .replace(/ +/g,'-')
                if (this.deck.slug == this.originaldeck.slug){
                    return
                }
                var thisslug = this.deck.slug
                var addendum = 1
                while ( this.slugs.map( Object => Object.slug ).includes(this.deck.slug) ) {
                    this.deck.slug = thisslug + '-' + addendum
                    addendum++
                }
            }
        }
    }
</script>
