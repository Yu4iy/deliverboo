<template>
    <div class="checkout" v-if="successStatus === false">
        <h2 > <i class="fas fa-shopping-cart"></i> Checkout</h2>
        <div class="container-fluid mb-5 mt-3 cont-2">
            <div class="row">
                <!-- MAIN  -->
                <div class="col-md-12 col-lg-8 bgr p-5">
                    <h4 class="border_frm py-2 mx-2">Inserisci i tuoi dati</h4>

                    <form class="my-3 mt-5" method="POST">
                        <div class="row px-3 py-2">
                            <div class="col mb-3">
                                <label for="name" class="form-label"
                                    >Nome*</label
                                >
                                <input
                                    id="name"
                                    type="text"
                                    class="form-control"
                                    v-model="customer_name"
                                    required
                                    maxlength="50"
                                    placeholder="Nome"
                                />
                                <span
                                    class="text-danger"
                                    v-if="getErrors && getErrors.customer_name"
                                >
                                    {{
                                        getErrors.customer_name.join() ||
                                        getErrors.customer_name
                                    }}
                                </span>
                                <span v-else>{{
                                    getErrors.customer_name
                                }}</span>
                            </div>
                            <div class="col mb-2">
                                <label for="surname" class="form-label"
                                    >Cognome*</label
                                >
                                <input
                                    id="surname"
                                    type="text"
                                    class="form-control"
                                    v-model="customer_lastname"
                                    required
                                    maxlength="50"
                                    placeholder="Cognome"
                                />
                                <span
                                    class="text-danger"
                                    v-if="
                                        getErrors && getErrors.customer_lastname
                                    "
                                >
                                    {{
                                        getErrors.customer_lastname.join() ||
                                        getErrors.customer_lastname
                                    }}
                                </span>
                            </div>
                        </div>
                        <div class="row px-3 py-2">
                            <div class="col mb-2">
                                <label for="email" class="form-label"
                                    >Email*</label
                                >
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control"
                                    v-model="customer_email"
                                    required
                                    placeholder="email@test.com"
                                />
                                <span
                                    class="text-danger"
                                    v-if="getErrors && getErrors.customer_email"
                                >
                                    {{
                                        getErrors.customer_email.join() ||
                                        getErrors.customer_email
                                    }}
                                </span>
                            </div>
                            <div class="col mb-3">
                                <label for="phone" class="form-label"
                                    >Cellulare*</label
                                >
                                <input
                                    id="phone"
                                    type="tel"
                                    class="form-control"
                                    v-model="customer_phone"
                                    required
                                    placeholder="(+39)--"
                                />
                                <span
                                    class="text-danger"
                                    v-if="getErrors && getErrors.customer_phone"
                                >
                                    {{
                                        getErrors.customer_phone.join() ||
                                        getErrors.customer_phone
                                    }}
                                </span>
                            </div>
                        </div>
                        <div class="row px-3 py-2">
                            <div class="col mb-2">
                                <label for="adress" class="form-label"
                                    >Indirizzo*</label
                                >
                                <input
                                    id="address"
                                    type="text"
                                    class="form-control"
                                    v-model="customer_address"
                                    required
                                    placeholder="Città, Via Nome, n°"
                                    title="Compila in questo formato: 'NomeCittà, Via Nome, 00'"
                                />
                                <span
                                    class="text-danger"
                                    v-if="
                                        getErrors && getErrors.customer_address
                                    "
                                >
                                    {{
                                        getErrors.customer_address.join() ||
                                        getErrors.customer_address
                                    }}
                                </span>
                            </div>
                        </div>

                        <div class="row px-3 py-2">
                            <div class="mb-3 col">
                                <label for="notes" class="form-label"
                                    >Informazioni aggiuntive</label
                                >
                                <textarea
                                    id="notes"
                                    class="form-control"
                                    rows="5"
                                    v-model="notes"
                                    placeholder="Hai qualche intolleranza, il citofono non funziona, etc..."
                                ></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- CART -->
                <div
                    class="col-md-12 col-lg-4 bgb"
                    v-if="this.localData != null"
                >
                    <div class="cart-wraper">
                        <div>
                            <div
                                class="cart-item"
                                v-for="(item, index) in localData"
                                :key="`cart-${index}`"
                            >
                                <div class="cart-item__wraper-img">
                                    <img
                                        :src="`/storage/${item.image}`"
                                        alt=""
                                    />
                                </div>
                                <div class="cart-item__info ml-4">
                                    <h5>
                                        {{ item.name }}
                                        <strong class="quantity"
                                            >x{{ item.quantity }}</strong
                                        >
                                    </h5>
                                    <div>
                                        Price: {{ roundPrice(item.price) }}€
                                    </div>
                                    <div>
                                        <div class="mt-3">
                                            <button
                                                @click="decrement(item, index)"
                                                class="px-2  btn-cart"
                                            >
                                                <i
                                                    class="fa-solid fa-minus"
                                                ></i>
                                            </button>

                                            <button
                                                @click="increment(item, index)"
                                                class="px-2   btn-cart"
                                            >
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
								<div>
									<div class="totalPrice mb-5">
                                        Prezzo totale:
										<div>{{ calculateTotal.toFixed(2) }} €</div>
									</div>
									<v-braintree
										v-if="clientToken"
										class="bg-light"
										:authorization="clientToken"
										locale="it_IT"
										btnText="Checkout"
										btnClass="btn btn-primary mt-4 w-100 border border-primary"
										@success="onSuccess"
										@error="onError"
									>
									</v-braintree>
									<div v-if="payment" class="payment">
										<div class="payments"><strong>Pagamento in corso:</strong><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
									</div>
								</div>	
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Success v-else />
</template>

<script>
import axios from "axios";
import Success from "./Success";
import Loader from "../components/Loader";

export default {
    name: "Checkout",
    components: {
        Success,
        Loader,
    },
    data() {
        return {
            localData: null,
            token: null,
            customer_name: "",
            customer_lastname: "",
            customer_email: "",
            customer_phone: "",
            customer_address: "",
            notes: "",
            errors: {},
            success: false,
            payment: false,
        };
    },
    computed: {
        clientToken() {
            return this.token;
        },
        successStatus() {
            return this.success;
        },
        getErrors() {
            return this.errors;
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
        axios
            .get("http://127.0.0.1:8000/api/get-token")
            .then((res) => {
                this.token = res.data;
            })
            .catch((err) => {
                console.log(err);
            });
        if (localStorage.getItem("localData")) {
            try {
                this.localData = JSON.parse(localStorage.getItem("localData"));
            } catch (e) {
                localStorage.removeItem("localData");
            }
        }
        var inputNumbers = document.querySelectorAll('input[type="tel"]');
        const numbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "+"];
        inputNumbers.forEach((el) => {
            el.addEventListener("keypress", function (e) {
                if (!numbers.includes(e.key)) {
                    e.preventDefault();
                }
            });
        });
    },
    methods: {
        onSuccess(payload) {
            /* if(this.customer_name === '') {
			this.errors.customer_name = 'Questo campo è richiesto'
			console.log(JSON.stringify(this.getErrors.customer_name))
			this.errors.customer_name = JSON.parse(JSON.stringify(this.getErrors.customer_name));
			
			return
		}
		if(this.customer_lastname === '') {
			this.errors.customer_lastname = 'Questo campo è richiesto'
			return
		}
		if(this.customer_email === '') {
			this.errors.customer_email = 'Questo campo è richiesto'
			return
		}
		if(this.customer_phone === '') {
			this.errors.customer_phone = 'Questo campo è richiesto'
			return
		}
		if(this.customer_address === '') {
			this.errors.customer_address = 'Questo campo è richiesto'
			return
		} */
            this.payment = true;
            let nonce = payload.nonce;
            // Do something great with the nonce...
            axios
                .post("http://127.0.0.1:8000/api/complete-order", {
                    customer_name: this.customer_name,
                    customer_lastname: this.customer_lastname,
                    customer_email: this.customer_email,
                    customer_phone: this.customer_phone,
                    customer_address: this.customer_address,
                    notes: this.notes,
                    dishes: this.localData,
                    /* amount : 15, */
                    payment_method_nonce: nonce,
                })
                .then((res) => {
                    console.log(res.data);
                    if (res.data.errors) {
                        return (this.errors = res.data.errors);
                    }
                    this.success = true;
                })
                .catch((err) => {
                    console.log(err);
                    this.payment = false;
                });
        },
        onError(error) {
            let message = error.message;
            // Whoops, an error has occured while trying to get the nonce
            console.log(message);
        },
        increment(dish, index) {
            dish.quantity++;
            this.saveCartDishes();
        },
        decrement(dish, index) {
            const newDishCart = dish;
            if (this.localData.filter((e) => e.name === newDishCart.name)) {
                if (this.localData[index].quantity !== 1) {
                    this.localData[index].quantity--;
                } else if (this.localData[index].quantity >= 0) {
                    this.localData.splice(index, 1);
                }
            } else {
                this.localData.push(newDishCart);
            }

            this.saveCartDishes();
        },
        saveCartDishes() {
            const parsed = JSON.stringify(this.localData);
            localStorage.setItem("localData", parsed);
        },
        roundPrice(el) {
            return el.toFixed(2);
        },
    },
};
</script>

<style lang="scss" scoped>
.checkout {
    // height: 100vh;
    display: flex;
    align-items: center;
    flex-direction: column;
    padding: 10px 0 30px;

    h2 {
        margin-top: 65px;
        font-size: 35px;
        font-weight: bolder;
        color: rgba(0, 0, 0, 0.844);
        
    }
}

.bgr {
    background: #f8fafc;
}


.bgb {
    padding: 20px;
    padding-top: 43px;
    background: #f8fafc;
    // border-left: 2px solid #00ccbc;
}

.btn-cart{
    background-color: #00ccbc;
    margin-right: 5px;
    padding: 5px 30px;
    border: none;
    text-decoration: none;
    border-radius: 5px;
    color: white;
}

.cont-2{
    padding-left: 70px;
    padding-right: 80px;
}

// .border-bottom {
//     border-bottom: 2px solid rgba(0, 0, 0, 0.76);
// }
.border_frm{
    border-bottom: 1px solid rgb(194, 194, 194);
}

.cart-wraper {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

.cart-item {
    display: flex;
    margin: 20px;
    background: white;
    border: 1px solid rgb(208, 208, 208);
    border-radius: 20px;
    padding: 20px;
    align-items: center;
    box-shadow: rgba(45, 47, 49, 0.178) 0px 1px 2px 0px,
                        rgba(43, 46, 48, 0.082) 0px 1px 3px 1px;
    
    &:hover{
        box-shadow: rgba(0, 0, 0, 0.24) 0px 4px 10px;
    }
    

    &__wraper-img {
        flex: 0 0 30%;
        position: relative;
        min-height: 100px;
        img {
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
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    h5 {
        margin: 0px;
    }
}

.plu-min {
    color: black;
    border: 2px solid black;
	 padding: 0 10px;
}

.quantity {
    margin-left: 10px;
}

.totalPrice {
    border-bottom: 1px solid rgb(194, 194, 194);
    text-align: center;
    margin-top: 20px;
    font-size: 20px;
    padding-bottom: 20px;
    div {
        font-weight: bolder;
        font-size: 25px;

    }
}

input,
textarea {
    &:focus{
        border: 2px solid #00ccbc;
        box-shadow: none;
    }
}

.lds-ring {
  display: inline-block;
  position: relative;
  width: 40px;
  height: 44px;
}
.lds-ring div {
  box-sizing: border-box;
  display: block;
  position: absolute;
  width: 32px;
  height: 32px;
  margin: 8px;
  border: 8px solid #02ccbc;
  border-radius: 50%;
  animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  border-color: #02ccbc transparent transparent transparent;
}
.lds-ring div:nth-child(1) {
  animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
  animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
  animation-delay: -0.15s;
}
@keyframes lds-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

.payments{
	display: flex;
	align-items: center;
	padding: 10px 0;
}
.btn-test{
		width: 100% !important;

}


@media screen and (max-width: 1270px){
    .cont-2{
        padding-left: 30px;
        padding-right: 50px;
    }
}
</style>
