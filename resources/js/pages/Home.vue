<template>
    <section>
        <!-- Banner -->
        <div class="homeBanner">
            <img
                class="img-fluid"
                src="https://www.harvester.co.uk/content/dam/harvester/images/2020/takeaway/deliveroo-page-banner.jpg.asset/1603367871424.jpg"
                alt="banner-img"
            />
        </div>

        <!-- restaurant list -->
        <section class="RestaurantListContainer container-fluid">
            <div class="row justify-content-between rslc">
                <!-- sezione categorie sinistra -->

                <div class="CategoryListContainer col-lg-2 col-md-12">
                    <!-- visibile -->
                    <ul class="categoryList categoryNoHamb px-2">
                        <li class=" mt-2 mx-2 CategoryTitle">
                            CATEGORIE
                        </li>
								<li class="mt-2 mx-2" >
									<button @click="clear()" class=" category-clear category w-100">
                              Cancella Filtri <span class="category__count"><i class="fas fa-trash-alt"></i></span>
                           </button>
								</li>
                        <li class="mt-2 mx-2" v-for="(category, index) in categories" :key="`category-${category.slug}`">
                            <!-- <router-link class="category" :to="{ name: 'advanced-search', params: {slug: category.slug }}">
                                {{category.name}}
                            </router-link> -->
                            <button  class="category w-100" @click="getFilteredRestaurants(category.slug, category.id,index) ">
                                {{category.name}} <span class="category__count">{{category.users.length}}</span>
                            </button>
                        </li>
                    </ul>

                    <!-- hamburgher -->
                    <div class="Hamb-Bottom mx-3">
                        <span class="CategoryTitle mx-1">CATEGORIE:</span>
                        <span
                            class="burger-wraper-togle"
                            @click="openModal = !openModal"
                        >
                            <span
                                :class="{
                                    'burger__top-open': openModal,
                                    'burger__top-close': !openModal,
                                }"
                            ></span>
                            <span
                                :class="{
                                    'burger__midle-open': openModal,
                                    'burger__midle-close': !openModal,
                                }"
                            ></span>
                            <span
                                :class="{
                                    'burger__bottom-open': openModal,
                                    'burger__bottom-close': !openModal,
                                }"
                            ></span>
                        </span>
                    </div>

                    <div class="hamburger-menu " :class="{ active: openModal }">
                        <ul class="categoryList">
									<li class="mt-2 mx-2" >
										<button @click="clear()" class=" category-clear category w-100">
											Cancella Filtri <span class="category__count"><i class="fas fa-trash-alt"></i></span>
										</button>
									</li>
									<li class="mt-2 mx-2" v-for="(category, index) in categories" :key="`category-${category.slug}`">
										<!-- <router-link class="category" :to="{ name: 'advanced-search', params: {slug: category.slug }}">
											{{category.name}}
										</router-link> -->
										<button  class="category w-100" @click="getFilteredRestaurants(category.slug, category.id,index) ">
											{{category.name}} <span class="category__count">{{category.users.length}}</span>
										</button>
									</li>
                        </ul>
                    </div>
                </div>

                <!-- sezione ristorante destra -->
                <div class="RestaurantSection col-lg-10 col-md-12 px-2">
                    <!-- top -->
                    <div class="topContainer container-fluid">
                        <div class="row align-items-center">
                            <!-- title -->
                            <div class="Title col-sm-12 col-md-6">
                                I nostri Ristoranti
                            </div>
                            <!-- searchbar -->
                            <!-- <div class="SearchBar col-sm-12 col-md-6 my-2">
                                
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
                            </div> -->
                        </div>
                    </div>

                    <!-- bottom -->
                    <div class="restaurantList container-fluid ">
							  <!-- <span class="restaurant-list-warn">
								  {{text}}
							  </span> -->
                        <ul  v-if="restaurants">
                            <!-- restaurant list -->
                        <div class="row" v-if="tempArrayRestaurant.length == 0 ">
								   <li class="Cards-Rest col-sm-6 col-md-4 " v-for="bestRestaurant in bestRestaurants" :key="`restaurant-${bestRestaurant.id}`">
										  <router-link class="Cards-Link-container" :to="{ name: 'restaurant-menu', params: {slug: bestRestaurant.slug, id: bestRestaurant.id}}">
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
                                        <div class="card-details pt-3 pl-3 pr-3 pb-1 mx-2">
                                            <!-- restauran-name -->
                                            <h5>{{bestRestaurant.restaurant_name}}</h5>
                                            <div>
                                                <div class="card-City">{{bestRestaurant.city}}</div>
                                                <div>{{bestRestaurant.address}}</div>															                                            
                                            </div>
														  	<div class="mt-2">
																<span v-for="(categoriy,index) in bestRestaurant.categories" :key="`cate-${index}`">| {{categoriy.name }} | </span>
															</div>
                                        </div>


                                    </div>
                                </router-link>   
                            </li>
								</div> 
								<div class="row" v-else>
                            <li class="Cards-Rest col-sm-6 col-md-4 my-3" v-for="bestRestaurant in tempArrayRestaurant" :key="`restaurant-${bestRestaurant.id}`">
										  <router-link class="Cards-Link-container" :to="{ name: 'restaurant-menu', params: {slug: bestRestaurant.slug, id: bestRestaurant.id}}">
                                    <!-- card -->
                                    <div class="Card">
                                        <!-- image -->
                                        <figure
                                            class="img-cont"
                                            v-if="bestRestaurant.image"
                                        >
                                            <img
                                                class="img-fluid"
                                                :src="bestRestaurant.image"
                                                :alt="
                                                    bestRestaurant.restaurant_name
                                                "
                                            />
                                        </figure>
                                        <figure class="img-cont" v-else>
                                            <img
                                                src="https://www.nafservizi.it/wp-content/uploads/2020/10/default_image_01.png"
                                                :alt="
                                                    bestRestaurant.restaurant_name
                                                "
                                            />
                                        </figure>

                                        <!-- dati ristorante -->
                                        <div class="card-details p-3 mx-2">
                                            <!-- restauran-name -->
                                            <h5>
                                                {{
                                                    bestRestaurant.restaurant_name
                                                }}
                                            </h5>
                                            <div>
                                                <div class="card-City">
                                                    {{ bestRestaurant.city }}
                                                </div>
                                                <div>
                                                    {{ bestRestaurant.address }}
                                                </div>
                                            </div>
														  	<div class="mt-2">
																<span v-for="(categoriy,index) in bestRestaurant.categories" :key="`cate-${index}`">| {{categoriy.name }} | </span>
															</div>
                                        </div>
                                    </div>
                                </router-link>
                            </li>
								</div>

									 
                        </ul>
								
                        <div v-else>
                            <h4 class="d-flex align-items-start">Loading restaurants <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></h4>
                        </div>

                        <!-- paginazione bottoni -->
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>

<script>
import axios from "axios";

export default {
    name: "Home",

    components: {},

    data() {
      return {
          bestRestaurants: null,
			 tempArrayRestaurant:[],
          categories: null,
			 text:null,
			 openModal:false,
			 prova:[]

      }
    },

    computed: {
        restaurants() {
            return this.bestRestaurants;
        },
    },

    created() {
        this.getBestRestaurants();
        this.getCategoryRestaurant();
    },

    methods: {
		 clear(){
			this.tempArrayRestaurant = []
			this.prova = []
			const btns = document.querySelectorAll('.category')
			btns.forEach(element => {
			element.classList.remove("active")	
			});
			this.text = ''
		 },

        getBestRestaurants(page = 1){
            //chiamata axios
            axios
                .get(`http://127.0.0.1:8000/api/bestRestaurants?page=${page}`)
                .then((res) => {
                    console.log(res.data);

                    // senza impaginazione
                    //  this.bestRestaurants = res.data;

                    // con impaginazione
                    this.bestRestaurants = res.data.data;
                    this.pagination = {
                        current: res.data.current_page,
                        last: res.data.last_page,
                    };
                })
                .catch((err) => log.error(err));
        },

        getFilteredRestaurants(categorySlug, id, index) {
			//   console.log(categorySlug,'__________________testCategory________');
			// const triger = this.tempArrayRestaurant.some(person => person.pivot.category_id !== id)
			// if(triger){
            // axios.get(`http://127.0.0.1:8000/api/restaurants/${categorySlug}`)
            //     .then(res => {
						 
						 // senza impaginazione
                    //  this.bestRestaurants = res.data;

                    // con impaginazione
						const caz = this.bestRestaurants;
						//  this.tempArrayRestaurant.concat(test)
						console.log( caz ,'TEST LAST');
						caz.forEach(element => {
							// element.filter(e => e.slug == categorySlug)
							if (element.categories.filter(e => e.slug == categorySlug).length > 0) {
								this.prova.push(element)
							}
							console.log(this.prova);					
						});
						// if(test.length == 0){
							// 	this.text = 'Non ci sono ristoranti per questa categoria😢'
						// }else{
							// 	this.text = ''
						const test =  this.prova;
						// }
						const btns = document.querySelectorAll('.category')
						btns[index + 1].classList.add("active")
				
						console.log(id,"ID");
						for (let i = 0; i < test.length; i++) {
							let axiosObject = test[i]
							
							if (!this.tempArrayRestaurant.filter(e => e.id === axiosObject.id).length > 0) {
								this.tempArrayRestaurant.push(axiosObject)
							}
				
							

						
						}



						//  console.log(test,'-----------------------------------------bestRestdddddddddaurants');
					

						//  test.forEach(element => {
						// 	if(this.tempArrayRestaurant.filter((e) => e.id === element.id).length > 0 ){
								
						// 		console.log(element, 'ELEMENT');
								
									
						// 		const newArray = this.tempArrayRestaurant.filter(item => item.pivot.category_id !== element.pivot.category_id)
						// 		this.tempArrayRestaurant = newArray
						// 		console.log(this.tempArrayRestaurant);
						// 		// if(this.tempArrayRestaurant.filter((e) => e.pivot.category_id === element.pivot.category_id).length == 0 ){
						// 		// 	this.tempArrayRestaurant.unshift(element)

						// 		// }
						// 	}else{
						// 		// if(!tempArrayRestaurant.includes(element)){
						// 			this.tempArrayRestaurant.unshift(element)
						// 		// }

						// 	}
						//  });

						 
						//  this.tempArrayRestaurant.filter((e) => e.slug !== test.slug) ;

						//   if(res.data[0].users.length == 0){
						// 	  	this.text = 'Non ci sono ristoranti per questa categoria😢'
						//   }else{
						// 	  this.text = ''
						//   }
                  //   console.log(this.bestRestaurants)
                    /* this.pagination = {
                       current: res.data.current_page,
                       last: res.data.last_page
                    }; */
               //  })
               //  .catch(err => log.error(err));
      //   }else{
		// 	  console.log('ERROR');
		//   }
		},

        getCategoryRestaurant(){
            //chiamata axios
            axios
                .get(`http://127.0.0.1:8000/api/category`)
                .then((res) => {
                    console.log(res.data);

                    // senza impaginazione
                    this.categories = res.data;
                })
                .catch((err) => log.error(err));
        },
    },
};
</script>

<style lang="scss" scoped>
.categoriy-clear{
	background: red;
}
ul {
    li {
        list-style: none;

        a {
            color: black;
            text-decoration: none;
        }
    }
}
.homeBanner {
    img {
        width: 100%;
    }
}

.RestaurantListContainer {
    min-height: 1080px;
    width: 100%;

    .rslc {
        min-height: 1080px;
    }
    // left
    .CategoryListContainer {
        overflow-y: auto;
        margin-top: 28px;

        .categoryList {
            // margin-top: 17px;
				min-width: 185px;

            .CategoryTitle {
                margin-bottom: 30px;
                font-weight: 900;
                font-size: 18px;
            }
				 .category.category-clear{
					 &:hover{
					 background:#b854542d;
					 border: 1px solid rgba(255, 0, 0, 0.265);
					 }
					&:hover span{
					 color: rgb(61, 4, 4);
					 }
				}
            .category {
                font-size: 13px;
                text-transform: uppercase;
                transition: 0.3s;
					 border:  none;
					 background: transparent;
					 padding: 8px 35px 8px 10px;
					 transition: all linear 0.1s;
					 position: relative;
					//  display: flex;
					//  align-items: center;
					//  justify-content: start;
					text-align: start;
					 background:#54b8b01c;
					 border-radius: 6px;
					 border: 1px solid #264f4f00;




					 &__count{
						 background: #54aca52b;
						 position: absolute;
						 right: 5px;
						 border-radius: 100%;
						 width: 25px;
						 height: 25px;
						 line-height: 25px;
						 text-align: center;
						 border: 1px solid #1b45453d;
						 transform: translatey(-3px);

						 
					 }
                &:hover{
                    color: #011e1c;
					 background:#439d9640;

                }
            }
				 .active{
						 background: #48989152;
						 border-radius: 6px;
						 border: 1px solid #264f4f72;
						 
					 }

        }
    }

    // right
    .RestaurantSection {
        padding-right: 60px;
        // top
        .topContainer {
       	 margin-top: 23px;
            .Title {
                font-size: 1.9rem;
                font-weight: bold;
					 margin-bottom: 26px;
            }

            .SearchBar {
                text-align: end;

                .searchForm {
                    .Search {
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
        .restaurantList {
            .Cards-Rest {
                min-height: 400px;
					 margin-bottom: 25px;

                .Cards-Link-container {
                    width: 100%;
                    height: 100%;
                    color: black;
                    text-decoration: none;
                    background-color: white;
                    display: inline-block;
						  transition: all linear 0.2s;
                    box-shadow: rgba(45, 47, 49, 0.178) 0px 1px 2px 0px,
                        rgba(43, 46, 48, 0.082) 0px 1px 3px 1px;
                    &:hover {
                        box-shadow: rgba(0, 0, 0, 0.24) 0px 4px 10px;
                    }

                    .Card {
                        width: 100%;

                        .img-cont {
                            width: 100%;
                            height: 230px;

                            img {
                                width: 100%;
                                height: 100%;
                                object-fit: cover;
                            }
                        }

                        .card-details {
                            color: rgb(109, 109, 109);
                            h5 {
                                font-size: 23px;
                                font-weight: bolder;
                            }

                            .card-City {
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
.restaurant-list-warn {
    font-size: 20px;
    text-align: center;
    font-weight: 700;
    display: inline-block;
}
.hamburger-menu {
    display: none;
}

.Hamb-Bottom {
    display: none;
    text-decoration: none;
}

@media screen and (max-width: 991px) {
    .categoryNoHamb {
        display: none;
    }
    .Hamb-Bottom {
        display: block;
        line-height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: black;
        font-size: bolder;
        font-size: 20px;
        background-color: rgba(214, 214, 214, 0.604);
        padding: 0 15px;
        margin: 0 !important;
        position: relative;
        i {
            background-color: #99999983;
            padding: 10px;
            border-radius: 25px;
        }
    }

    .hamburger-menu.active {
        display: block;
    }
    .hamburger-menu {
        ul {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            background: #e3e4e4b4;
            margin: 0 !important;
            padding: 5px 5px;
        }
    }

    .Title {
        text-align: center;
    }

    .searchForm {
        text-align: center;
    }
    .burger-wraper-togle {
        border: 1px solid #bdbabaa6;
        border-radius: 5px;
        display: inline-block;
        position: relative;
        width: 40px;
        height: 40px;
        transition: linear 0.2s;
        cursor: pointer;
        &:hover {
            background: rgba(255, 255, 255, 0.432);
        }
        span {
            background: #7f7f7f;
            width: 30px;
            height: 4px;
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            border-radius: 2px;
            transform: translate(-50%, -50%);
            &:first-child {
                top: 25%;
            }
            &:last-child {
                top: 74%;
            }
        }
    }
}

.burger__top-close {
    animation: burger_top-close 0.4s forwards;
}
.burger__midle-close {
    animation: burger_midle-close 0.2s forwards;
}
.burger__bottom-close {
    animation: burger_bottom-close 0.4s forwards;
}
.burger__top-open {
    animation: burger_top 0.4s forwards;
}
.burger__midle-open {
    animation: burger_midle 0.4s forwards;
}

.burger__bottom-open {
    animation: burger_bottom 0.4s forwards;
}

@keyframes burger_top {
    0% {
        top: 25%;
        transform-origin: center;
    }
    100% {
        top: 14%;
        left: 9px;
        transform-origin: left;
        transform: rotate(49deg);
    }
}

@keyframes burger_midle {
    0% {
        opacity: 100;
    }
    100% {
        opacity: 0;
    }
}
@keyframes burger_bottom {
    0% {
        top: 74%;
    }
    100% {
        transform: rotate(-49deg);
        left: 3px;
        top: 45%;
    }
}

@keyframes burger_top-close {
    0% {
        top: 14%;
        left: 9px;
        transform-origin: left;
        transform: rotate(49deg);
    }
    100% {
        top: 25%;
    }
}
@keyframes burger_bottom-close {
    0% {
        transform: rotate(-49deg);
        left: 3px;
        top: 45%;
    }
    100% {
        top: 74%;
    }
}

@keyframes burger_midle-close {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 100;
    }
}



.lds-ellipsis {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-ellipsis div {
  position: absolute;
  top: 13px;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: rgba(0, 0, 0, 0.598);
  animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.lds-ellipsis div:nth-child(1) {
  left: 13px;
  animation: lds-ellipsis1 0.6s infinite;
}
.lds-ellipsis div:nth-child(2) {
  left: 4px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(3) {
  left: 16px;
  animation: lds-ellipsis2 0.6s infinite;
}
.lds-ellipsis div:nth-child(4) {
  left: 28px;
  animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
  0% {
    transform: scale(0);
  }
  100% {
    transform: scale(1);
  }
}
@keyframes lds-ellipsis3 {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
@keyframes lds-ellipsis2 {
  0% {
    transform: translate(0, 0);
  }
  100% {
    transform: translate(24px, 0);
  }
}
</style>
