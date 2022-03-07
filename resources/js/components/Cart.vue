<template>
    <div class="cart">
  					<div class="cart-wraper">
						<div>
							<div class="cart-item" v-for="(item, index) in localData" :key="`cart-${index}`" >
										<!-- !!!!! -->
						            <input type="hidden" name="dishes[]" :value="JSON.stringify(item)">
										<!-- !!!!! -->
										<div class="cart-item__wraper-img">
												<img
														:src="`/storage/${item.image}`"
														alt=""
												/>
										</div>
										<div class="cart-item__info">
												<h5>{{ item.name }} <strong>x{{item.quantity}}</strong> </h5>
												<div>Price: {{ item.price }}€</div>
												<div>
														<div>
															<button class="px-2 border-secondary  rounded">
																<i class="fa-solid fa-minus"></i>
															</button>
									
															<button class="px-2 border-secondary  rounded">
																<i class="fa-solid fa-plus"></i>
															</button>
														</div>
												</div>
										</div>
							</div>
						</div>
						<div>
							<strong>Total: {{calculateTotal.toFixed(2)}}€</strong>
						</div>
					</div>
       		 <div class="menu-cart d-flex flex-column justify-content-between">               
        </div>
            
    </div>
</template>

<script>
export default {
    name: 'Cart',
    data() {
        return {
            localData: []
        };
    },
    mounted() {
		
        if (localStorage.getItem("localData")) {
            try {
                this.localData = JSON.parse(
                    localStorage.getItem("localData")
                );
					 console.log(this.localData);
					this.test()
					
            } catch (e) {
                localStorage.removeItem("localData");

            }
        }
 		this.saveCartDishes()
    },
	 methods: {
        saveCartDishes() {
            const parsed = JSON.stringify(this.localData);
				
            localStorage.setItem("localData", parsed);
        },

	},
	computed: {
				calculateTotal() {
            let total = 0;
            for (let i = 0; i < this.localData.length; i++) {
                total += this.localData[i].price * this.localData[i].quantity;
            }
            return total;
        },
	}
	
}
</script>

<style lang="scss" scoped>
.chekcout{
	// height: 100vh;
	padding: 10px 0 0 0;
}
// .bgr{ background: rgba(131, 131, 131, 0.103);}
// .bgb{ padding: 20px 0; background: rgba(131, 131, 131, 0.555);}
.border-bottom{
	border-bottom: 2px solid rgba(0, 0, 0, 0.76);
}
.cart-wraper{
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	height: 100%;
	margin: 27px 0 0 0;
}
.cart-item {
	display: flex;
	margin: 10px;
	background: rgb(141, 141, 141);
	align-items: center;

		&__wraper-img {
			flex:  0 0 30%;
			position: relative;
			min-height: 100px;
			img{
				width: 100%;
				height: 100%;
				object-fit: cover;
				position: absolute;
				top: 0;
				left: 0;
			}
		}

		&__info {
			margin: 0 0 0 10px;
		}
}
.btn {
}
.btn-brand-color {
}
</style>