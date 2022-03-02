<template>
    <div class="py-3">
		<div class="container">
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
        </div>
    </div>
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
figure {
    max-height: 300px;
    img {
        width: 100%;
        object-fit: cover;
    }
}
.restaurant {
    list-style: none;
    .restaurant-card {
        padding: 15px 25px;
        margin-bottom: 20px;
        box-shadow: rgba(60, 64, 67, 0.178) 0px 1px 2px 0px,
            rgba(60, 64, 67, 0.082) 0px 1px 3px 1px;
            &:hover {
                box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            }
    }
}
</style>
