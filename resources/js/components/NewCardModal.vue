<template>
    <b-modal 
        id="newcardmodal" 
        title="Create new Card"
        size="lg"
        @ok="storeCard"
    >
        <div class="form-group">
            <label for="exampleInputEmail1">{{ activecardtype.fronttext }}</label>
            <textarea class="form-control" id="titleInput"  :placeholder="activecardtype.frontplaceholder" v-model="card.sidea"></textarea>
        </div>
        <div class="form-group" v-if="hasSideb">
            <label for="exampleInputEmail1">{{ activecardtype.backtext }}</label>
            <textarea class="form-control" id="titleInput"  :placeholder="activecardtype.backplaceholder" v-model="card.sideb"></textarea>
        </div>
        <div class="form-group" v-if="isMultipleChoice">
            <b-list-group>
                <b-list-group-item v-for="choice in choices" @click="setActiveChoice(choice)" :active="choice.active">
                    {{ choice.choice }}
                    <button type="button" class="close float-right" aria-label="Close" @click="removeChoice(choice)">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </b-list-group-item>
            </b-list-group>
            <input type="text" class="form-control" :placeholder="activecardtype.backplaceholder" v-model="newChoice" @keydown.enter="saveChoice()">
        </div>
    </b-modal>
</template>

<script>
    export default {
        props: [
            'deckid',
            'activecardtype'
        ],

        data() {
            return {
                card: {
                    cardtype: this.activecardtype.slug,
                    deckid: this.deckid,
                    sidea: '',
                    sideb: '',
                },
                choices: [],
                newChoice: '',
            }
        },
 
        watch: { 
            activecardtype: function(newVal, oldVal) { 
                this.card.cardtype = newVal;
            }
        },

        mounted() {
        },

        computed: {
            hasSideb() {
                if( 
                    this.activecardtype.slug == 'multiplechoice' ||
                    this.activecardtype.slug == 'doit'
                ){
                    return false;
                };
                return true;
            },

            isMultipleChoice() {
                if( this.activecardtype.slug == 'multiplechoice' ) {
                    return true;
                }
                return false;
            }
        },

        methods: {
            storeCard() {
                var home = this;
                axios.post('/api/card', {
                    card: home.card,
                })
                .then( response => {
                    home.card = {
                        cardtype: this.activecardtype.slug,
                        deckid: this.deckid,
                        sidea: '',
                        sideb: '',
                    };
                    this.$eventBus.$emit('addedCard', response.data);
                });
            },

            saveChoice() {
                this.choices.push({
                    choice: this.newChoice,
                    active: false
                });
                this.newChoice = '';
            },

            removeChoice(choice) {
                this.choices.splice(this.choices.indexOf(choice), 1);
            },

            setActiveChoice(choice) {
                this.choices.forEach( choice => {
                    choice.active = false
                } );
                choice.active = true;
            }
        }
    }
</script>