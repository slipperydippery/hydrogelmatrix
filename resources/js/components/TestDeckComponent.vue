<script>
    export default {
        props: [
        	'deck'
        ],

        data() {
            return {
            	activeCard: {},
            	mouseBack: false,
            	shuffledDeck: [],
            }
        },

        mounted() {
        	this.shuffledDeck = this.shuffleDeck(this.deck.cards);
        	this.activeCard = this.shuffledDeck[0];
        },

        computed: {
        	activeIndex() {
        		return this.shuffledDeck.indexOf(this.activeCard);
        	},

        	firstCardActive() {
        		return (this.activeIndex == 0) ? true : false;
        	},

        	lastCardActive() {
        		return (this.activeIndex + 1 >= this.shuffledDeck.length) ? true : false;
        	}
        },

        methods: {
        	previousQuestion() {
        		if( ! this.firstCardActive ) {
        			this.activeCard = this.shuffledDeck[this.activeIndex - 1];
        		}
        	},

        	nextQuestion() {
        		if( ! this.lastCardActive ) {
        			this.activeCard = this.shuffledDeck[this.activeIndex + 1];
        		}
        	},

        	backToDeck() {
        		window.location.href = "/deck/" + this.deck.slug;
        	},

        	shuffleDeck(array) {
        		for(let i = array.length - 1; i > 0; i--){
					const j = Math.floor(Math.random() * i)
					const temp = array[i]
					array[i] = array[j]
					array[j] = temp
        		}
        		return array;
        	},

        	shuffleAndRestart() {
        		this.shuffledDeck = this.shuffleDeck(this.deck.cards)
	        	this.activeCard = this.shuffledDeck[0];
        	}
        }
    }
</script>
