<template>
    <div class="chekcout">
		<h2 class="my-4">Checkout</h2>
		<div class="container-fluid">
			<div class="row ">
				<!-- MAIN  -->
				<div class="col-md-12 col-lg-8 bgr p-5">
					<h4 class="border-bottom py-2">Iserischi datti</h4>
					<form class="my-3">
						<div class="row px-3 py-2 ">
							<div class="col mb-3">
								<label for="name" class="form-label">Nome</label>
								<input id="name" type="text" class="form-control" >
							</div>
							<div class="col mb-2">
								<label for="surname" class="form-label">Cognome</label>
								<input id="surname" type="text" class="form-control" >
							</div>
						</div>
						<div class="row px-3 py-2">
							<div class="col mb-2">
								<label for="email" class="form-label">Email</label>
								<input id="email" type="email" class="form-control" >
							</div>
							<div class="col mb-3">
								<label for="phone" class="form-label">Cellulare</label>
								<input id="phone" type="tel" class="form-control" >
							</div>
						</div>
						<div class="row px-3 py-2">
							<div class="col mb-2">
								<label for="adress" class="form-label">Citta - via - numero civico</label>
								<input id="adress" type="text" class="form-control" >
							</div>
						</div>

						<div class="row px-3 py-2">
							<div class="mb-3 col">
								<label for="notes" class="form-label">Informazioni aggiuntive</label>
								<textarea id="notes" class="form-control" rows="5"></textarea>
							</div>
						</div>
					</form>
				</div>

				<!-- CART -->
				<div class="col-md-12 col-lg-4 bgb">
					<div class="cart-wraper">
						<div>
							<div class="cart-item" v-for="(item, index) in localData" :key="`cart-${index}`" >
										<div class="cart-item__wraper-img">
												<img
														:src="`/storage/${item.image}`"
														alt=""
												/>
										</div>
										<div class="cart-item__info">
												<h5>{{ item.name }} <strong>x{{item.qunatiy}}</strong> </h5>
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
							<strong>Total: 22€</strong>
						</div>
						<v-braintree v-if="clientToken"
							class="bg-light"
							:authorization="clientToken"
							locale="it_IT"
							@success="onSuccess"
							@error="onError"
						>
							<template v-slot:button="slotProps"
							>
								<v-btn @click="slotProps.submit" class="btn btn-success">Checkout</v-btn>
							</template>
						</v-braintree>
					</div>
				</div>
			</div>
		</div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: "Checkout",
	 data(){
		 return{
			 localData:null,
			 token: null,
		 }
	 },
	 computed: {
		 clientToken() {
			 return this.token
		 }
	 },
	 mounted() {
		axios.get('http://127.0.0.1:8000/api/get-token')
		.then(res => {
			this.token = res.data;
		})
		.catch(err => {
			console.log(err)
		})
        if (localStorage.getItem("localData")) {
            try {
                this.localData = JSON.parse(
                    localStorage.getItem("localData")
                );
					
            } catch (e) {
                localStorage.removeItem("localData");
            }
        }
    },
	 methods:{
		onSuccess (payload) {
		let nonce = payload.nonce;
		// Do something great with the nonce...
			axios.post('http://127.0.0.1:8000/api/complete-order', {
				amount : 15,
				payment_method_nonce : nonce,
			})
		},
		onError (error) {
		let message = error.message;
		// Whoops, an error has occured while trying to get the nonce
		console.log(message)
		}
	}
};
</script>

<style lang="scss" scoped>
.chekcout{
	// height: 100vh;
	padding: 10px 0 0 0;
}
.bgr{ background: rgba(131, 131, 131, 0.103);}
.bgb{ padding: 20px 0; background: rgba(131, 131, 131, 0.555);}
.border-bottom{
	border-bottom: 2px solid rgba(0, 0, 0, 0.76);
}
.cart-wraper{
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	height: 100%;
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
