<template>
   <section class="container-dashboard-admin">
    <h1 class="title-page">Analytics</h1>
    <div class="products-removed-part">
        <h2 v-if="products.length > 0">Products most often removed from the cart :</h2>
        <h2 v-else>You have not yet created any products in your store</h2>
        <div v-if="products.length > 0" class="products-removed">
            <div class="labels">
                <div class="gap"></div>
                <div class="id-label">Id</div>
                <div class="name-label">Name</div>
                <div class="removed-label">Removed</div>
            </div>
            <div class="product-removed" v-for="product in orderedProducts" :key="product.id">
                <div class="image">
                    <img :src="product.image" alt="Headphone">
                </div>
                <div class="id">
                    <p>{{ product.id }}</p>
                </div>
                <div class="name">
                    <p>{{ product.name }}</p>
                </div>
                <div class="removed">
                    <p><strong>{{ product.count_removed === 0 ? "Never" : product.count_removed }}</strong></p>
                </div>
            </div>
        </div>
    </div>
   </section>
</template>

<script>
export default {
    data() {
        return {
            products : [],
            removedProducts : []
        }
    },
    
    methods: {
		getProducts() {
            axios.get("api/products")
            .then(res => {
                this.products = res.data;
                // Récupération des données de produits supprimés
                this.getRemovedDatas();
            })
            .catch(err => console.log(err));
		},

        getRemovedDatas() {
            axios.get("api/removed_products")
            .then(res => {
                this.removedProducts = res.data;
                // Injection des données de produits supprimés
                this.injectRemovedDatas();
            })
            .catch(err => console.log(err));
		},

        injectRemovedDatas() {
            // Boucle sur tous les produits
            for (let i = 0; i < this.products.length; i++) {
                this.products[i].count_removed = 0;

                //Boucle sur les données de produits supprimés 
                for (let j = 0; j < this.removedProducts.length; j++) {
                    if (this.removedProducts[j].product_id == this.products[i].id) {
                        // Ajout du nombre de fois ou le produit à été supprimé
                        this.products[i].count_removed++; 
                    }
                }
            }
        }
	},

    computed: {
        // Tri les produits pour que le plus supprimé soit en haut de la liste
        orderedProducts: function () {
            return _.orderBy(this.products, 'count_removed', 'desc')
        }
    },

    mounted() {
        this.getProducts();
	}
}
</script>

<style lang="css">

.title-page {
    padding-left: 30px;
    margin-bottom: 50px;
}

.container-dashboard-admin {
    width: 100%;
    padding: 50px 50px;
    background-color: #F5F4F7;
    min-height: 100vh;
}

.container-dashboard-admin h2 {
    font-size: 1.2rem;
}

.products-removed-part {
    background-color: white;
    border-radius: 20px;
    padding: 15px 30px;
}

.products-removed {
    display: flex;
    flex-direction: column;
    margin-top: 50px;
    
}

.labels {
    text-transform: uppercase;
    font-weight: bold;
    color: grey;
    border-bottom: 1px solid rgb(184, 183, 183);
}

.product-removed, .labels {
    display: flex; 
    align-items: center;
    padding: 15px 0px;
}

.product-removed .image, .gap, .product-removed .id, .id-label {
    width: 10%;
    text-align: center;
}

.product-removed .name, .name-label {
    width: 60%;
    text-align: center;
}

.product-removed .removed, .removed-label {
    width: 20%;
    text-align: center;
}

.product-removed:not(:last-child) {
    border-bottom: 1px solid rgb(184, 183, 183);
}

.product-removed:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
}

.product-removed .image {
    padding: 5px;
}

.product-removed .image img {
    width: 50px;
    border-radius: 20px;
}
</style>