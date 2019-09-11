<template>
    <div class="col-4 hoverparent">
        <div class="hoverbuttons position-absolute w-100 h-100 d-flex flex-column justify-content-center squares--overlay hoverchild p-4">
            <b-list-group>
                <b-list-group-item 
                    href="#" 
                    class="px-5 text-center"
                    v-for="cardtype in cardtypes" 
                    @click="setAndShowCardmodal(cardtype)"
                > 
                    {{ cardtype.name }} 
                </b-list-group-item>
            </b-list-group>
        </div>
        <img :src="'https://dummyimage.com/600x400/c2c2c2/f2f2f2&text=' + 'new card' " alt="" class="img-fluid">
    </div>
</template>

<script>
    export default {
        props: [
        	'cardtypes',
        	'deckid'
        ],

        data() {
            return {
            	active: false,
            }
        },

        mounted() {
            this.$eventBus.$emit('setNewCardType', this.cardtypes[0]);
        },

        computed: {
        },

        methods: {
        	setAndShowCardmodal(cardtype) {
                this.$eventBus.$emit('setNewCardType', cardtype);
        		this.$bvModal.show('newcardmodal');
        	},
        }
    }
</script>