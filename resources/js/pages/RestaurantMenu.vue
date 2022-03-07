<template>
    <div class="menu">
        <div>
            <div class="menu-banner">
                <img
                    class="menu-banner__bg-img"
                    :src="dataRestaurant.image"
                    alt=""
                />
                <div class="menu-banner__name">
                    {{ dataRestaurant.restaurant_name }}
                </div>
                <div class="menu-banner__city">{{ dataRestaurant.city }}</div>
                <div class="menu-banner__adress">
                    {{ dataRestaurant.address }}
                </div>
                <p class="menu-banner__desc">
                    {{ dataRestaurant.description }}
                </p>
            </div>
            <div class="menu-title">
                <i class="fa-solid fa-utensils"></i> Menu
            </div>
            <div class="menu-wraper container-menu">
                <div class="menu-main">
                    <div
                        v-for="(dish, index) in info"
                        :key="`dishes-${dish.slug}`"
                        class="menu-main__item"
                    >
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
                                <div>{{ dish.price }}€</div>
                            </div>
                            <div class="d-flex justify-content-between btn-fix">
                                <!-- <button
                                    @click="addDishToCart(dish, index)"
                                    class="btn btn-brand-color"
                                >
                                    <i class="fa-solid fa-plus"></i>
                                </button> -->
                                <button
                                    class="btn"
                                    type="submit"
                                    data-toggle="modal"
                                    data-target="#modalCart"
                                >
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                                <!-- Modal -->
                                <div
                                    class="modal fade"
                                    id="modalCart"
                                    tabindex="-1"
                                    role="dialog"
                                    aria-labelledby="exampleModalLabel"
                                    aria-hidden="true"
                                >
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5
                                                    class="modal-title"
                                                    id="exampleModalLabel"
                                                >
                                                    Cestina
                                                </h5>
                                                <button
                                                    type="button"
                                                    class="close"
                                                    data-dismiss="modal"
                                                    aria-label="Close"
                                                >
                                                    <span
                                                        aria-hidden="true"
                                                        class="x"
                                                        >&times;</span
                                                    >
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Vuoi spostare questo elemento
                                                nel cestino?
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-dismiss="modal"
                                                >
                                                    No
                                                </button>

                                                <button
                                                    class="btn btn-delete"
                                                    type="button "
                                                    data-dismiss="modal"
                                                    aria-label="Close"
                                                    @click="
                                                        addDishToCart(
                                                            dish,
                                                            index
                                                        )
                                                    "
                                                >
                                                    Si
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                    <div>Price: {{ cartDish.price }}€</div>
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
                                                cartDish.qunatiy
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
                            <!-- <button
                                onclick="location.href='/cart'"
                                class="w-100 btn btn-brand-color"
                                @click.prevent="checkCart()"
                            >
                                CHECKOUT
                            </button> -->
                            <a
                                @click.prevent="checkCart()"
                                id="checkout"
                                href="/cart"
                                class="w-100 btn btn-brand-color"
                                >CHECKOUT</a
                            >
                        </div>
                    </div>
                    <div v-show="info.length == 0">Is Empty</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    name: "RestaurantMenu",
    created() {
        this.getResturant();
    },
    data() {
        return {
            info: null,
            href: "/cart",
            cartCounter: 0,
            cartDishes: [],
            localData: [],
            dataRestaurant: null,
            menuIsEmpty: "",
            cartDish: {
                name: "",
                price: null,
                image: "",
                qunatiy: 1,
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
                .then(
                    (response) => (
                        //  console.log(response.data[0])
                        //  console.log('------------------------- ', response)

                        (this.dataRestaurant = response.data[0]),
                        (this.info = this.dataRestaurant.dishes.filter(
                            (e) => e.is_visible == 1
                        ))

                        //  console.log(this.info);
                        // this.info.filter((e) => e.name === newDish.name)
                    )
                );
        },

        addDishToCart(dish, index) {
            const dishCart = dish;
            const addKey = { qunatiy: 1, restaurant_slug: this.info.slug };
            const newDish = Object.assign(addKey, dishCart);
            // let test = {
            //     qunatiy: 1,
            // 	 restaurant_slug:this.info.slug,
            // };
            console.log(dish);
            if (
                this.localData.filter((e) => e.name === newDish.name).length > 0
            ) {
                this.localData[index].qunatiy++;
            } else {
                this.localData.push(newDish);
            }
            this.saveCartDishes();
            // console.log(this.localData);
            // this.localData.push()
        },

        increment(dish, index) {
            this.addDishToCart(dish, index);
            this.saveCartDishes();
        },
        decrement(dish, index) {
            const newDishCart = dish;

            if (this.localData.filter((e) => e.name === newDishCart.name)) {
                if (this.localData[index].qunatiy !== 1) {
                    this.localData[index].qunatiy--;
                } else if (this.localData[index].qunatiy >= 0) {
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
        checkCart() {
            console.log("stop event");
            if (this.localData.length > 0) {
                console.log("restart event");
                window.location = this.href;
            }
        },
    },
    computed: {
        calculateTotal() {
            let total = 0;
            for (let i = 0; i < this.localData.length; i++) {
                total += this.localData[i].price * this.localData[i].qunatiy;
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
    //  height: 100vh;
    background: #f8fafc;
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
    background: #f7f8f8;
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
        max-width: 300px;
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
}
</style>
