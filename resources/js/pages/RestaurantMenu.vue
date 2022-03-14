<template>
    <div class="menu">
        <div v-if="this.info != null">
            <div class="menu-banner">
                <img
                    class="menu-banner__bg-img"
                    :src="`/storage/${info.image}`"
                    alt=""
                />
                <div class="menu-banner__name">{{ info.restaurant_name }}</div>
                <div class="menu-banner__city">{{ info.city }}</div>
                <div class="menu-banner__adress">{{ info.address }}</div>
                <p class="menu-banner__desc">{{ info.description }}</p>
            </div>
            <div class="menu-title">
                <i class="fa-solid fa-utensils"></i> Menu
            </div>
            <div class="menu-wraper container-menu">
                <div class="menu-main">
                    <div
                        v-for="(dish, index) in info.dishes"
                        :key="`dishes-${dish.slug}`"
                        class="menu-main__item"
                    >
                        <!-- Modal -->
                        <div
                            class="modal fade"
                            id="alertCart"
                            tabindex="-1"
                            role="dialog"
                            aria-labelledby="alertCart"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="alertCart">
                                            Avviso
                                        </h5>
                                        <button
                                            type="button"
                                            class="close"
                                            data-dismiss="modal"
                                            aria-label="Close"
                                            id="close-button"
                                        >
                                            <span aria-hidden="true"
                                                >&times;</span
                                            >
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Stai per ordinare da un altro
                                        ristorante. Sei sicuro?
                                    </div>
                                    <div class="modal-footer">
                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-dismiss="modal"
                                            id="no"
                                        >
                                            No
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-delete"
                                            id="si"
                                            @click="addDishToCart(dish, index)"
                                        >
                                            Si
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="menu-card">
                            <div class="menu-card__wraper">
                                <img
                                    v-if="dish.image"
                                    class="img-fluid menu-img"
                                    :src="`/storage/${dish.image}`"
                                    alt=""
                                />
                                <img
                                    v-else
                                    src="https://www.nafservizi.it/wp-content/uploads/2020/10/default_image_01.png"
                                    alt=""
                                />
                            </div>
                            <div class="menu-card__desc">
                                <h3>{{ dish.name }}</h3>
                                <p>
                                    {{ dish.description || dish.ingredients }}
                                </p>
                                <!-- //*///////? -->
                                <div>{{ roundPrice(dish.price) }}€</div>
                            </div>
                            <div class="d-flex justify-content-between btn-fix">
                                <button
                                    @click="checkTestCart(dish, index)"
                                    class="btn btn-brand-color btn-absolute"
                                >
                                    <span class="text-vertical">add</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cart-wraper">
                    <div
                        class="menu-cart d-flex flex-column justify-content-between"
                    >
                        <div>
                            <h4 class="card-title">Your order</h4>
                            <div
                                v-show="localData.length == 0"
                                class="alert alert-secondary"
                                role="alert"
                            >
                                Basket empty
                            </div>
                            <div
                                v-for="(cartDish, index) in localData"
                                :key="`cart-dishes-${index}`"
                                class="menu-cart__item"
                            >
                                <div class="img-wrap">
                                    <img
                                        :src="`/storage/${cartDish.image}`"
                                        alt=""
                                    />
                                </div>
                                <div class="menu-cart__info">
                                    <h5>{{ cartDish.name }}</h5>
                                    <div>
                                        Price: {{ roundPrice(cartDish.price) }}€
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <button
                                                @click="
                                                    decrement(cartDish, index)
                                                "
                                                class="btn btn-secondary"
                                            >
                                                <i
                                                    class="fa-solid fa-minus"
                                                ></i>
                                            </button>
                                            <span class="btn btn-brand-color">{{
                                                cartDish.quantity
                                            }}</span>
                                            <button
                                                @click="
                                                    increment(cartDish, index)
                                                "
                                                class="btn btn-secondary"
                                            >
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between flex-column">
                            <span class="my-2"
                                ><strong
                                    >Total:
                                    {{ calculateTotal.toFixed(2) }}€</strong
                                ></span
                            >

                            <router-link
                                :disabled="localData.length == 0"
                                :event="localData.length > 0 ? 'click' : ''"
                                :to="{ name: 'checkout' }"
                                class="w-100 btn btn-brand-color"
                            >
                                <strong>CHECKOUT</strong>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <Loader />
        </div>
    </div>
</template>
<script>
import axios from "axios";
import Loader from "../components/Loader";
export default {
    name: "RestaurantMenu",
    components: {
        Loader,
    },
    created() {
        this.getResturant();
    },
    data() {
        return {
            info: null,
            cartCounter: 0,
            cartDishes: [],
            localData: [],
            href: "/cart",
            cartDish: {
                name: "",
                price: null,
                image: "",
                quantity: 1,
                restaurant_slug: "",
            },
        };
    },
    mounted() {
        if (localStorage.getItem("localData")) {
            try {
                this.localData = JSON.parse(localStorage.getItem("localData"));
                //  console.log(this.localData);
                this.test();
            } catch (e) {
                localStorage.removeItem("localData");
            }
        }
    },
    methods: {
        //  CheckCartLogic
        checkCart() {
            console.log("stop event");
            if (this.localData.length > 0) {
                console.log("restart event");
                /* window.location = this.href; */
            }
        },

        test() {
            const result = this.localData.filter(
                (elem) => elem.restaurant_slug === this.$route.params.slug
            );
            this.localData = result;
        },
        getResturant() {
            axios
                .get(
                    `http://127.0.0.1:8000/api/menu/${this.$route.params.slug}`
                )
                .then((response) => (this.info = response.data[0]));
        },
        //   getDish() {
        // 	  axios
        // 	      .get(
        //               `http://127.0.0.1:8000/api/menu/${this.$route.params.id}`
        //           )
        //           .then((response) => (
        // 				console.log(response.data, '=======================================')
        // 				 ));
        //   },
        addDishToCart(dish, index) {
            const dishCart = dish;
            const addKey = { quantity: 1, restaurant_slug: this.info.slug };
            const newDish = Object.assign(addKey, dishCart);
            // let test = {
            //     quantity: 1,
            // 	 restaurant_slug:this.info.slug,
            // };
            console.log(dish);

            if (
                this.localData.filter((e) => e.name === newDish.name).length > 0
            ) {
                //  console.log(this.localData);
                //  this.localData[index].quantity++;
            } else {
                this.localData.push(newDish);
            }
            this.saveCartDishes();
            // console.log(this.localData);
            // this.localData.push()
        },
        increment(dish, index) {
            this.localData[index].quantity++;
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
        openModal() {
            $("#alertCart").modal("toggle");
            const btnNo = document.getElementById("no");
            btnNo.addEventListener("click", function () {
                console.log("click no");
                $("#alertCart").modal("hide");
                return;
            });
            const btnSi = document.getElementById("si");
            btnSi.addEventListener("click", function () {
                console.log("click si");
                $("#alertCart").modal("hide");
            });
            const btnClose = document.getElementById("close-button");
            btnClose.addEventListener("click", function () {
                $("#alertCart").modal("hide");
            });
        },
        checkTestCart(dish, index) {
            let locals = JSON.parse(localStorage.getItem("localData"));
            console.log("info", this.info);
            if (
                locals.length > 0 &&
                locals.filter((e) => e.restaurant_slug === this.info.slug)
                    .length === 0
            ) {
                this.openModal();
                return;
                // if (!confirm("sei sicuro?")) {
                //     return;
                // }
            } else {
                this.addDishToCart(dish, index);
            }
        },
        roundPrice(el) {
            return el.toFixed(2);
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
    },
};
</script>

<style lang="scss" scoped>
.cart-wraper {
    @media only screen and (max-width: 900px) {
        width: 100%;
        display: flex;
        justify-content: center;
    }
}
.menu {
    padding: 0;
}
// MENU BANNER
.container-menu {
    max-width: 1380px;
    padding: 0 15px;
    margin: 0 auto;
    @media only screen and (max-width: 550px) {
        padding: 0 0px;
    }
}
.menu-banner {
    background: rgba(0, 0, 0, 0.596);
    padding: 40px 40px;
    overflow: hidden;
    position: relative;
    @media only screen and (max-width: 550px) {
        padding: 10px 15px;
    }
    // border-radius: 0 30px 30px 0;
    &__bg-img {
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
        @media only screen and (max-width: 800px) {
            font-size: 30px;
        }
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
.menu-title {
    font-weight: 700;
    padding: 30px 0;
    font-size: 35px;
    text-align: center;
    color: rgba(0, 0, 0, 0.692);
    @media only screen and (max-width: 550px) {
        padding: 15px 0 0 0px;
    }
}
.menu-wraper {
    //   height: 80vh;
    // background: #f8fafc;
    display: grid;
    grid-template-columns: 1fr minmax(auto, 360px);
    grid-template-rows: 1fr;
    grid-column-gap: 0px;
    grid-row-gap: 0px;
    @media only screen and (max-width: 900px) {
        grid: none;
    }
}
// menu
.menu-main {
    border-radius: 10px;
    // background: #f7f8f8;
    margin: 20px 20px;
    padding: 0 0px;
    overflow: auto;
    flex-direction: column;
    &__item {
        // background: rgba(255, 255, 255, 0.329);
        flex: 0 0 0;
    }
}
.menu-card {
    display: flex;
    border: 2px solid #eceeef;
    border-radius: 20px;
    padding: 0;
    margin: 0 0 40px 0;
    overflow: hidden;
    position: relative;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px,
        rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    @media only screen and (max-width: 550px) {
        display: block;
    }
    &__wraper {
        flex: 0 0 20%;
        position: relative;
        height: auto;
        @media only screen and (max-width: 550px) {
            img {
                position: static;
            }
        }
    }
    &__desc {
        padding: 10px 60px 10px 15px;
        @media only screen and (max-width: 550px) {
            padding: 10px 10px 10px 10px;
            text-align: center;
            h3 {
                font-size: 22px;
            }
            p {
                font-size: 12px;
            }
        }
    }
}
.btn-fix {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    @media only screen and (max-width: 550px) {
        position: static;
        button {
            width: 100%;
        }
    }
}
.menu-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0;

    left: 0;
}
// cart
.menu-cart {
    background: #f7f8f8;
    margin: 20px 20px;
    padding: 15px 15px;
    border: 2px solid #eceeef;
    border-radius: 10px;
    @media only screen and (max-width: 900px) {
        width: 100%;
        max-width: 600px;
    }
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
        rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
    &__item {
        background: rgb(255, 255, 255);
        border: 2px solid #eceeef;
        border-radius: 5px;
        padding: 10px 15px;
        margin: 4px 0;
        display: flex;
        box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em,
            rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em,
            rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
        .img-wrap {
            flex: 0 0 34%;
            position: relative;
            min-height: auto;
            img {
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
.btn-brand-color {
    background: #32bab3;
    color: #fff;
    font-weight: 700;
    &:hover {
        background: #2ea5a0;
    }
}
.btn-absolute {
    position: relative;
    padding: 0 15px;

    @media only screen and (max-width: 550px) {
        padding: 15px 0;
    }
}
.text-vertical {
    writing-mode: vertical-rl;
    text-orientation: upright;
    text-transform: uppercase;
    position: absolute;
    top: 50%;
    left: 50%;
    font-weight: 700;
    transform: translate(-50%, -50%);
    @media only screen and (max-width: 550px) {
        writing-mode: horizontal-tb;
    }
}
</style>
