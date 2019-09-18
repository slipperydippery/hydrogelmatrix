/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import BootstrapVue from 'bootstrap-vue'
import PortalVue from 'portal-vue'
Vue.use(BootstrapVue);
Vue.use(PortalVue);


// import PortalVue from 'portal-vue'
// Vue.use(PortalVue);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('decks-by-user', require('./components/DecksByUser.vue').default);
Vue.component('cards-in-deck', require('./components/CardsInDeck.vue').default);
Vue.component('new-card-fixed-button', require('./components/NewCardFixedButton.vue').default);
Vue.component('new-card-card', require('./components/NewCardCard.vue').default);
Vue.component('new-card-modal', require('./components/NewCardModal.vue').default);
Vue.component('edit-card-modal', require('./components/EditCardModal.vue').default);

Vue.component('new-qa-card-modal', require('./components/NewQaCardModal.vue').default);
Vue.component('qa-test-component', require('./components/QaTestComponent.vue').default);
Vue.component('new-flippable-card-modal', require('./components/NewFlippableCardModal').default);
Vue.component('flippable-test-component', require('./components/FlippableTestComponent.vue').default);
Vue.component('multiplechoice-test-component', require('./components/MultiplechoiceTestComponent.vue').default);
Vue.component('new-doit-card-modal', require('./components/NewDoitCardModal').default);
Vue.component('doit-test-component', require('./components/DoitTestComponent.vue').default);


Vue.component('test-deck-component', require('./components/TestDeckComponent').default);
Vue.component('manage-multiple-choices', require('./components/ManageMultipleChoices').default);



// OLD
Vue.component('new-deck-modal', require('./components/NewDeckModal').default);
Vue.component('new-card-block-modal', require('./components/NewCardBlockModal').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.prototype.$eventBus = new Vue(); 
const app = new Vue({
    el: '#app',
});
