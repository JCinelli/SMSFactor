<template>
    <NavComponent/>

    <section class="container-products-home">
        <div v-for="product in products" :key="product.id" class="product-card">
            <div class="product-img">
                <img :src="product.image" alt="Headphone">
            </div>
            <div class="product-name">
                <p>{{ product.name }}</p>
            </div>
            <div class="product-description">
                <p>{{ product.description }}</p>
            </div>
            <div class="product-price">
                <p>{{ (product.price*1).toFixed(2) }} €</p>
            </div>
            <div class="add-to-cart">
                <button v-on:click="addToCart(product)">Add to cart</button>
            </div>
        </div>
    </section>

</template>

<script>
import NavComponent from './NavComponent.vue';
export default {
    components:{
        NavComponent
    },
    data() {
        return {
            products: [],
            cart : []
        }
    },
    methods: {
		getProducts() {
			axios.get('/api/products')
				.then(response => this.products = response.data)
		},
        addToCart($product) {
            let isInCart = false;

            for (let index = 0; index < this.cart.length; index++) {
                if (this.cart[index].id === $product.id) {
                    this.cart[index].quantity++;
                    isInCart = true;
                }
            } 

            if (!isInCart) {
                $product.quantity = 1;
                this.cart.push($product);
            }

            localStorage.myCart = JSON.stringify(this.cart);
            this.emitter.emit("number", this.cart.length);
        }
	},
	mounted() {
		this.getProducts();

        if(localStorage.myCart) {
            this.cart = JSON.parse(localStorage.myCart)
        }
	}
}
</script>

<style lang="css">

.container-products-home {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 50px;
}

.container-products-home .product-card {
    border-radius: 20px;
    overflow: hidden;
    padding: 15px;
    text-align: center;
    width: 20%;
}

.container-products-home .product-img img{
    border: 5px solid #f0f0f0;
    width: 100%;
    margin-bottom: 15px;
    border-radius: 20px;
    transition: 0.3s;
}

.container-products-home .product-img img:hover{
   transform: scale(1.05);
}

.container-products-home .product-name {
    text-transform: uppercase;
    font-weight: bold;
    font-style: italic;
    font-size: 1.5rem;
    margin-bottom: 15px;
}

.container-products-home .product-description {
    color: grey;
    font-style: italic;
    margin-bottom: 15px;
}

.container-products-home .product-price {
    font-size: 1.5rem;
    text-align: center;
    font-weight: bold;
    letter-spacing: 3px;
    margin-bottom: 15px;
}

.container-products-home .add-to-cart button{
    color: white;
    text-transform: uppercase;
    font-weight: bold;
    font-style: italic;
    background-image: linear-gradient(to right top, #0e69da, #0177e3, #0084eb, #0f91f2, #219ef9);
    border: none;
    padding: 10px 30px;
    cursor: pointer;
}
</style>