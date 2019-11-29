<template>
    <portal to="test">
        <div class="fixed overflow-y-auto top-0 left-0 w-full h-full bg-gray-300 z-100" v-show="show" ref="portal" @click.self="resetModal">
            <div class="max-w-sm md:max-w-md lg:max-w-lg rounded-xl lg:shadow-lg lg:border mx-auto my-10 pt-2 pb-2 bg-white overflow-auto">
                <div class="relative px-6 py-4">
                    <button class="absolute top-0 right-0 mr-4 text-gray-800 hover:text-red-800" @click="resetModal">
                        <i class="material-icons">
                            close
                        </i>
                    </button>
                    <div class="font-semibold text-2xl text-teal-800 mb-6 text-center uppercase border-b pb-5">
                        <span v-if="newTest">Nieuwe Test</span>
                        <span v-else>Bewerk Test</span>
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
                            placeholder="Geef je test een heldere naam"
                            v-model="test.title"
                            @input="morphSlug"
                            @keydown.esc="resetModal"
                            required
                        >
                        <span class="p-2 text-red-600" v-if="errors.title" v-for="error in errors.title"> {{ error }} </span>

                        <label class="block mb-2 mt-4" for="input">Slug</label>
                        <span class="font-medium block h-5"> {{ test.slug }} </span>
                        <span class="p-2 text-red-600" v-if="errors.slug" v-for="error in errors.slug"> {{ error }} </span>

                        <label class="block mb-2 mt-4">
                            <span class="text-gray-700"> Omschrijving </span>
                            <textarea
                                class="form-textarea mt-1 block w-full"
                                rows="3"
                                placeholder="Alvast een korte omschrijving, dit kan je later altijd aanpassen"
                                v-model="test.description"
                                :class="{error: errors.description}">
                            </textarea>
                            <span class="p-2 text-red-600" v-if="errors.description" v-for="error in errors.description"> {{ error }} </span>
                        </label>
                    </div>
                    <div class="flex mt-6">
                        <label class="flex items-center switch">
                            <input type="checkbox" class="form-checkbox" v-model="test.public" >
                            <span class="slider round"></span>
                        </label>
                        <span class="ml-2 text-gray-400" :class="{ 'text-teal-700 font-semibold': test.public }"> Openbaar </span>
                    </div>
                    <button type="submit" class="block w-full bg-secondary hover:bg-secondary-dark text-white font-bold py-2 px-4 rounded mt-5" @click="storeTest" v-if="! updating">
                        <span v-if="newTest">
                            Creëer je test!
                        </span>
                        <span v-else>
                            Update je test
                        </span>
                    </button>
                    <button class="block w-full bg-gray-400  text-white font-bold py-2 px-4 rounded mt-5" v-if="updating" disabled>
                        <span v-if="newTest">
                            Aan het creëeren...
                        </span>
                        <span v-else>
                            Aan het updaten...
                        </span>
                    </button>
                    <delete-test-button
                        :test=test
                        v-if="! newTest"
                    >
                    </delete-test-button>
                </div>
            </div>
        </div>
    </portal>
</template>

<script>
    export default {
        name: "ManageTestModal",
        props: [
            // 'slugs'
        ],

        data() {
            return {
                show: false,
                newTest: true,
                originaltest: {},
                test: {
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
            // this.$eventBus.$on('editTestInModal', this.editTest)
            this.$eventBus.$on('newTestInModal', this.openModal)
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
            storeTest() {
                this.updating = true
                if (this.newTest) {
                    this.storeNewTest()
                    return
                }
                this.updateTest()
            },

            updateTest() {
                var home = this;
                axios.patch('/api/test/' + home.originaltest.slug, {
                    title: home.test.title,
                    slug: home.test.slug,
                    description: home.test.description,
                    public: home.test.public,
                })
                    .then( response => {
                        home.resetModal()
                        if(home.originaltest.slug != response.data.slug) {
                            window.location.href = "/test/" + response.data.slug
                        }
                        home.$eventBus.$emit('updatedTestInfo', response.data)
                    })
                    .catch(error => {
                        home.errors = error.response.data.errors
                        home.updating = false
                    })
            },

            storeNewTest() {
                var home = this;
                axios.post('/api/test', {
                    title: home.test.title,
                    slug: home.test.slug,
                    description: home.test.description,
                    public: home.test.public,
                })
                    .then( response => {
                        home.$eventBus.$emit('addedTest', response.data);
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
                this.test = {
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

            editTest(test) {
                this.newTest = false
                this.test = test
                this.originaltest = JSON.parse(JSON.stringify(test))
                this.show = true
            },

            morphSlug() {
                var regex = /\s/g
                this.test.slug = this.test.title
                    .toLowerCase()
                    .replace(/[^\w ]+/g,'')
                    .replace(/ +/g,'-')
                if (this.test.slug == this.originaltest.slug){
                    return
                }
                var thisslug = this.test.slug
                var addendum = 1
                while ( this.slugs.map( Object => Object.slug ).includes(this.test.slug) ) {
                    this.test.slug = thisslug + '-' + addendum
                    addendum++
                }
            }
        }
    }
</script>
