// IMPORT DEPENDENCIES 
import Vue from 'vue';
import App from './views/App.vue';
import vueBraintree from 'vue-braintree'
Vue.use(vueBraintree)

import router from './routes';
// INIT VUE INSTANS
const root = new Vue({
	el:'#root',
	router,
	render: h => h(App),

})