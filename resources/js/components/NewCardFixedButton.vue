<template>
	<div 
		class="newdeckbutton--fixed active"
		@mouseover="active = true"
	    @mouseleave="active = false"
	>
        <i class="material-icons md-3 clickable" v-if="! active">
            add_circle_outline
        </i>
		<b-list-group v-if="active">
			<b-list-group-item 
				href="#" 
				v-for="cardtype in cardtypes" 
				@click="$bvModal.show(cardtype.slug + 'modal')"
			> 
				{{ cardtype.name }} 
			</b-list-group-item>
		</b-list-group>
    </div>
</template>

<script>
    export default {
        props: [
        	'cardtypes'
        ],

        data() {
            return {
            	active: false,
            }
        },

        mounted() {
        },

        computed: {
        },

        methods: {
        }
    }
</script>