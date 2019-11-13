<template>
    <div>
        <button class="block w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-5" @click="showconfirm = true" v-if="! showconfirm">
            Verwijder dit account
        </button>
        <span class="block w-full bg-red-500 text-white font-bold py-2 px-4 rounded mt-5" v-if = showconfirm >
            <p>Weet je zeker dat je dit account wilt verwijderen? Eenmaal verwijderd is alle content verdwenen.</p>
            <button class="block w-full bg-white hover:bg-green-800 text-green-500 hover:text-white font-bold py-2 px-4 rounded mt-5" @click="showconfirm = false">
                Annuleer
            </button>
            <button class="block w-full bg-white hover:bg-red-700 text-red-500 hover:text-white font-bold py-2 px-4 rounded mt-3" @click="deleteUser(user)">
                Ik weet het zeker, verwijder hem!
            </button>
        </span>
    </div>
</template>

<script>
    export default {
        name: "DeleteProfileButton",

        props: [
            'user'
        ],

        data() {
            return {
                'showconfirm': false
            }
        },

        methods: {
            deleteUser(user) {
                var home = this
                axios.delete('/api/user/' + home.user.id)
                    .then( response => {

                        this.showconfirm = false
                        window.location.href = '/'
                    })
            }
        }
    }
</script>
