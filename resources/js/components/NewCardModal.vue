<template>
    <portal to="card">
        <div class="fixed top-0 left-0 w-full h-full bg-gray-300" v-show="show" ref="portal" @click.self="resetAndHide">
            <div class="max-w-sm overflow-hidden lg:border mx-auto mt-10 px-2 ">
                <div
                    class="w-1/4 inline-block text-center bg-white border-2 clickable noselect hover:bg-gray-200"
                    :class="{ 'bg-gray-200' : isActiveCardtype(cardtype) }"
                    v-for="cardtype in cardtypes"
                    @click="setCardtype(cardtype)"
                >
                    <i class="material-icons md-1-5 text-gray-500 " :class="{ 'text-gray-700' : isActiveCardtype(cardtype) }">
                        {{ cardtype.materialicon }}
                    </i>
                </div>
            </div>
            <div class="max-w-sm rounded overflow-hidden lg:shadow-lg lg:border mx-auto pt-2 pb-2 bg-white">
                <div class="relative px-6 py-4">
                    <button class="absolute top-0 right-0 mr-4 text-gray-800 hover:text-red-800" @click="resetAndHide">
                        <i class="material-icons">
                            close
                        </i>
                    </button>

                    <div class="font-bold text-xl mb-6 text-center"> {{ modalTitle }} </div>

                    <div class="block mb-3 text-gray-700 text-sm font-bold">
                        <span v-for="(error, key) in errors" :key="error.key"> {{ error }} </span>
                        <label class="block mb-2">{{ card.cardtype.fronttext }}</label>
                        <textarea class="form-textarea mt-1 block w-full" id="frontInput" ref="frontInput" :placeholder="card.cardtype.frontplaceholder" v-model="card.front" @keydown.esc="resetAndHide"></textarea>

                        <label class="block mb-2 mt-4" v-if="hasSideb">{{ card.cardtype.backtext }}</label>
                        <textarea class="form-textarea mt-1 block w-full" id="backInput"  :placeholder="card.cardtype.backplaceholder" v-model="card.back" v-if="hasSideb"></textarea>

                        <manage-multiple-choices
                            v-model="card.choices"
                             v-if="isMultipleChoice"
                         >
                         </manage-multiple-choices>
                    </div>
                    <button type="submit" class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-5" @click="storeCard">
                        <span v-if="newCard">
                            Create Card
                        </span>
                        <span v-else>
                            Update Card
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </portal>


</template>

<script>
    export default {
        props: [
            'deck_id',
            'cardtypes'
        ],

        data() {
            return {
                show: false,
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
            this.card.deck_id = this.deck_id
            this.$eventBus.$on('openNewCardModal', this.initializeCard)
            this.$eventBus.$on('openEditCardModal', this.initializeEditCard)
        },

        computed: {
            modalTitle() {
                if(this.newCard) {
                    return this.initialized ? 'Create: ' + this.card.cardtype.name.toLowerCase() : 'Create new card'
                }
                return this.initialized ? 'Edit: ' + this.card.cardtype.name.toLowerCase() : 'Create new card'
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
                        this.show = false
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
                        this.show = false
                    })
                });
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

            isActiveCardtype(cardtype) {
                return cardtype.id === this.card.cardtype.id ? true : false;
            },

            setCardtype(cardtype) {
                this.card.cardtype = cardtype
            },

            resetAndHide() {
                this.resetCard()
                this.show = false
            },

            resetCard() {
                this.newCard = true
                this.card = {
                    cardtype: this.cardtypes[0],
                    deck_id: null,
                    front: '',
                    back: '',
                    choices: [],
                };
            },

            initializeCard() {
                this.resetCard()
                this.initialized = true
                this.show = true
                setTimeout(() => this.$refs.frontInput.focus(), 100);
            },

            initializeEditCard(card) {
                this.card = card
                this.initialized = true
                this.newCard = false
                this.show = true
                setTimeout(() => this.$refs.frontInput.focus(), 100);
            },
        }
    }
</script>
