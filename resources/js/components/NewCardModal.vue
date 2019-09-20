<template>
    <b-modal 
        id="newcardmodal" 
        ref="newcardmodal"
        :title="modalTitle"
        size="lg"
        @ok="storeCard"
        @shown="focusAndClearMyElement"
    >
        <b-alert show variant="danger" v-for="(error, key) in errors" :key="error.key"> {{ error }} </b-alert>
        <div class="form-group">
            <label for="exampleInputEmail1">{{ card.cardtype.fronttext }}</label>
            <textarea class="form-control" id="frontInput" ref="frontInput"  :placeholder="card.cardtype.frontplaceholder" v-model="card.front"></textarea>
        </div>
        <div class="form-group" v-if="hasSideb">
            <label for="exampleInputEmail1">{{ card.cardtype.backtext }}</label>
            <textarea class="form-control" id="backInput"  :placeholder="card.cardtype.backplaceholder" v-model="card.back"></textarea>
        </div>
        <manage-multiple-choices 
            v-model="card.choices"
             v-if="isMultipleChoice"
         >
         </manage-multiple-choices>
        
    </b-modal>
</template>

<script>
    export default {
        props: [
            'deck_id',
            'cardtypes'
        ],

        data() {
            return {
                card: {
                    cardtype: {name: '', slug: ''},
                    deck_id: null,
                    front: '',
                    back: '',
                    choices: [],
                },
                newCard: true,
                errors: [],
                initialized: false,
            }
        },
 
        watch: { 
        },

        mounted() {
            this.card.cardtype = this.cardtypes[0]
            this.card.deck_id = this.deck_id;
            this.$eventBus.$on('setNewCardType', this.initializeCard);
        },

        computed: {
            modalTitle() {
                return this.initialized ? 'Create new ' + this.card.cardtype.name.toLowerCase() + ' Card' : 'Create new card'
            },

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
                return this.card.cardtype.slug == 'multiplechoice' ? true : false
            },
        },

        methods: {
            storeCard(bvModalEvt) {
                bvModalEvt.preventDefault()
                this.errors = []
                if(! this.isValid()){
                    return
                }
                if(! this.newCard) {
                    this.updateCard();
                    return
                }
                this.storeNewCard();
            },

            updateCard() {
                var home = this;
                axios.patch('/api/card/' + this.card.id, {
                    card: home.card,
                })
                .then( response => {
                    this.resetCard()
                    this.$eventBus.$emit('updatedCard', response.data)
                    this.$nextTick( () => {
                        this.$refs.newcardmodal.hide()
                    })
                });
            },

            storeNewCard() {
                var home = this;
                axios.post('/api/card', {
                    card: home.card,
                })
                .then( response => {
                    this.resetCard()
                    this.$eventBus.$emit('addedCard', response.data)
                    this.$nextTick( () => {
                        this.$refs.newcardmodal.hide()
                    })
                });
            },

            resetCard() {
                this.card = {
                    cardtype: {name: ''},
                    deck_id: this.deck_id,
                    front: '',
                    back: '',
                };
                this.choices = []
            },

            initializeCard(carddata) { 
                this.initialized = true;
                this.newCard = carddata.newCard
                this.card.cardtype = carddata.card.cardtype
                this.card.deck_id = ('deck_id' in carddata.card) ? carddata.card.deck_id : this.deck_id
                this.card.front = ('front' in carddata.card) ? carddata.card.front : ''
                this.card.back = ('back' in carddata.card) ? carddata.card.back : ''
                this.card.choices = ('choices' in carddata.card) ? carddata.card.choices : []
                this.card.id = ('id' in carddata.card) ? carddata.card.id : 99
                this.$bvModal.show('newcardmodal');
            },

            focusAndClearMyElement(e) {
                this.errors = []
                this.$refs.frontInput.focus()
            },

            isValid() {
                switch(this.card.cardtype.slug) {
                  case 'multiplechoice':
                        return this.validMultipleChoice()
                    break;
                  case 'doit':
                        return this.validDoit()
                    break;
                  case 'qa':
                        return this.validQA()
                    break;
                  case 'flippable':
                        return this.validFlippable()
                    break;
                  default:
                }
            },

            validMultipleChoice() {
                var errorcount = 0;
                if(this.card.cardtype.slug == 'multiplechoice'){
                    if(this.card.choices.length < 2){
                        this.errors.push('A multiplechoice question must have at least two answers.')
                        errorcount ++;
                    }
                    if(! this.card.choices.map(choice => choice.correct).includes(true)){
                        this.errors.push('A multiplechoice question must have a correct answer selected.')
                        errorcount ++;
                    }
                }
                return errorcount ? false : true;
            },

            validQA() {
                var errorcount = 0
                if(this.card.front.length == '') {
                    this.errors.push('You must have a question.')
                    errorcount ++;
                }
                if(this.card.back.length == '') {
                    this.errors.push('You must have an answer.')
                    errorcount ++;
                }
                return errorcount ? false : true
            },

            validFlippable() {
                var errorcount = 0
                if(this.card.front.length == '') {
                    this.errors.push('You must have a native term.')
                    errorcount ++;
                }
                if(this.card.back.length == '') {
                    this.errors.push('You must have a foreign term.')
                    errorcount ++;
                }
                return errorcount ? false : true;
            },

            validDoit() {
                var errorcount = 0
                if(this.card.front.length == '') {
                    this.errors.push('You must set a task.')
                    errorcount ++;
                }
                return errorcount ? false : true;
            },
        }
    }
</script>