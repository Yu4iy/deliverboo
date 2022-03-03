<template>
	<div  class="menu">
	<div v-if="this.info != null">
		<div class="menu-banner">
			<img  class="menu-banner__bg-img" :src="info.image" alt="">
			<div class="menu-banner__name">{{info.name}}</div>
			<div class="menu-banner__city">{{info.city}}</div>
			<div class="menu-banner__adress">{{info.address}}</div>
			<p class="menu-banner__desc">{{info.description}}</p>
		</div>
		<div class="menu-wraper">
			<div class="menu-main">

				<div v-for="(dish,index) in info.dishes" :key="`dishes-${dish.slug}`" class="menu-main__item">
					<div class="menu-card ">
							<div class="menu-card__wraper">
								<img class="img-fluid menu-img" :src="dish.image" alt="">
							</div>
							<div class="menu-card__desc">
									<h3>{{dish.name}}</h3>
									<p>{{dish.description||dish.ingredients}}</p> <!-- //*///////? -->
									<div>{{dish.price}}$</div>
							</div>
							<div class="d-flex justify-content-between btn-fix">
								<button @click="addDishToCart(dish,index)" class="btn btn-success">+</button>
							</div>
						</div>	
				</div>

			</div>
			<div class="menu-cart d-flex flex-column justify-content-between">
				<div>
					<h4 class="card-title">Your order</h4>
					<div v-show="cartDishes.length == 0" class="alert alert-secondary" role="alert">
						Basket empty
					</div>
					<div v-for="(cartDish, index) in cartDishes" :key="`cart-dishes-${index}`" class="menu-cart__item">
						<div class="img-wrap">
							<img :src="cartDish.image" alt="">
						</div>
						<div class="menu-cart__info">
							<h5>{{cartDish.name}}</h5>
							<div>Price: {{cartDish.price}}$</div>
							<div class="d-flex justify-content-between">
								<div>
									<button @click="decrement(cartDish,index)" class="btn btn-secondary">-</button>
									<span class="btn btn-success">{{cartDish.qunatiy}}</span>
									<button @click="increment(cartDish,index)" class="btn btn-secondary">+</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-between flex-column">
					<span class="my-2"><strong>Total: </strong>222$</span>
					<button class="w-100 btn btn-success">BUY</button>
				</div>
			</div>
		</div>
		</div> 
			<div v-else>
				<h1>MENU VUOTO</h1>
			</div>
	</div>
</template>
<script>
import axios from 'axios'
export default {
    name: "RestaurantMenu",
	 created(){
		 this.getResturant()
	 },
	 data(){
		 return{
			info:null,
			slug:'manuel-delsoglio',
			cartCounter:0,
			cartDishes:[],
			cartDish:{
				name:'',
				price:null,
				image:'',
				qunatiy:1
			}
		 }
	 },
	 methods: {
		getResturant(){
			axios.get(`http://127.0.0.1:8000/api/menu/${this.slug}`)
			.then(response => (
			this.info = response.data[0]))
		},

		addDishToCart(elem, index){

			const newDishCart =
			{
				name: elem.name,
				price: elem.price,
				image:elem.image,
				qunatiy: 1
		  	}

			if (this.cartDishes.filter(e => e.name === newDishCart.name).length > 0) {
				this.cartDishes[index].qunatiy++
			}else{
				this.cartDishes.push(newDishCart);
			}

			
			console.log(this.cartDishes);
		},

		increment(elem,index){
			this.addDishToCart(elem, index)
		},
		decrement(elem, index){
			const newDishCart =	{
											name: elem.name,
											price: elem.price,
											image: elem.image,
											qunatiy: 0
										}

			if (this.cartDishes.filter(e => e.name === newDishCart.name).length > 0) {
				if(this.cartDishes[index].qunatiy !== 1){
					this.cartDishes[index].qunatiy--
				}else if(this.cartDishes[index].qunatiy >= 0){
					this.cartDishes.splice(index, 1);
				}
			}else{
				this.cartDishes.push(newDishCart);
			}
		},
	 }
};
</script>

<style lang="scss" scoped>
.menu {
	padding: 0;
}
// MENU BANNER 
.menu-banner {
	background: rgba(0, 0, 0, 0.596);
	padding: 40px 40px;
	overflow: hidden;
	position: relative;
	// border-radius: 0 30px 30px 0;
		&__bg-img{
			position: absolute;
			object-fit: cover;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			z-index: -2;
		}
		&__name {
			color: #fff;
			font-weight: 700;
			font-size: 55px;
			
		}

		&__city {
			font-size: 20px;
			color: #fff;
		}

		&__adress {
			font-size: 20px;
			color: #fff;
		}

		&__desc {
			font-size: 16px;
			color: #fff;
			margin: 5px 0 0 0;
		}
}

.menu-wraper{
	height: 100vh;
	background: #f8fafc;
	display: grid;
	grid-template-columns: 1fr minmax(auto, 360px);
	grid-template-rows: 1fr;
	grid-column-gap: 0px;
	grid-row-gap: 0px; 
	
}
// menu 
.menu-main{
border-radius: 10px;
background: #f7f8f8;
margin: 20px 40px;
padding: 0 20px;
overflow: auto;
flex-direction: column;
&__item{
	// background: rgba(255, 255, 255, 0.329);
	flex: 0 0 0 ;
}
}
.menu-card{
	display: flex;
	border: 2px solid #eceeef;
	border-radius: 20px;
	padding: 0;
	margin: 0 0 10px 0 ;
	overflow: hidden;
	position: relative;

	// margin: 2px;
	
	&__wraper{
		flex: 0 0 20%;
		position: relative;
		height: auto;
	}
	&__desc{
		padding: 10px 15px;
	}
}
.btn-fix{
	position: absolute;
	right: 0;
	top: 0;
	bottom: 0;

}
.menu-img{
	width: 100%;
	height: 100%;
	object-fit: cover;
	position: absolute;
	top: 0;
	left: 0;
}

// cart 
.menu-cart{
background: #f7f8f8;
margin: 20px 40px;
padding: 8px 5px;
border: 2px solid #eceeef;
border-radius: 10px;
	&__item{
		background: rgb(255, 255, 255);
		border: 2px solid #eceeef;
		border-radius: 5px;
		padding: 10px 15px;
		margin: 4px 0;
		display: flex;
		
		.img-wrap{
			flex: 0 0 34%;
			position: relative;
			min-height: auto;
	
			img{
				width: 100%;
				height: 100%;
				object-fit: cover;
				position: absolute;
				top: 0;
				left: 0;
				padding: 0 10px 0 0;
			}
		}
	}
}

</style>
