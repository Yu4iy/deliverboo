<template>
    <div class="chekcout" v-if="successStatus === false">
		<h2 class="my-4">Checkout</h2>
		<div class="container-fluid">
			<div class="row ">
				<!-- MAIN  -->
				<div class="col-md-12 col-lg-8 bgr p-5">
					<h4 class="border-bottom py-2">Iserischi datti</h4>
					<form class="my-3" method="POST">
						<div class="row px-3 py-2 ">
							<div class="col mb-3">
								<label for="name" class="form-label">Nome</label>
								<input id="name" type="text" class="form-control" v-model="customer_name">
							</div>
							<div class="col mb-2">
								<label for="surname" class="form-label">Cognome</label>
								<input id="surname" type="text" class="form-control" v-model="customer_lastname" >
							</div>
						</div>
						<div class="row px-3 py-2">
							<div class="col mb-2">
								<label for="email" class="form-label">Email</label>
								<input id="email" type="email" class="form-control" v-model="customer_email">
							</div>
							<div class="col mb-3">
								<label for="phone" class="form-label">Cellulare</label>
								<input id="phone" type="tel" class="form-control" v-model="customer_phone">
							</div>
						</div>
						<div class="row px-3 py-2">
							<div class="col mb-2">
								<label for="adress" class="form-label">Citta - via - numero civico</label>
								<input id="address" type="text" class="form-control" v-model="customer_address">
							</div>
						</div>

						<div class="row px-3 py-2">
							<div class="mb-3 col">
								<label for="notes" class="form-label">Informazioni aggiuntive</label>
								<textarea id="notes" class="form-control" rows="5" v-model="notes"></textarea>
							</div>
						</div>
					</form>
				</div>

				<!-- CART -->
				<div class="col-md-12 col-lg-4 bgb">					
					<v-braintree v-if="clientToken"
							class="bg-light"
							:authorization="clientToken"
							locale="it_IT"
							btnText="Checkout"
							btnClass="btn btn-success"
							@success="onSuccess"
							@error="onError"
					>
					</v-braintree>
				</div>
			</div>
		</div>
    </div>
	<Success v-else/>
</template>

<script>
import axios from 'axios'
import Success from './Success'
export default {
    name: "Checkout",
	components: {
		Success,
	},
	 data(){
		 return{
			localData:null,
			token: null,
			customer_name: '',
			customer_lastname: '',
			customer_email: '',
			customer_phone: '',
			customer_address: '',
			notes: '',
			success: false,
		 }
	 },
	 computed: {
		 clientToken() {
			 return this.token
		 },
		 successStatus() {
			 return this.success
		 },
		 calculateTotal() {
            let total = 0;
            for (let i = 0; i < this.localData.length; i++) {
                total += this.localData[i].price * this.localData[i].quantity;
            }
            return total;
        },
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
		this.saveCartDishes()
    },
	 methods:{
		onSuccess (payload) {
		let nonce = payload.nonce;
		// Do something great with the nonce...
			axios.post('http://127.0.0.1:8000/api/complete-order', {
				customer_name : this.customer_name,
				customer_lastname : this.customer_lastname,
				customer_email : this.customer_email,
				customer_phone : this.customer_phone,
				customer_address : this.customer_address,
				notes : this.notes,
				dishes : this.localData,
				amount : 15,
				payment_method_nonce : nonce,
			})
			.then(res => {
				console.log(res.data)
			})
			.catch(err => {
				console.log(err)
			})
			this.success = true;
		},
		onError (error) {
		let message = error.message;
		// Whoops, an error has occured while trying to get the nonce
		console.log(message)
		},
		saveCartDishes() {
            const parsed = JSON.stringify(this.localData);
				
            localStorage.setItem("localData", parsed);
        },
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
/* .btn {

}

.btn-brand-color {
} */



</style>
