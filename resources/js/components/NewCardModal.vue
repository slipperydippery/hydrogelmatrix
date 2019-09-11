<template>
    <b-modal 
        id="newcardmodal" 
        :title="'Create new ' + card.cardtype.name.toLowerCase() + ' Card'"
        size="lg"
        @ok="storeCard"
        v-if="initialized"
        @shown="focusMyElement"
    >
        <div class="form-group">
            <label for="exampleInputEmail1">{{ card.cardtype.fronttext }}</label>
            <textarea class="form-control" id="titleInput" ref="titleInput"  :placeholder="card.cardtype.frontplaceholder" v-model="card.sidea"></textarea>
        </div>
        <div class="form-group" v-if="hasSideb">
            <label for="exampleInputEmail1">{{ card.cardtype.backtext }}</label>
            <textarea class="form-control" id="titleInput"  :placeholder="card.cardtype.backplaceholder" v-model="card.sideb"></textarea>
        </div>
        <manage-multiple-choices 
            v-model="choices"
             v-if="isMultipleChoice"
         >
         </manage-multiple-choices>
    </b-modal>
</template>

<script>
    export default {
        props: [
            'deckid',
        ],

        data() {
            return {
                initialized: false,
                card: {
                    cardtype: '',
                    deckid: this.deckid,
                    sidea: '',
                    sideb: '',
                },
                choices: [],
            }
        },
 
        watch: { 
        },

        mounted() {
            this.$eventBus.$on('setNewCardType', this.setActiveCardType);
        },

        computed: {
            hasSideb() {
                if( 
                    this.card.cardtype.slug == 'multiplechoice' ||
                    this.card.cardtype.slug == 'doit'
                ){
                    return false;
                };
                return true;
            },

            isMultipleChoice() {
                if( this.card.cardtype.slug == 'multiplechoice' ) {
                    return true;
                }
                return false;
            },

            completeMultipleChoice() {
                if(this.card.cardtype.slug == 'multiplechoice'){
                    if(! this.choices.map(choice => choice.active).includes(true)){
                        return false;
                    }
                    if(this.choices.length < 2){
                        return false;
                    }
                }
                return true;
            },
        },

        methods: {
            storeCard() {
                if(! this.completeMultipleChoice){
                    return
                }
                var home = this;
                axios.post('/api/card', {
                    card: home.card,
                    choices: home.choices,
                })
                .then( response => {
                    home.card = {
                        cardtype: this.card.cardtype.slug,
                        deckid: this.deckid,
                        sidea: '',
                        sideb: '',
                    };
                    home.choices = [],
                    this.$eventBus.$emit('addedCard', response.data);
                });
            },

            setActiveCardType(cardtype) { 
                this.card.cardtype = cardtype;
                this.initialized = true;
            },

            focusMyElement(e) {
                this.$refs.titleInput.focus()
            },
        }
    }
</script>