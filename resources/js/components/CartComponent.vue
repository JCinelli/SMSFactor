<template>
    <NavComponent/>
    <section class="container-cart">
        <div class="left">
            <h1>Cart</h1>
            <div class="products-in-cart" >
                <div class="product-cart" v-for="product in products" :key="product.id">
                    <div class="image">
                        <img :src="product.image" alt="Headphone">
                    </div>
                    <div class="informations">
                        <div class="name">
                            <h4>{{ product.name }}</h4>
                        </div>
                        <div class="price">
                            <p>{{ product.price }} €</p>
                        </div>
                        <div class="quantity">
                            <p>Quantity : {{ product.quantity }}</p>
                        </div>
                    </div>
                    <div class="total-action">
                        <div class="total">
                            <p>{{ (product.price * product.quantity ).toFixed(2)}} €</p>
                        </div>
                        <div class="delete" v-on:click="deleteProducts(product)">
                            <img src="/img/delete.png" alt="Delete Icon">
                            <p>Delete</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right">
        </div>
    </section>
</template>

<script>
import axios from 'axios';
import NavComponent from './NavComponent.vue';
export default {
    components:{
        NavComponent
    },
    data() {
        return {
            products: []
        }
    },
    methods: {

		deleteProducts($product) {

			this.products.splice(this.products.indexOf($product), 1);
            localStorage.myCart = JSON.stringify(this.products);
            this.emitter.emit("number", this.products.length);

            axios.post("/api/removed_products", { 
                product_id : $product.id
            })
            .then(
                res => console.log(res)
            ).catch(
                err => console.log(err)
            );

		},

	},
    mounted() {

        if(localStorage.myCart) {
            this.products = JSON.parse(localStorage.myCart)
        }
	}
}
</script>

<style lang="css">
.container-cart{
    width: 100%;
    padding: 0 50px 50px;
    display: flex;
    gap: 50px;
}

.left {
    width: 60%;
    background-color: rgb(240, 240, 240);
    border-radius: 20px;
    padding: 15px 30px;
}

.product-cart {
    margin: 20px 0;
    padding: 20px 0;
    display: flex;
}

.product-cart:not(:last-child) {
    border-bottom: 1px solid rgb(184, 183, 183);
}

.product-cart:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
}

.product-cart .image {
    height: 100px;
}

.product-cart .image img{
    width: 100px;
    border-radius: 20px;
}

.product-cart .informations {
    padding-left: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    flex: 1;
}

.product-cart .total-action {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: right;
}

.product-cart .total p{
    font-weight: bold;
    font-size: 1.2rem;
}

.product-cart .delete {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.product-cart .delete img {
    width: 30px;
    margin-right: 10px;
}

.product-cart .name h4{
    color: grey;
    font-weight: normal;
    font-size: 1.2rem;
}

.right {
    width: 40%;
    border-radius: 20px;
    background-color: rgb(240, 240, 240);
    padding:15px 30px
}
</style>