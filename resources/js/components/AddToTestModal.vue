<template>
    <portal to="addtotest">
        <div class="fixed overflow-y-auto top-0 left-0 w-full h-full bg-gray-300 z-100" v-show="show" ref="portal">
            <div class="max-w-sm md:max-w-md lg:max-w-lg rounded-xl lg:shadow-lg lg:border mx-auto my-10 pt-2 pb-2 bg-white overflow-auto">
                <div class="relative px-6 py-4">
                    <button class="absolute top-0 right-0 mr-4 text-gray-800 hover:text-red-800" @click="resetModal">
                        <i class="material-icons">
                            close
                        </i>
                    </button>
                    <div class="font-semibold text-2xl text-teal-800 mb-6 text-center uppercase border-b pb-5">
                        Voeg toe aan test
                    </div>
                    <div class="block mb-3 text-gray-700 text-sm font-bold">
                        <label class="block mb-2" for="search">Zoek</label>
                        <input
                            type="text"
                            id="search"
                            class="form-input mt-1 block w-full mb-1"
                            ref="search"
                            name="search"
                            placeholder=""
                            v-model="search"
                            @input="morphSlug"
                            @keydown.esc="resetAndHide"
                            @keydown.enter="addToActiveTest"
                            required
                        >
                    </div>
                    <div v-for="test in searchedTests" :key="test.id"
                         class="bg-transparent hover:bg-teal-500 font-semibold hover:text-white py-2 px-4 border border-teal-500 hover:border-transparent rounded clickable"
                         :class="{'bg-teal-500 text-white border-transparent': activeTest.title == test.title}"
                         @click="addToTest(test)"
                         v-if=" ! testIncludesDeck(test) "
                    >
                        {{ test.title }}
                    </div>
                    <div class="bg-transparent hover:bg-teal-500 font-semibold hover:text-white py-2 px-4 border border-teal-500 hover:border-transparent rounded clickable"
                         :class="{'bg-teal-500 text-white border-transparent': ! activeTest}"
                         v-if="search && ! activeTest"
                         @click="createAndAddToTest()"
                    >
                        {{ search }} <span class="font-normal"> (new)</span>
                    </div>
                </div>
            </div>
        </div>
    </portal>
</template>

<script>
    export default {
        name: "AddToTestModal",

        props: [
            'tests',
            'user',
            'slugsInStorage'
        ],

        data() {
            return {
                show: false,
                search: '',
                slug: '',
                deck: {
                    id: null
                },
                slugs: []
            }
        },

        mounted() {
            this.slugs = this.slugsInStorage
            this.$eventBus.$on('AddDeckToTest', this.addDeckToTest)
            this.$eventBus.$on('addedTest', this.addTest);
        },

        watch: {
            show (newVal) {
                if (newVal) {
                    document.body.style.setProperty('overflow', 'hidden')
                    setTimeout(() => this.$refs.search.focus(), 100);
                } else {
                    document.body.style.removeProperty('overflow')
                }
            }
        },

        computed: {
            searchedTests() {
                if(!this.search.length){
                    return this.tests
                }

                return this.tests.filter( test => {
                    return test.title.includes(this.search)
                })

            },

            activeTest() {
                var result = false
                this.tests.forEach( test => {
                    if( test.title == this.search ){
                        result = test
                    }
                })
                return result
            }
        },

        methods: {
            addDeckToTest(deck) {
                this.show = true
                this.deck = deck
            },

            addTest(test) {
                this.slugs.push({slug: test.slug})
                this.tests.push(test)
            },

            resetModal() {
                this.show = false
            },

            createAndAddToTest() {
                var home = this
                axios.post('/api/test/', {
                    deck_id: this.deck.id,
                    title: this.search,
                    slug: this.slug
                })
                    .then( response => {
                        home.$eventBus.$emit('addedTest', response.data)
                        home.show = false
                    } )
            },

            addToActiveTest() {
                if(! this.activeTest){
                    this.createAndAddToTest();
                    return
                }
                this.addToTest(this.activeTest);
            },

            addToTest(test) {
                var home = this
                axios.post('/api/constituent/', {
                    test: test,
                    deck_id: this.deck.id,
                })
                    .then( response => {
                        home.$eventBus.$emit('AddedDeckToTest', response.data)
                        home.show = false
                    } )
            },

            morphSlug() {
                var regex = /\s/g
                this.slug = this.user.username + '-' + this.search
                    .toLowerCase()
                    .replace(/[^\w ]+/g,'')
                    .replace(/ +/g,'-')
                var thisslug = this.slug
                var addendum = 1
                while ( this.slugs.map( Object => Object.slug ).includes(this.slug) ) {
                    this.slug = thisslug + '-' + addendum
                    addendum++
                }
            },

            resetAndHide() {
                this.search = ''
                this.show = false
                this.deck = {
                    id: null
                }
            },

            testIncludesDeck(test){
                return test.decks.map( deck => deck.id ).includes( this.deck.id )
            }
        }
    }
</script>

