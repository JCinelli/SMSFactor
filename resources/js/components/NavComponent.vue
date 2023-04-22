<template>
    <nav class="container-navbar">
        <ul>
            <li class="nav-element">
                <router-link to="/">
                    <img src="/img/logo.png" alt="">
                </router-link>
            </li>
            <li class="nav-element">
                <router-link to="/cart" class="router-cart">
                    <img class="cart" src="/img/cart.png" alt="">
                    <span class="number">{{ number }}</span>
                </router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            number : 0
        }
    },
    mounted() {
        if(localStorage.myCart) {
            this.number = JSON.parse(localStorage.myCart).length
        }

        this.emitter.on("number", number => {
            this.number = number;
        });
	}
}
</script>

<style lang="css">

.container-navbar {
    width: 100%;
    display: flex;
    background-color: rgb(240, 240, 240);
    margin-bottom: 50px;
}

.container-navbar ul {
    display: flex;
    flex: 1;
    justify-content: space-between;
    align-items: center;
}

.nav-element a {
    padding-right: 80px;
}

.router-cart{
    position: relative;
}

.cart, .number{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.cart {
    width: 35px;
}

.number{
    transform: translate(-50%, -65%);
    font-size: .8rem;
}

</style>