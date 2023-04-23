<template>
    <NavComponent />

    <section class="container-products-home">

        <div class="home-banner">
            <div id="slogan" class="slogan">
                <h2>Listen <br> <span>better</span></h2>
            </div>
            <div id="vinyle" class="vinyle">
                <img src="/img/home/vinyle.png" alt="Vinyle">
            </div>
        </div>

        <h3>Best Bluetooth headphones 2023</h3>

        <div class="home-products">
            <div class="product"  v-for="product in products" :key="product.id">
                <h4 class="name">{{ product.name }}</h4>
                <img :src="product.image" alt="Headphone">
                <div class="price-add-to-cart">
                    <div class="price">
                        <p>{{ product.price*1 }} €</p>
                    </div>
                    <div :class="product.isAddedToCart ? 'add-to-cart added' : 'add-to-cart'">
                        <button v-on:click="addToCart(product)">Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="go-top" v-on:click="scrollTop()"><img src="/img/top.png" alt="Icon Arrow"></div>
    <FooterComponent/>
</template>

<script>
import NavComponent from './NavComponent.vue';
import FooterComponent from './FooterComponent.vue';

export default {
    components: {
        NavComponent,
        FooterComponent
    },

    data() {
        return {
            products: [],
            cart: [], 
        }
    },

    methods: {
        getProducts() {
            axios.get('/api/products')
                .then(response => this.products = response.data)
                .catch(err => console.log(err));
        },

        addToCart($product) {
            let isInCart = false;

            // Vérification de la présence du produit dans le panier
            for (let index = 0; index < this.cart.length; index++) {
                if (this.cart[index].id === $product.id) {
                    //Si il est présent on augment la quantité
                    this.cart[index].quantity++;
                    isInCart = true;
                }
            }

            // Si il n'y est pas, initialisation de la quantité a 1
            if (!isInCart) {
                $product.quantity = 1;
                this.cart.push($product);
            }

            // Puis enregistremement du panier dans le localStorage
            localStorage.myCart = JSON.stringify(this.cart);
            // Emission du nombre de produit dans le panier
            this.emitter.emit("numberProductsInCart", this.cart.length);
            
            $product.isAddedToCart = true;
        },

        scrollTop() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        }
    },

    mounted() {
        // Récupération de tous les produits
        this.getProducts();

        // Si il y a un panier enregistré, récupération
        if (localStorage.myCart) {
            this.cart = JSON.parse(localStorage.myCart)
        }

        const slogan = document.getElementById("slogan");
        const vinyle = document.getElementById("vinyle");

        // Permet l'effet d'apparition progressive
        setTimeout(() => {
            slogan.style.opacity = 1;
        }, 1000);

        setTimeout(() => {
            vinyle.style.opacity = 1;
        }, 1700)
    }
}
</script>

<style lang="css">
.container-products-home {
    min-height: 100vh;
    padding: 15px 50px;
}

.home-banner {
    width: 100%;
    height: calc(100vh - 86px);
    background: url("/img/home/pink-banner.jpg");
    background-size: cover;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 5%;
} 

.home-banner .slogan {
    font-size: 4.5vw;
    text-transform: uppercase;
    color: white;
    letter-spacing: 10px;
    opacity: 0;
    transition: opacity 1s;
}

.home-banner .slogan span{
    font-size: 4vw;
}

.home-banner .vinyle {
    opacity: 0;
    transition: opacity 2s;
}

.home-banner .vinyle img {
    width: 25vw;
    border-radius: 50%;
    animation: rotating 30s linear infinite; ;
}

@keyframes rotating {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

.home-banner .vinyle img:hover {
    animation-play-state: paused;
}

.container-products-home h3 {
    margin-top: 100px;
    margin-bottom: 50px;
}

.home-products {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.home-products .product {
    width: 23%;
    min-width: 230px;
    aspect-ratio: 1;
    border-radius: 20px;
    background-color: rgb(61, 61, 61);
    padding: 10px;
    text-align: center;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    cursor: pointer;
    transition: margin-top .3s, 
                background-color .3s,
                box-shadow .3s;
}

.home-products .product:hover {
    margin-top: -10px;
    background-color: rgba(61, 61, 61, 0.863);
    box-shadow: 0px 10px 15px 0px rgba(0,0,0,0.63);

}

.home-products .product img {
    width: 60%;
    margin: auto;
    transition: transform .3s;
}

.home-products .product:hover img {
    transform: scale(1.1);
}

.home-products .product .price-add-to-cart {
    display: flex;
    align-items: center;
    gap: 20px;
}

.home-products .product .price-add-to-cart .price {
    font-size: 1.5vw;
    font-weight: bold;
    width: 30%;
}
.home-products .product .price-add-to-cart .add-to-cart {
    width: 70%;
}

.home-products .product .price-add-to-cart button {
    width: 100%;
    height: 100%;
    color: white;
    background-color: transparent;
    border: none;
    text-transform: uppercase;
    border: 2px solid white;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color .2s;
    padding: 10px 0;
}

.home-products .product .price-add-to-cart button:hover {
    background-color: white;
    color: black;
}

.home-products .product .added button {
    pointer-events: none;
    background-color: white;
    border: 2px solid #00606E;
    color: #00606E;
    opacity: .6;
}

.home-products .product .added button:after {
    content: " ";
    position: absolute;
    width: 5px;
    height: 10px;
    border-right: 3px solid #00606E;
    border-bottom: 3px solid #00606E;
    margin-left: 15px;
    transform: rotate(45deg);
    opacity: 0;
    transition: .3;
}

.home-products .product .price-add-to-cart .added button:after {
    opacity: 1;
}

#go-top {
    width: 30px;
    height: 30px;
    position: fixed;
    bottom: 15px;
    right: 15px;
    border-radius: 50%;
    background-color: #fff;
    transition: background-color .3s;
    cursor: pointer;
}

#go-top:hover {
    background-color: #c5a11144;
}

#go-top img {
    width: 100%;
}
</style>