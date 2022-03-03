<template>
   <div v-if="category" class="advanced-search">
		<div class="menu-banner">
			<img  class="menu-banner__bg-img"  :src="category.image" :alt="category.name">
			<div class="menu-banner__name">{{category.name }}</div>
		</div>
			<div class="container">
				<ul class="restaurant" v-for="(restaurant, i) in category.users" :key="`restaurant-${i}`">
						<li class="restaurant-row-card ">
							<div class="restaurant-row-card__wraper">
								<img :src="restaurant.image " alt="">
							</div>
							<div class="restaurant-row-card__info d-flex justify-content-between">
								<div>
									<h4 class="restaurant-row-card__title d-flex justify-content-between">{{restaurant.restaurant_name }}</h4>
									<div class="restaurant-row-card__desc">{{restaurant.description}}</div>
									<span class="restaurant-row-card__address">{{restaurant.address + ', ' + restaurant.city}}</span>
								</div>
								
								<button class="restaurant-row-card__btn"><i class="fa-solid fa-utensils"></i> Menu</button>
							</div>
						</li>
				</ul>
			</div>
	</div>
		<!-- <div class="container">
            <div v-if="category">
                <h1 class="mb-3">{{ category.name }}</h1>
                <figure class="w-100">
                    <img :src="category.image" :alt="category.name">
                </figure>
                <div class="restaurants" v-if="category.users">
                    <ul class="restaurant" v-for="(restaurant, i) in category.users" :key="`restaurant-${i}`">                    
                        <li class="restaurant-card w-100">
                            <h3 class="restaurant-name">{{  restaurant.restaurant_name }}</h3>
                            <span class="address">{{ restaurant.address + ', ' + restaurant.city}}</span>
                        </li>
                    </ul>
                </div>
                <div v-else>
                    Non sono ancora presenti ristoranti per questa categoria.
                </div>
            </div>
            <div v-else>Loading restaurants...</div>
        </div> -->
  
</template>

<script>
import axios from 'axios';
export default {
    name: "AdvanceSearch",
    data() {
        return {
            category: null,
        }
    },
    mounted() {
        this.getCategory();
    },
    methods: {
        getCategory() {
            axios.get(`http://127.0.0.1:8000/api/restaurants/${this.$route.params.slug}`)
            .then(response => {
                this.category = response.data[0];
                console.log(this.category)
            })
            .catch(err => console.log(err))
        },
    },
};
</script>

<style lang="scss" scoped>
.advanced-search{
	padding: 60px 0 0 0;
}
.menu-banner {
	background: rgba(77, 76, 76, 0.589);
	padding: 40px 40px;
	overflow: hidden;
	position: relative;
	width: 100%;
	// border-radius:  0 0  70px 0px;
	text-align: center;
	margin: 0 0 40px 0;
	box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
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
			text-transform: uppercase;
			
		}

}


.restaurant{
	margin: 0 0 30px 0;
}
.restaurant-row-card {
	display: flex;
	border: 1px solid #a1a1a165;
	border-radius:5px 20px;
	overflow: hidden;
	background: #c2c1c11f;
	box-shadow: rgba(0, 0, 0, 0.18) 0px 2px 4px;
		&__wraper {
			flex: 0 0 23%;
			position: relative;
			min-height: 270px;
			img{
				width: 100%;
				height: 100%;
				object-fit: cover;
				position: absolute;
				top: 0;
				left: 0;
			}
		}
		&__info{
		padding: 20px 15px;
		width: 100%;
		color: rgba(0, 0, 0, 0.596);
		}
		&__title {
			font-size: 40px;
			font-weight: 700;
		}

		&__address {
			font-size: 20px;
			
			}

		&__desc {
			font-size: 22px;
			max-width: 700px;
			margin: 8px 0;

		}

		&__btn {
			padding: 8px 15px;
			background: transparent;
			text-transform: uppercase;
			color: #a1a1a1;
			transition: linear 0.2s;
			border: 2px solid #a1a1a186;
			border-radius: 5px;
			i{
				// color: #00ccbc;
				font-size: 15px;
			}
			&:hover{
				background: rgb(255, 255, 255);
				color: #00ccbc;
			}

		}



}
// .restaurant-name {
// }
// .address {
// }


</style>
