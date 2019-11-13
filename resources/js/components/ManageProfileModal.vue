<template>
    <portal to="profile">
        <div class="fixed overflow-y-auto top-0 left-0 w-full h-full bg-gray-300 z-100" v-show="show" ref="portal" @click.self="resetAndHide">
            <div class="max-w-sm md:max-w-md lg:max-w-lg rounded-xl lg:shadow-lg lg:border mx-auto my-10 pt-2 pb-2 bg-white overflow-auto">
                <div class="relative px-6 py-4">
                    <button class="absolute top-0 right-0 mr-4 text-gray-800 hover:text-red-800" @click="resetAndHide">
                        <i class="material-icons">
                            close
                        </i>
                    </button>
                    <div class="font-semibold text-2xl text-teal-800 mb-6 text-center uppercase border-b pb-5">
                        Beheer Profiel
                    </div>
                    <div class="block mb-3 text-gray-700 text-sm font-bold">
                        <label class="block mb-2" for="username">Gebruikersnaam</label>
                        <input
                            type="text"
                            id="username"
                            class="form-input mt-1 block w-full mb-1"
                            :class="{error: errors.username}"
                            ref="username"
                            name="username"
                            placeholder="Je moet wel een naam hebben"
                            v-model="user.username"
                            @keydown.esc="resetAndHide"
                            required
                        >
                        <span class="p-2 text-red-600" v-if="errors.username" v-for="error in errors.username"> {{ error }} </span>
                    </div>
                    <button type="submit" class="block w-full bg-secondary hover:bg-secondary-dark text-white font-bold py-2 px-4 rounded mt-5" @click="updateUser" v-if="! updating">
                        Update je profiel
                    </button>
                    <button class="block w-full bg-gray-400  text-white font-bold py-2 px-4 rounded mt-5" v-if="updating" disabled>
                        Aan het updaten...
                    </button>

                    <delete-profile-button
                        :user=user
                    >
                    </delete-profile-button>
                </div>
            </div>
        </div>
    </portal>
</template>

<script>
    export default {
        name: "ManageProfileModal",
        props: [
            'initialuser'
        ],

        data() {
            return {
                show: false,
                user: {
                    username: ''
                },
                errors: {
                    username: null,
                },
                updating: false
            }
        },

        mounted() {
            this.$eventBus.$on('openProfileModal', this.startModal)
            this.user = this.initialuser
        },

        watch: {
            show(newVal) {
                if (newVal) {
                    document.body.style.setProperty('overflow', 'hidden')
                    setTimeout(() => this.$refs.username.focus(), 100);
                } else {
                    document.body.style.removeProperty('overflow')
                }
            }
        },

        methods: {
            startModal() {
                this.show = true
            },

            resetAndHide() {
                this.show = false
            },

            updateUser() {
                var home = this
                this.updating = true
                axios.patch('/api/user/' + home.user.id, {
                    username: this.user.username
                })
                    .then( response => {
                        this.show = false
                        this.updating = false
                    })
                    .catch( error => {
                        console.log(error.response.data.errors)
                        home.errors = error.response.data.errors
                        home.updating = false
                    })
            }
        }
    }
</script>

<style scoped>

</style>
