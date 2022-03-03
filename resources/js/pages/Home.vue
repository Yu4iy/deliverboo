<template>
     
    <section>
  
        <!-- Banner -->
        <div class="homeBanner">
            <img class="img-fluid" src="https://www.harvester.co.uk/content/dam/harvester/images/2020/takeaway/deliveroo-page-banner.jpg.asset/1603367871424.jpg" alt="banner-img">
        </div>

        <!-- restaurant list -->
        <section class="RestaurantListContainer container-fluid my-3 py-3">
            <div class="row justify-content-between rslc">
                <!-- sezione categorie sinistra -->
                
                <div class="CategoryListContainer col-lg-2 col-md-12">
                    <!-- visibile -->

                    <ul class="categoryList categoryNoHamb px-4">
                        <li class="CategoryTitle">
                            CATEGORIE
                        </li>
                        <li class="mt-2 mx-2" v-for="category in categories" :key="`category-${category.slug}`">
                            <!-- <router-link class="category" :to="{ name: 'advanced-search', params: {slug: category.slug }}">
                                {{category.name}}
                            </router-link> -->
                            <button class="category" @click="getFilteredRestaurants(category.slug)">
                                {{category.name}}
                            </button>
                        </li>
                    </ul>
                    

                    <!-- hamburgher -->
                    <a class="Hamb-Bottom mx-3 " href="#">
                        <span class="CategoryTitle mx-1">CATEGORIE:</span>
                        <i class="fa-solid fa-bars"></i>
                    </a>

                    <div class="hamburger-menu">
                        <ul class="categoryList  px-4">
                            <li class="mt-2 mx-2" v-for="category in categories" :key="`category-${category.slug}`">
                                <router-link @click="control()" class="category" :to="{ name: 'advanced-search', params: {slug: category.slug }}">
                                    {{category.name}}
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- sezione ristorante destra -->
                <div class="RestaurantSection col-lg-10 col-md-12 px-4">
                    <!-- top -->
                    <div class="topContainer container-fluid mt-5">
                        <div class="row  align-items-center">
                            <!-- title -->
                            <div class="Title col-sm-12 col-md-6 py-1 my-2">I nostri Ristoranti</div>
                            <!-- searchbar -->
                            <div class="SearchBar col-sm-12 col-md-6 my-2">
                                <!-- search bar -->
                                <form class="searchForm">
                                    
                                    <input
                                        class="SearchBar Search"
                                        id="search"
                                        type="text"
                                        placeholder="Cerca il ristorante che preferisci"
                                        required
                                    />
                                    <input
                                        class="SearchBar"
                                        id="submit"
                                        type="submit"
                                        value="Search"
                                    />
                                 </form>
                            </div>

                        </div>
                        
                    </div>

                    <!-- bottom -->
                    <div class="restaurantList container-fluid mt-5 px-5">
							  <span class="restaurant-list-warn">
								  {{text}}
							  </span>
                        <ul class="row" v-if="restaurants">
                            <!-- restaurant list -->
                            
                            <li class="Cards-Rest col-sm-6 col-md-4 my-3" v-for="bestRestaurant in restaurants" :key="`restaurant-${bestRestaurant.id}`">
										  <router-link class="Cards-Link-container" :to="{ name: 'restaurant-menu', params: {slug: bestRestaurant.slug }}">
                                    <!-- card -->
                                    <div class="Card">
                                        <!-- image -->
                                        <figure class="img-cont" v-if="bestRestaurant.image">
                                             <img class="img-fluid" :src="bestRestaurant.image" :alt="bestRestaurant.restaurant_name">
                                         </figure>
                                         <figure class="img-cont" v-else>
                                             <img src="https://www.nafservizi.it/wp-content/uploads/2020/10/default_image_01.png" :alt="bestRestaurant.restaurant_name">
                                         </figure>
                                        

                                        <!-- dati ristorante -->
                                        <div class="card-details p-3 mx-2">
                                            <!-- restauran-name -->
                                            <h5>{{bestRestaurant.restaurant_name}}</h5>
                                            <div>
                                                <div class="card-City">{{bestRestaurant.city}}</div>
                                                <div>{{bestRestaurant.address}}</div>
                                                
                                            </div>
                                        </div>


                                    </div>
                                </router-link>   
                            </li>
                        </ul>
                        <div v-else>
                           <h4>Loading restaurants...</h4>
                        </div>

                        <!-- paginazione bottoni -->
                    </div>
                    
                </div>
            </div>
        </section>
        

    
        
    </section>
</template>

<script>
import axios from 'axios';

export default {
    name: "Home",

    components: {
       
    },

    data() {
      return {
          bestRestaurants: null,
          categories: null,
			 text:null
      }
    },

    computed: {
        restaurants(){
            return this.bestRestaurants;
        }
    },

    created() {
      this.getBestRestaurants();
      this.getCategoryRestaurant();

    },

    methods: {
        getBestRestaurants(page = 1){
            //chiamata axios
            axios.get(`http://127.0.0.1:8000/api/bestRestaurants?page=${page}`)
                .then(res => {
                    console.log(res.data);

                    // senza impaginazione
                    //  this.bestRestaurants = res.data;

                    // con impaginazione
                    this.bestRestaurants = res.data.data;
                    this.pagination = {
                       current: res.data.current_page,
                       last: res.data.last_page
                    };
                })
                .catch(err => log.error(err));
          
        },
        getFilteredRestaurants(categorySlug) {
            axios.get(`http://127.0.0.1:8000/api/restaurants/${categorySlug}`)
                .then(res => {
                    console.log(res.data);

                    // senza impaginazione
                    //  this.bestRestaurants = res.data;

                    // con impaginazione
                    this.bestRestaurants = res.data[0].users;
						  if(res.data[0].users.length == 0){
							  	this.text = 'Non ci sono ristoranti per questa categoria😢'
						  }else{
							  this.text = ''
						  }
                    console.log(this.bestRestaurants)
                    /* this.pagination = {
                       current: res.data.current_page,
                       last: res.data.last_page
                    }; */
                })
                .catch(err => log.error(err));
        },
        getCategoryRestaurant(){
            //chiamata axios
            axios.get(`http://127.0.0.1:8000/api/category`)
                .then(res => {
                    console.log(res.data);

                    // senza impaginazione
                      this.categories = res.data;

                })
                .catch(err => log.error(err));
        },

          
    }    
};

</script>

<style lang="scss" scoped>

ul{
    li{
        list-style: none;

        a{
            color: black;
            text-decoration: none;
        }
    }
}
.homeBanner{
    img{
        width: 100%;
    }
    
}

.RestaurantListContainer{
    min-height: 1080px;
    width: 100%;

    .rslc{
        min-height: 1080px;
    }
    // left
    .CategoryListContainer{
        max-height: 1080px;
        overflow-y: auto;  
        margin-top: 55px;

        .categoryList{
            margin-top: 17px;
           
            .CategoryTitle{
                margin-bottom: 76px;
                font-weight: 900;
                font-size: 18px;
            }

            .category{
                font-size: 16px;
                text-transform: uppercase;
                transition: 0.3s;
					 border:  none;
					 background: transparent;
                &:hover{
                    color: #00ccbc;

                }
            }
        }
    }

    // right
    .RestaurantSection{
        padding-right: 60px;
        // top
        .topContainer{
            .Title{
                font-size: 1.9rem;
                font-weight: bold;
            }

            .SearchBar{
                text-align: end;

                .searchForm{
                    .Search{
                        max-width: 80%;
                        min-width: 60%;
                        text-align: start;
                    }

                    .SearchBar {
                        padding: 7px 10px 7px 10px;
                        color: #636363;
                        border: 1px solid rgb(209, 209, 209);
                        border-radius: 50px;
                    }
                        
                }
            }
        }
        // bottom
        .restaurantList{
            .Cards-Rest{
                min-height: 400px;

                .Cards-Link-container{
                    width: 100%;
                    height: 100%;
                    color: black;
                    text-decoration: none;
                    background-color: white;
                    display: inline-block;
                    box-shadow: rgba(45, 47, 49, 0.178) 0px 1px 2px 0px,
                            rgba(43, 46, 48, 0.082) 0px 1px 3px 1px;
                     &:hover {
                         box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
                     }
                    
                    

                    .Card{
                        width: 100%;
                        

                        .img-cont{
                            width: 100%;
                            height: 230px;
                            
                            img{
                                width: 100%;
                                height: 100%;
                                object-fit: cover;
                            }
                        }

                        .card-details{
                            color: rgb(109, 109, 109);
                            h5{
                                font-size: 23px;
                                font-weight: bolder;
                            }

                            .card-City{
                                font-size: 17px;
                            }
                        }
                        

                    }
                }
            }
        }
    }
}

// .CategoryList{
//     background: red;
// }
// .RestaurantSection{
//     background-color: plum;
// }
// .restaurantList{
//     background-color: pink;
// }

// .RestaurantListContainer{
//     background-color: steelblue;
// }


// hamburger menu
.restaurant-list-warn{
	font-size: 20px;
	text-align: center;
	font-weight: 700;
	display: inline-block;

}
.hamburger-menu {
    position: absolute;
    top: 0;
    left: 0;
    display: none;

}

.Hamb-Bottom{
    display: none;
    text-decoration: none;
}

@media screen and (max-width: 991px)
{
    .categoryNoHamb {
        display: none;
    }
    .Hamb-Bottom {
        display: block;
        height: 100%;
        line-height: 70px;
        text-align: center;
        color: black;
        font-size: bolder;
        font-size: 20px;
        background-color: rgba(214, 214, 214, 0.604);
        i{
            background-color: #99999983;
            padding: 10px;
            border-radius: 25px;
        }
    }

    .hamburger-menu.active {
        display: block;
    }

    .Title{
        text-align: center;
    }

    .searchForm{
        text-align: center;
    }
}


</style>
