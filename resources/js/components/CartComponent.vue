<template>
    <NavComponent/>
    <section class="container-cart" v-if="products.length != 0">
        <div class="left">
            <h1 class="cart-title-part">Cart</h1>
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
                            <p>{{ product.price*1 }} €</p>
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
            <div class="delivery-choice">
                <h3 class="title">Delivery</h3>
                <div class="choice">
                    <label for="free">
                        <input type="radio" name="free" id="free" :value="0" v-model="delivery">
                        Free
                    </label>
                    <label for="fast">
                        <input type="radio" name="fast" id="fast" :value="13.80" v-model="delivery" >
                        Fast delivery : 13,80 €
                    </label>
                </div>
            </div>
            <div class="divider"></div>
            <div class="coupon-code">
                <h3 class="title">Coupon code</h3>
                <div class="input-button">
                    <input type="text" placeholder="Enter your code">
                    <button><div class="checkmark"></div></button>
                </div>
            </div>
            <div class="divider"></div>
            <div class="subtotal">
                <div class="label-price">
                    <div class="subtotal-shipping">Delivery</div>
                    <div class="subtotal-shipping-price">{{ delivery === 0 ? "Free" : delivery.toFixed(2)+ "€" }}</div>
                </div>
                <div class="label-price">
                    <div class="subtotal-total">Subtotal</div>
                    <div class="subtotal-total-price"><b>{{ (delivery + subtotal).toFixed(2) }}€</b></div>
                </div>
            </div>
            <div class="divider"></div>
            <button class="proceed-to-checkout">Proceed to checkout</button>
        </div>
    </section>
    <div v-else class="empty-cart">
        <p>There are no products in your cart ...</p>
    </div>
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
            products: [],
            delivery: 0
        }
    },

    methods: {
		deleteProducts($product) {
            // Suppression du produit dans le tableau
			this.products.splice(this.products.indexOf($product), 1);
            // Enregistrement du nouveau tableau dans le localStorage
            localStorage.myCart = JSON.stringify(this.products);
            // Emmission du nouveau nombre de produits dans le panier
            this.emitter.emit("numberProductsInCart", this.products.length);

            // Enregistrement en DB de la suppression
            axios.post("/api/removed_products", { 
                product_id : $product.id
            })
            .then(res => console.log(res))
            .catch(err => console.log(err));
		},
	},

    computed : {
        // Retourne le prix total de tous les produits du panier * quantité
        subtotal() {
            let total = 0;

            for (let index = 0; index < this.products.length; index++) {
               total += parseFloat(this.products[index].price * this.products[index].quantity);                
            }

            return total;
        }
    },

    mounted() {
        // Récupération du panier dans le localStorage
        if(localStorage.myCart) {
            this.products = JSON.parse(localStorage.myCart)
        }
	}
}
</script>

<style lang="css">
.container-cart {
    width: 100%;
    padding: 0 50px 50px;
    display: flex;
    align-items: baseline;
    gap: 50px;
    margin-top: 50px;
}

.left {
    width: 70%;
    background-color: #F5F4F7;
    border-radius: 20px;
    padding: 15px 30px;
}

.product-cart {
    margin: 20px 0;
    padding: 20px 0;
    display: flex;
}

.product-cart:not(:last-child) {
    border-bottom: 1px solid rgba(184, 183, 183, 0.447);
}

.product-cart:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
}

.product-cart .image {
    height: 80px;
}

.product-cart .image img{
    width: 80px;
    border-radius: 20px;
}

.product-cart .informations {
    padding-left: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    flex: 1;
}

.product-cart .informations .price {
    color: #00606E;
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
    color: #00606E
}

.product-cart .delete {
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: color .3s;
}

.product-cart .delete:hover {
   color: rgba(255, 0, 0, 0.719);
}

.product-cart .delete img {
    width: 25px;
    height: 25px;
    margin-right: 10px;
}

.product-cart .name h4{
    color: grey;
    font-weight: normal;
}

.right {
    width: 30%;
    border-radius: 20px;
    background-color: #F5F4F7;
    padding: 15px 30px;
    position: sticky;
    top: 20px;
}

.delivery-choice .choice {
    display: flex;
    flex-direction: column;
    margin-top: 15px;
}

.delivery-choice label {
    cursor: pointer;
}
.delivery-choice label:not(:first-child) {
    margin-top: 10px;
}

.delivery-choice label input {
    accent-color: #00606E;
}

.right .divider {
    width: 100%;
    border-bottom: 1px solid rgba(184, 183, 183, 0.447);
    margin: 20px 0;
}

.input-button {
    display: flex;
    padding-top: 20px;
}

.coupon-code input {
    flex: 1;
    border: 1px solid #C5A011;
    border-right: none;
    padding: 10px;
    outline: none;
}

.coupon-code button {
    width: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: none;
    background-color: #fff;
    padding-right: 15px;
    border: 1px solid #C5A011;
    border-left: none;
    cursor: pointer;
}

.coupon-code button .checkmark {
    width: 10px;
    height: 15px;
    border-right: 3px solid #00606E;
    border-bottom: 3px solid #00606E;
    transform: rotate(45deg);
}

.label-price {
    display: flex;
    justify-content: space-between;
}

.label-price:not(:first-child) {
    margin-top: 10px;
}

.label-price b {
    color: #00606E;
}

.proceed-to-checkout {
    width: 100%;
    padding: 15px;
    text-transform: uppercase;
    font-weight: bold;
    border: 1px solid #C5A011;
    color: black;
    cursor: pointer;
    position: relative;
    background-color: transparent;
    transition: color .3s;
}

.proceed-to-checkout:hover {
    color: #C5A011;
}

.proceed-to-checkout:before {
  content: "";
  display: block;
  transform: scaleX(0);
  transform-origin: bottom right;
  background-color: #c5a11144;
  position: absolute;
  top: 0; right: 0; bottom: 0; left: 0;
  transition: transform .5s;
}

.proceed-to-checkout:hover::before {
  transform: scaleX(1);
  transform-origin: bottom left;
}

.empty-cart {
    width: fit-content;
    margin: auto;
    margin-top: 50px;
    padding: 15px 100px;
    border-radius: 20px;
    text-align: center;
    background-color: #F5F4F7;
}

.empty-cart p {
    font-style: italic;
    color: grey;
}
</style>