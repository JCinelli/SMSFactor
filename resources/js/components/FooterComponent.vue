<template>
    <footer class="container-footer">
        <div class="divider"></div>
        <div class="container-content">
            <div class="brand-description footer-part">
                <div class="logo">
                    <router-link to="/">
                        <p>Cosmo</p>
                    </router-link>
                </div>
                <div class="description">
                    <p>Cosmo finds for you the best headphones by placing quality at the center of our concerns. Created in 1996, our passion for music has brought us to where we are today. </p>
                </div>
            </div>
            <div class="usefull-links footer-part">
                <p class="title-footer">Usefull links</p>
                <div class="links">
                    <ul>
                        <li>Products</li>
                        <li>Categories</li>
                        <li>Delivery</li>
                        <li>About us</li>
                    </ul>
                    <ul>
                        <li>Loyalty</li>
                        <li>Concept Store</li>
                        <li>FAQs</li>
                        <li>Lifestyle</li>
                    </ul>
                </div>
            </div>
            <div class="follow footer-part">
                <p class="title-footer">Contact us</p>
                <button>Contact form</button>
                <div class="social-medias">
                    <div class="fb media"><img src="/img/social/fb.png" alt="Facebook Icon"></div>
                    <div class="insta media"><img src="/img/social/insta.png" alt="Instagram Icon"></div>
                    <div class="twitter media"><img src="/img/social/twitter.png" alt="Twitter Icon"></div>
                    <div class="tiktok media"><img src="/img/social/tiktok.png" alt="Tiktok Icon"></div>
                </div>
            </div>
        </div>
        <div class="copyright">
            © COSMO 2023 - Made with love and passion by Jeremy Cinelli
        </div>
    </footer>
    
</template>

<script lang="js">
export default {
    data() {
        return {
           
        }
    }
}
</script>

<style lang="css">
.container-footer {
    margin-top: 100px;
    padding: 50px 50px 0 50px;
}

.container-footer .divider {
    width: 70%;
    margin: auto;
    border-top: 1px solid grey;
}

.container-content {
    display: flex;
    gap: 20%;
    padding-top: 50px;
}

.footer-part {
    width: 33.33%;
}

.description{
    margin-top: 20px;
}
.title-footer {
    text-transform: uppercase;
    font-weight: bold;
    margin-bottom: 30px;
}

.usefull-links .links {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

.usefull-links li {
    padding: 5px 0;
    cursor: pointer;
    transition: color .3s;
}
.usefull-links li:hover {
    color: #C5A011;
}

.follow button {
    width: 100%;
    color: #C5A011;
    border: 1px solid #C5A011;
    background-color: white;
    padding: 10px 0;
    border-radius: 20px;
    cursor: pointer;
    transition: background-color .3s;
}

.follow button:hover {
    background-color: #c5a11144;
}

.follow .social-medias {
    display: flex;
    justify-content: space-between;
}

.follow .social-medias .media {
    width: 30px;
    height: 30px;
    cursor: pointer;
    margin-top: 50px;
}

.follow .social-medias .media img{
    width: 100%;
    filter: contrast(0);
    transition: filter .3s;
}

.follow .social-medias .insta {
    width: 32px;
    height: 32px;
}

.follow .social-medias .media:hover img{
    filter: contrast(1);
}

.copyright {
    width: 100%;
    text-align: center;
    color: #00606E;
    margin-top: 50px;
    padding-bottom: 20px;
}
</style>