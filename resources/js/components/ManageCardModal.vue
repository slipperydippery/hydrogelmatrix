<template>
    <portal to="card">
        <div class="fixed overflow-y-auto top-0 left-0 w-full h-full bg-gray-300 z-100" v-show="show" ref="portal" @click.self="resetAndHide">
            <div class="max-w-sm md:max-w-md lg:max-w-lg overflow-hidden lg:border mx-auto mt-10 px-4 ">
                <div
                    class="w-1/4 inline-block text-center bg-white border-2 clickable noselect hover:bg-teal-700 hover:text-white"
                    :class="{ 'bg-teal-700' : isActiveCardtype(cardtype), 'text-white' : isActiveCardtype(cardtype), 'text-gray-500': ! isActiveCardtype(cardtype) }"
                    v-for="cardtype in cardtypes"
                    @click="setCardtype(cardtype)"
                >
                    <i class="material-icons md-1-5">
                        {{ cardtype.materialicon }}
                    </i>
                </div>
            </div>
            <div class="max-w-sm md:max-w-md lg:max-w-lg rounded-xl overflow-hidden lg:shadow-lg lg:border mx-auto pt-2 pb-2 bg-white">
                <div class="relative px-6 py-4">
                    <button class="absolute top-0 right-0 mr-4 text-gray-800 hover:text-red-800" @click="resetAndHide">
                        <i class="material-icons">
                            close
                        </i>
                    </button>

                    <div class="font-bold text-xl mb-6 text-center"> {{ modalTitle }} </div>

                    <div class="block mb-3 text-gray-700 text-sm font-bold">
                        <label class="block mb-2">{{ card.cardtype.fronttext }}</label>
                        <textarea class="form-textarea my-1 block w-full" id="frontInput" ref="frontInput" :placeholder="card.cardtype.frontplaceholder" v-model="card.front" @keydown.esc="resetAndHide"></textarea>
                        <span class="p-2 text-red-600" v-if="errors.front"> {{ errors.front }} </span>

                        <label class="block mb-2 mt-4" v-if="hasSideb">{{ card.cardtype.backtext }}</label>
                        <textarea class="form-textarea my-1 block w-full" id="backInput"  :placeholder="card.cardtype.backplaceholder" v-model="card.back" v-if="hasSideb"></textarea>
                        <span class="p-2 text-red-600" v-if="errors.back"> {{ errors.back }} </span>

                        <manage-multiple-choices
                            v-model="card.choices"
                             v-if="isMultipleChoice"
                         >
                         </manage-multiple-choices>
                        <span class="block p-2 text-red-600 w-full" v-if="errors.multiplechoice" v-for="error in errors.multiplechoice"> {{ error }} </span>
                    </div>
                    <button type="submit" class="block w-full bg-secondary hover:bg-secondary-dark text-white font-bold py-2 px-4 rounded mt-5" @click="storeCard">
                        <span v-if="newCard">
                            Creëer je kaart
                        </span>
                        <span v-else>
                            Update je kaart
                        </span>
                    </button>
                    <delete-card-button
                        :card=card
                        v-if="! newCard"
                    >
                    </delete-card-button>
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
                errors: {
                    front: null,
                    back: null,
                    multiplechoice: []
                },
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
            this.$eventBus.$on('deletedCard', () => {this.show = false})
        },

        computed: {
            modalTitle() {
                if(this.newCard) {
                    return this.initialized ? 'Creëer : ' + this.card.cardtype.name.toLowerCase() : 'Creëer een nieuwe kaart'
                }
                return this.initialized ? 'Edit: ' + this.card.cardtype.name.toLowerCase() : 'Edit een kaart'
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
                this.errors = {
                    front: null,
                    back: null,
                    multiplechoice: []
                }
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
                if(this.card.front.length == '') {
                    this.errors.front = 'Je moet wel een vraag stellen.'
                    errorcount ++;
                }
                if(this.card.choices.length < 2){
                    this.errors.multiplechoice.push('Een meerkeuzevraag moet minstens twee antwoorden hebben.')
                    errorcount ++;
                }
                if(! this.card.choices.map(choice => choice.correct).includes(true)){
                    this.errors.multiplechoice.push('Een meerkeuzevraag moet een correct antwoord hebben.')
                    errorcount ++;
                }
                return errorcount ? false : true;
            },

            validQA() {
                var errorcount = 0
                if(this.card.front.length == '') {
                    this.errors.front = 'Je moet wel een vraag stellen.'
                    errorcount ++;
                }
                if(this.card.back.length == '') {
                    this.errors.back = 'Je vraag heeft ook een antwoord nodig.'
                    errorcount ++;
                }
                return errorcount ? false : true
            },

            validFlippable() {
                var errorcount = 0
                if(this.card.front.length == '') {
                    this.errors.front = 'Je moet een bekende term hebben.'
                    errorcount ++;
                }
                if(this.card.back.length == '') {
                    this.errors.back = 'Je moet een vreemde term hebben.'
                    errorcount ++;
                }
                return errorcount ? false : true;
            },

            validDoit() {
                var errorcount = 0
                if(this.card.front.length == '') {
                    this.errors.front = 'Wat is je taak?'
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
                    deck_id: this.deck_id,
                    front: '',
                    back: '',
                    choices: [],
                }
                this.errors = {
                    front: null,
                    back: null,
                    multiplechoice: []
                }
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
