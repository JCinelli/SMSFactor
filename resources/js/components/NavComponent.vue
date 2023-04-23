<template>
    <nav class="container-navbar">
        <div class="logo">
            <router-link to="/">
                <p>Cosmo</p>
            </router-link>
        </div>
        <ul>
            <li class="nav-element">
                Categories
            </li>
            <li class="nav-element">
                Brand
            </li>
            <li class="nav-element">
                Contact
            </li>
            <li class="nav-element">
                FAQs
            </li>
        </ul>
        <div class="account-actions">
            <router-link to="/cart">
                <div class="cart">
                    <img src="/img/cart.png" alt="Cart Icon">
                    <span v-if="numberProductsInCart" class="bubble">{{ numberProductsInCart }}</span>
                </div>
            </router-link>
            <div class="notifications">
                <img src="/img/notification.png" alt="Notification Icon">
                <span class="bubble">1</span>
            </div>
            <div class="account">
                <img src="/img/avatar.png" alt="Avatar">
                <div class="user-name">
                    <p>My account</p>
                    <p><b>Jeremy Cinelli</b></p>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            numberProductsInCart : 0
        }
    },

    mounted() {
        // Récupération du nombre de produits dans le panier si il y en a
        if(localStorage.myCart) {
            this.numberProductsInCart = JSON.parse(localStorage.myCart).length
        }

        // Écoute des changements
        this.emitter.on("numberProductsInCart", numberProductsInCart => {
            this.numberProductsInCart = numberProductsInCart;
        });
	}
}
</script>

<style lang="css">

.container-navbar {
    width: 100%;
    display: flex;
    padding: 15px 50px;
}

.logo {
    font-size: 2rem;
}

.container-navbar ul {
    display: flex;
    flex: 1;
    align-items: center;
    padding-left: 50px;
    cursor: pointer;
}

.container-navbar ul li {
    padding: 0 20px;
    transition: color .3s;
}

.container-navbar ul li:hover {
    color: #C5A011;
}

.account-actions {
    display: flex;
    align-items: center;
}

.cart, .notifications {
    position: relative;
    border-radius: 50%;
    padding: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 20px;
    cursor: pointer;
}

.cart {
    background-color: #c5a11144;
}

.cart .bubble {
    background-color: #00606E;
}

.bubble {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    font-size: .6rem;
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: -3px;
    right: -3px;
    color: white;
    font-weight: bold;

}

.notifications {
    background-color: #005f6e46;
}

.notifications .bubble {
    background-color: #C5A011;
}

.cart img, .notifications img {
    width: 25px;
    transition: transform 0.2s;
}

.cart:hover img, .notifications:hover img {
    transform: scale(1.1)
}

.account {
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: color .2s;
}

.account:hover {
    color: #C5A011;
}

.account img {
    border-radius: 50%;
    width: 41px;
    margin-right: 15px;
}

.account .user-name {
    font-size: .8rem;
}

.account .user-name b {
    font-size: 1;
    color: #00606E;
}


</style>