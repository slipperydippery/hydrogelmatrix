/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import PortalVue from 'portal-vue'
Vue.use(PortalVue);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//
// Dashboard
//

//
// Deck
//
Vue.component('new-card-fixed-button', require('./components/NewCardFixedButton.vue').default);
Vue.component('new-card-card', require('./components/NewCardCard.vue').default);
Vue.component('new-card-modal', require('./components/NewCardModal.vue').default);


//
// Test Deck Components:
//
Vue.component('test-deck-component', require('./components/TestDeckComponent').default);
Vue.component('qa-test-component', require('./components/QaTestComponent.vue').default);
Vue.component('flippable-test-component', require('./components/FlippableTestComponent.vue').default);
Vue.component('multiplechoice-test-component', require('./components/MultiplechoiceTestComponent.vue').default);
Vue.component('doit-test-component', require('./components/DoitTestComponent.vue').default);


//
// Loose components
//
Vue.component('hydrocard-text-formatter', require('./components/HydrocardTextFormatter.vue').default);
Vue.component('manage-multiple-choices', require('./components/ManageMultipleChoices').default);


// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
//                          TAILWIND REFACTOR:
// ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

//
// Modal Components
//
Vue.component('new-deck-button', require('./components/NewDeckButton.vue').default);
Vue.component('edit-deck-button', require('./components/EditDeckButton.vue').default);
Vue.component('manage-deck-modal', require('./components/ManageDeckModal.vue').default);
Vue.component('delete-deck-button', require('./components/DeleteDeckButton.vue').default);

Vue.component('decks-by-user', require('./components/DecksByUser.vue').default);

Vue.component('new-card-modal-button', require('./components/NewCardModalButton.vue').default);
Vue.component('cards-in-deck', require('./components/CardsInDeck.vue').default);

//
// Inline-templates
//
Vue.component('nav-template', require('./components/NavTemplate.vue').default);


Vue.prototype.$eventBus = new Vue();

const app = new Vue({
    el: '#app',
});
