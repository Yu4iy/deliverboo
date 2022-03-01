import Vue from "vue";
import VueRouter from "vue-router";
import Home from './pages/Home';
import AdvanceSearch from './pages/AdvanceSearch'
import RestaurantMenu from './pages/RestaurantMenu'
import Checkout from './pages/Checkout'
import Success from './pages/Success'



Vue.use(VueRouter)
const router = new VueRouter({
	mode: 'history',
	linkExactActiveClass: 'active',
	routes:[
		{
			path: '/',
			name: 'home',
			component: Home,
		},
		{
			path: '/advanced-search/:slug',
			name: 'advanced-search',
			component: AdvanceSearch,
		},
		{
			path: '/restaurant-menu/:slug',
			name: 'restaurant-menu',
			component: RestaurantMenu,
		},
		{
			path: '/checkout',
			name: 'checkout',
			component: Checkout,
		},
		{
			path: '/success',
			name: 'success',
			component: Success,
		},
	]
});

export default router;