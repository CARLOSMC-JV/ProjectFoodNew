<template>
    <div class="box-general">
        <div class="box-overlay" :class="{ 'opened-cart': showCartShop }"></div>

        <div class="box-contact">
            <div class="box-data-contact">
                <div class="icon-text">
                    <img class="icon-contact" @click="emailLink()" :src="iconsEmail" alt="">
                    <span class="text-contact">atencionalcliente@lacasadelosravioles.com</span>
                </div>
                <div class="icon-text">
                    <img class="icon-contact" @click="openWhatsapp2()" :src="iconsWhatsapp" alt="">
                    <span class="text-contact">992 855 313</span>
                </div>
                <div class="icon-text">
                    <img class="icon-contact" @click="openWhatsapp()" :src="iconsWhatsapp" alt="">
                    <span class="text-contact">947 378 352</span>
                </div>
            </div>
            <div class="box-data-network">
                <div>
                    <span class="text-follow">Siguenos en:</span>
                </div>
                <div style="cursor: pointer;" @click="openPageFb()">
                    <img :src="iconFB">
                </div>
                <div style="cursor: pointer;" @click="openPageInstagram()">
                    <img :src="iconInstagram">
                </div>
                <!-- <div>
                    <span class="icon-network">YT</span>
                </div> -->
            </div>
        </div>
        <Modal @close="toggleModal" :modalActive="modalActive">
            <div class="modal-content-receta">
                <h1 class="title-receta">Lasaña / Canelloni</h1>
                <div class="box-receta-1">
                    <div class="text-receta">
                        <p><img :src="iconFideo">Descongelar la lasaña / cannelloni antes de hornear.</p>
                        <p><img :src="iconFideo">Precalentar el horno por 10 minutos a 250 °C.</p>
                        <p><img :src="iconFideo">Hornear la lasaña/cannelloni por 25 minutos a 250°C ó 360°F.</p>
                        <p><img :src="iconFideo">Retirar del horno y dejar reposar 5 minutos aprox, luego servir.</p>                    
                    </div>
                </div>

                <h1 class="title-receta-2">Ravioles & Cappelletti</h1>

                <div class="box-receta-2">
                    <div class="text-receta-2">
                        <p><img :src="iconFideo">Hervir abundante agua y sal al gusto.</p>
                        <p><img :src="iconFideo">Una vez hirviendo agregar los ravioles o los cappelletti sin descongelar,
                            bajar el fuego al mínimo y cocer revolviendo suavemente.
                        </p>
                        <div class="box-time">
                            <p class="text-bold">Tiempos de cocción:</p>
                            <p>Ravioles:              12 a 15 minutos</p>
                            <p>Cappelletti:           15 a 20 min aprox.</p>
                        </div>
                        <p><img :src="iconFideo">Antes de retirar los ravioles o los cappelleti, pruébelos para comprobar
                            la cocción.</p>                    
                        <p><img :src="iconFideo">Colar y mezclar rápidamente con la salsa de su preferencia.</p>   
                        <p><img :src="iconFideo">Sírvase caliente.</p>   
                    </div>
                </div>
            </div>
        </Modal>
        <transition name="slide-fade">
            <div class="cartmini__area tp-all-font-roboto" :class="{ 'cartmini-opened': showCartShop }" v-show="showCartShop"
                v-click-outside="closeCartOnClickOutside">
                <div class="cartmini__wrapper d-flex justify-content-between flex-column">
                    <div class="cartmini__top-wrapper">
                        <div class="cartmini__top p-relative">
                            <div class="cartmini__top-title">
                                <h4>Mi Carrito</h4>
                            </div>
                            <div class="box-quantity">
                                <h2 v-if="Object.keys(cart).length > 1">{{ Object.keys(cart).length }} productos</h2>
                                <h2 v-else>{{ Object.keys(cart).length }} producto</h2>
                            </div>
                        </div>

                        <div class="cartmini__widget">
                            <div class="cartmini__widget-item">
                                <div class="cartmini__thumb">
                                    <a href="product-details.html">
                                    </a>
                                </div>
                                <div class="cartmini__content" v-for="(item, item__index) in cart" :key="item.id">
                                    <div class="box-image">
                                        <img :src="item.image">
                                    </div>
                                    <div class="box-data-cart">
                                        <div class="box-name-delete">
                                            <h5 class="cartmini__title"><a href="product-details.html">{{ item.name }}</a>
                                            </h5>
                                            <div class="box-delete" @click="removeToCart(item.id)"><img :src="iconDelete">
                                            </div>
                                        </div>
                                        <div class="box-description">
                                            <h5 class="cartmini__description">{{ item.name }}</h5>

                                        </div>
                                        <div>
                                            <span class="cartmini__price">S/. {{ formatPrice(item.price) }}</span>
                                        </div>
                                        <div class="box-line">
                                            <hr>
                                        </div>
                                        <div class="box-total">
                                            <span class="text-total">Total producto:</span>
                                            <span
                                                class="text-total-price">{{ formatPrice(getPriceByProduct(item.id)) }}</span>
                                        </div>
                                        <div class="box-quantity-cart">
                                            <h5 class="cartmini__description">{{ item.quantity }}</h5>

                                        </div>
                                    </div>

                                </div>
                                <a href="#" class="cartmini__del"><img @click="closeCart()"
                                        src="../../img/icons/close-white-2.svg" alt=""></a>
                            </div>
                        </div>
                        <div class="cartmini__empty text-center d-none">
                            <p>Your Cart is empty</p>
                            <a href="shop.html" class="tp-btn">Go to Shop</a>
                        </div>
                    </div>
                    <div class="cartmini__checkout">
                        <div class="cartmini__checkout-title mb-30" @click="processCart()">
                            <h4>Procesar compra:</h4>
                            <span>S/ {{ formatPrice(calculateTotalCart()) }}</span>
                        </div>

                    </div>
                </div>
            </div>
        </transition>
        <header class="header">
            <transition name="transition__slide">
                <div v-if="showMobileOverlay" class="mobile__menu-overlay" :class="{ 'show-mobile': showMobileOverlay }">
                    <div class="box-menu-mobile-overlay" v-if="showContentMobile">
                        <div class="offcanvas__wrapper">
                            <div class="offcanvas__content">
                                <div class="offcanvas__top mb-70 d-flex justify-content-between align-items-center">
                                </div>
                                <div class="box-cart-general">
                                    <div>
                                        <div class="contain-icon" @click="openCartMobile()">
                                            <button type="button" class="box-cart">
                                                <img :src="iconCart">
                                            </button>
                                        </div>
                                        <div class="box-text">
                                            <span>Carrito</span>
                                        </div>
                                    </div>

                                    <div class="box-order-general" style="display: none;">
                                        <div class="contain-icon" @click="toggleShopCart()">
                                            <button type="button" class="box-order">
                                                <img :src="iconOrder">
                                            </button>
                                        </div>
                                        <div class="box-text">
                                            <span>Mis ordenes</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-tiendas">
                                    <svg viewBox="0 0 24 24" fill="#27272A" width="24" height="24" class="sc-e283704c-0 iMxoOo"><path d="M21.96 15.328l-2.032-7.03a.998.998 0 00-1.232-.7l-15.96 4.598a1 1 0 00-.7 1.232l2.033 7.03a1 1 0 001.233.7l15.992-4.598a1 1 0 00.667-1.232zM8.933 4.733l5.631 2.698 1.933-.566L8.4 3l-4.364 7.43L5.9 9.897l3.032-5.164z"></path></svg>
                                    <span style="color: rgb(39, 39, 42);" @click="redirectToShop()">Tiendas</span>
                                </div>
                                <div class="offcanvas__category pb-40">
                                    <button class="tp-offcanvas-category-toggle" @click="toggleSubMenu()">
                                        <div class="box-all-categories">
                                            <i class="fa-solid fa-bars"></i>
                                            <span class="text-all">Todas las categorías</span>
                                        </div>
                                        <div class="box-img">
                                            <img src="../../img/icons/chevron-down-white.svg">
                                        </div>

                                    </button>
                                    <transition name="slide">
                                        <nav class="tp-category-mobile-menu" v-show="showSubMenuMobile">
                                            <ul>
                                                <li class="item-submenu"
                                                    v-for="(category_item, category_item__index) in categorias"
                                                    :key="category_item__index">
                                                    <a :href="route('classcategory.index', { categoria: category_item.id })"
                                                        class="sub-item-category" :class="{ 'category-active': categoryActive === category_item.name }">

                                                        {{ category_item.name }}</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </transition>
                                </div>
                                <div class="offcanvas__contact align-items-center d-none">
                                    <div class="offcanvas__contact-icon mr-20">
                                        <span>
                                            <!-- <img src="assets/img/icon/contact.png" alt=""> -->
                                        </span>
                                    </div>
                                    <div class="offcanvas__contact-content">
                                        <h3 class="offcanvas__contact-title">
                                            <a href="tel:098-852-987">004524865</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="cartmini__area tp-all-font-roboto" :class="{ 'cartmini-opened': showCartShopMobile }" v-show="showCartShopMobile"
                            v-click-outside="closeCartOnClickOutside">
                            <div class="cartmini__wrapper d-flex justify-content-between flex-column">
                                <div class="cartmini__top-wrapper">
                                <div class="cartmini__top p-relative">
                                    <div class="cartmini__top-title">
                                        <h4>Mi Carrito</h4>
                                    </div>
                                    <div class="box-quantity">
                                        <h2 v-if="Object.keys(cart).length > 1">{{ Object.keys(cart).length }} productos</h2>
                                        <h2 v-else>{{ Object.keys(cart).length }} producto</h2>
                                    </div>
                                </div>

                                <div class="cartmini__widget">
                                    <div class="cartmini__widget-item">
                                        <div class="cartmini__thumb">
                                            <a href="product-details.html">
                                            </a>
                                        </div>
                                        <div class="cartmini__content" v-for="(item, item__index) in cart" :key="item.id">
                                            <div class="box-image">
                                                <img :src="item.image">
                                            </div>
                                            <div class="box-data-cart">
                                                <div class="box-name-delete">
                                                    <h5 class="cartmini__title"><a href="product-details.html">{{ item.name }}</a>
                                                    </h5>
                                                    <div class="box-delete" @click="removeToCart(item.id)"><img :src="iconDelete">
                                                    </div>
                                                </div>
                                                <div class="box-description">
                                                    <h5 class="cartmini__description">{{ item.name }}</h5>

                                                </div>
                                                <div>
                                                    <span class="cartmini__price">S/. {{ formatPrice((item.price)) }}</span>
                                                </div>
                                                <div class="box-line">
                                                    <hr>
                                                </div>
                                                <div class="box-total">
                                                    <span class="text-total">Total producto:</span>
                                                    <span
                                                        class="text-total-price">{{ formatPrice(getPriceByProduct(item.id)) }}</span>
                                                </div>
                                                <div class="box-quantity-cart">
                                                    <h5 class="cartmini__description">{{ item.quantity }}</h5>

                                                </div>
                                            </div>

                                        </div>
                                        <a href="#" class="cartmini__del"><img @click="closeCart()"
                                                src="../../img/icons/close-white-2.svg" alt=""></a>
                                        <!-- <a href="#" class="cartmini__del"><i class="fa-regular fa-xmark"></i></a> -->
                                    </div>
                                </div>
                                <!-- for wp -->
                                <!-- if no item in cart -->
                                <div class="cartmini__empty text-center d-none">
                                    <!-- <img src="assets/img/product/cartmini/empty-cart.png" alt=""> -->
                                    <p>Your Cart is empty</p>
                                    <a href="shop.html" class="tp-btn">Go to Shop</a>
                                </div>
                            </div>
                            <div class="cartmini__checkout">
                                <div class="cartmini__checkout-title mb-30" @click="processCart()">
                                    <h4>Procesar compra:</h4>
                                    <span>S/ {{ formatPrice(calculateTotalCart()) }}</span>
                                </div>

                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            <transition name="transition__mobile">
                <div class="header__mobile" v-if="!showOpenSearchMobile">
                    <div class="header-menu" @click="showOverlay()" v-if="!showMobileOverlay">
                        <img src="../../img/icons/menu-white.svg" alt="" />
                    </div>
    
                    <div class="header-menu" @click="() => (showMobileOverlay = false)" v-else>
                        <img src="../../img/icons/close-white-2.svg" alt="" />
                    </div>
                    <div class="header-menu-logo" @click="goToHome()">
                        <img :src="iconlogoPageCasa" alt="" />
                    </div>
                    <div class="search">
                        <img :src="iconSearch" class="icon-search" @click="openSearchMobile()">
                    </div>
    
                </div>
                <div v-else class="box-input-mobile">
                    <div class="control has-icons-left">
                        <input autocomplete="off" class="input" type="text" placeholder="Buscar producto"
                            style="height: 40px" @input="searchProducts">
                        <img :src="iconCloseBlack" class="icon-search" @click="closeSearchMobile()">
                    </div>
                    <div class="autocomplete-suggestions" v-if="suggestions.length">
                        <div v-if="isLoading" class="loading-spinner">
                            <img src="../../img/icons/loading.gif" alt="Cargando...">
                        </div>
                        <div v-else >
                            <ul class="list-suggestions">
                                <li v-for="suggestion in suggestions" @click="selectSuggestion(suggestion)">
                                    {{ suggestion.name }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </transition>



            <div class="header__desktop">

                <div class="header-tabs">
                    <div class="logo-search">
                        <a class="link-logo" @click="goToHome()">
                            <img :src="iconlogoPageCasa" alt="">
                        </a>
                        <div class="search-ads">
                            <div class="control has-icons-left">
                                <input autocomplete="off" class="input" type="text" placeholder="Buscar producto"
                                    style="height: 40px" @input="searchProducts">
                                <img :src="iconSearch" class="icon-search">
                            </div>
                            <div class="autocomplete-suggestions" v-if="suggestions.length">
                                <div v-if="isLoading" class="loading-spinner">
                                    <img src="../../img/icons/loading.gif" alt="Cargando...">
                                </div>
                                <div v-else >
                                    <ul class="list-suggestions">
                                        <li v-for="suggestion in suggestions" @click="selectSuggestion(suggestion)">
                                            {{ suggestion.name }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-shop">
                        <span @click="redirectToShop()">Tiendas</span>
                    </div>
                    <div class="box-cart">
                        <div class="contain-icon" style="display: none;">
                            <img :src="iconOrder">
                        </div>

                        <div class="contain-icon" @click="toggleShopCart()">
                            <button type="button" class="tp-header-action-btn cartmini-open-btn">
                                <img :src="iconCart">

                                <span class="tp-header-action-badge">{{ Object.keys(cart).length }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        </header>
        <div class="box-menu">
            <div class="tp-header-bottom tp-header-bottom-border d-none d-lg-block">
                <div class="container">
                    <div class="tp-mega-menu-wrapper p-relative">
                        <div class="row align-items-center row-custom">
                            <div class="box-logo">

                                <div class="tp-header-category tp-category-menu tp-header-category-toggle">
                                    <div @mouseover="show_options_mega = true" @mouseleave="show_options_mega = false">
                                        <button class="tp-category-menu-btn tp-category-menu-toggle" @click="openMenu">
                                            <div class="box-title">
                                                Todas las categorías
                                            </div>
                                            <div>
                                                <img class="chev-down" :src="chevDownIcon">
                                            </div>
                                        </button>
                                        <nav class="tp-category-menu-content" v-show="show_options_mega">
                                            <ul class="menu-by-category">
                                                <li v-for="(cate_item, cate_item__index) in categorias"
                                                    :key="cate_item__index">
                                                    <a href="shop.html" class="sub-item-category">
                                                        {{ cate_item.name }}</a>
                                                </li>

                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-box-top">
                                <div class="main-menu menu-style-1">
                                    <nav class="tp-main-menu-content">
                                        <!-- <a class="name-category"
                                            v-for="(category_item, category_item__index) in categorias"
                                            :key="category_item__index"
                                            :class="{ 'category-active': categoryActive === category_item.name }"
                                            @click.prevent="navigateToCategory(category_item.id)">{{ category_item.name }}</a> -->
                                        
                                            <CarouselSplideHeader :categorias="categorias" :categoryActive="categoryActive"></CarouselSplideHeader>
                                    </nav>
                                </div>
                            </div>

                            <div class="box-recetas" @click="toggleModal">
                                RECETARIO
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
</template>

<script>
import VueClickOutside from 'v-click-outside';

import HeroSlider2 from "@/ComponentsCustom/HeroSlider2.vue";
import ListProductsMain from "@/ComponentsCustom/ListProductsMain.vue";
import PopularCategories from "@/ComponentsCustom/PopularCategories.vue";
import FooterVue from "@/ComponentsCustom/Footer.vue";
import Modal from "@/ComponentsCustom/Modal.vue";
import {ref} from 'vue';
import iconFideo from '../../img/icons/fideito.webp';

import NavLink from '@/Components/NavLink.vue';

import axios from 'axios';

import CarouselSplide from '@/ComponentsCustom/CarouselSplide.vue';
import CarouselSplideHeader from '@/ComponentsCustom/CarouselSplideHeader.vue';
import chevDownIcon from '../../img/chev-down-new.png';

// *  Images
import bellIcon from "../../img/icons/bell.svg";
import checkCircleIcon from "../../img/icons/check-circle.svg";
import chevronDownIcon from "../../img/icons/chevron-down.svg";
import homeIcon from "../../img/icons/icon-home.svg";

import { useStore } from '@/store';
import { useToast } from 'vue-toastification';

import logoIcon from "../../img/icons/logo.svg";
import logoutIcon from "../../img/icons/logout.svg";
import checkIcon from "../../img/icons/check.svg";
import userIcon from "../../img/icons/user.svg";
import iconlogoPage from '../../img/logo/logo_food.png';
import iconlogoPageCasa from '../../img/logo/logo_casa_ravioles.png';
import iconsEmail from '../../img/icons-email.png';
import iconsPhone from '../../img/phone.png';
import iconsWhatsapp from '../../img/whatsapp-icon.png';
import iconSearch from '../../img/search-new.png';
import iconFB from '../../img/fb_icon.png';
import iconCart from '../../img/cart-icon.png';
import iconOrder from '../../img/order-icon.png';
import iconInstagram from '../../img/instagram_icon.png';
import iconDelete from '../../img/delete-icon.png';
import iconCloseBlack from '../../img/icons/close-icon-black.png';
import { mapState } from 'pinia'
import { onMounted, computed } from 'vue';

// import AbButtonV2 from "@/shared/components/form/button/AbButtonV2.vue";

export default {
    name: "Header",
    components: { CarouselSplide, NavLink, HeroSlider2, ListProductsMain, PopularCategories, FooterVue, CarouselSplideHeader, Modal },
    props: {
        latestProducts: {
            type: Array,
            required: false,
        },
        categoryActive: {
            type: String,
            required: false,
        }
    },
    data() {
        return {
            iconFideo,
            iconlogoPage,
            iconlogoPageCasa,
            iconSearch,
            iconFB,
            iconCart,
            iconOrder,
            iconInstagram,
            iconDelete,
            iconCloseBlack,
            iconsEmail,
            iconsWhatsapp,
            iconsPhone,
            logoIcon,
            show_options_mega: false,
            showUserOptions: false,
            showRecoverPasswordModal: false,
            showMobileOverlay: false,
            showOpenSearchMobile: false,
            showContentMobile: true,
            recoverPasswordButton: "",
            chevDownIcon,
            recoverEmail: "",
            recoverEmailSent: false,
            isLoading: false,
            // * ICONS
            bellIcon,
            checkIcon,
            checkCircleIcon,
            chevronDownIcon,
            homeIcon,
            logoutIcon,
            userIcon,
            showSubMenuMobile: true,
            categorias: [],
            showCartShop: false,
            showCartShopMobile: false,
            suggestions: []

        };
    },
    computed: {
        
    },
    setup(props) {
        const store = useStore();
        const toast = useToast();
        const modalActive = ref(false);

        const toggleModal = () => {
            console.log(modalActive.value)
            modalActive.value = !modalActive.value;
        }

        store.setLatestProducts(props.latestProducts);
        const cart = computed(() => Object.values(store.cart));
        const allProducts = computed(() => Object.values(store.allProducts));

        return {
            latestProducts: store.latestProducts,
            cart,
            allProducts,
            toast,
            setCarts: store.initializeCart,
            modalActive,
            toggleModal 
        };
    },
    head() {
        return {
            title: 'Título de tu página' // Aquí estableces el título de tu página
        }
    },
    mounted() {
        window.addEventListener("resize", this.handleResize);

    },
    created() {
        this.handleResize();
        this.fetchCategorias();

    },
    destroyed() {
        window.removeEventListener("resize", this.handleResize);
    },
    directives: {
        ClickOutside: VueClickOutside.directive,
    },
    methods: {
        calculateTotalCart() {
            if (this.cart && this.cart.length > 0) {
                const total = this.cart.reduce((accumulator, currentItem) => {
                return accumulator + currentItem.priceByProduct;
                }, 0);
                return total;
            }
            return 0;
        },
        formatPrice(price) {
            let num = Number(price);
            return !isNaN(num) ? num.toFixed(2) : '0.00';
        },
        openSearchMobile(){
            this.showOpenSearchMobile = true
        },
        closeSearchMobile(){
            this.showOpenSearchMobile = false
            this.suggestions=[]
        },
        showOverlay() {
            this.showMobileOverlay = true;
            this.showContentMobile = true;
        },
        goToHome(){
            this.$inertia.visit(route('home'));
        },
        navigateToCategory(categoryId) {
            this.$inertia.visit(route('classcategory.index', { categoria: categoryId }));
        },
        redirectToShop(){
            if (this.$page.url !== '/shop') {
                this.$inertia.visit('/shop');
            }
        },
        redirectToProductDetails(category, product) {
            console.log(category)
            this.$inertia.visit(route('product.details', { categoria2: category, id: product.id }));
        },
        selectSuggestion(suggestion) {
            this.redirectToProductDetails(suggestion.class_categories_id, suggestion)
        },
        searchProducts(event) {
            this.isLoading = true; 
            const query = event.target.value.toLowerCase();
            setTimeout(() => { 
                if (query.length >= 1) { 
                    this.suggestions = this.allProducts.filter(product => 
                        product.name.toLowerCase().includes(query)
                    );
                    this.isLoading = false;

                } else {
                    this.suggestions = [];
                    this.isLoading = false;

                }
            }, 300);
        },
        emailLink() {
            window.location.href = `mailto:${this.emailAddress}`;
        },
        openCartMobile() {
            this.showContentMobile = false
            this.showCartShopMobile = true
        },
        openPageFb() {
            const fabeURL = `https://www.facebook.com/LaCasaDeLosRavioles/?locale=es_LA`;

            window.open(fabeURL, '_blank');
        },
        openPageInstagram() {
            const instagramURL = `https://www.instagram.com/la.casa.de.los.ravioles/`;

            window.open(instagramURL, '_blank');
        },
        processCart() {
            let message = "";
            this.cart.forEach((item, index) => {
                message += `✅ ${index + 1}. ${item.name} - Cantidad: ${item.quantity} - Precio: S/ ${this.formatPrice(item.price)}%0A`;
            });
            let total = `\n\u{1F4B0} Total: S/ ${this.formatPrice((this.calculateTotalCart()))}`;

            let whatsappurl = "https://api.whatsapp.com/send?phone=51992855313" + "&text=Esta es mi compra 🛒 %0A" + message +"%0A"+total;
            window.open(
                whatsappurl,
                '_blank'
            );
        },
        async removeToCart(productId) {
            try {
                axios.post(route('cart.remove', { product_id: productId }))
                    .then(res => {
                        this.setCarts(res.data.cart)
                    })
                this.toast.warning("Producto eliminado correctamente");

            } catch (error) {
                console.error(error);
                this.toast.error('Hubo un problema al agregar el producto');

            }
        },
        fetchCategorias() {
            axios.get('/listcategories')
                .then((response) => {
                    const ordenDeseado = [
                        'Ravioli',
                        'Cappelletti',
                        'Tortelloni',
                        'Agnolotti',
                        'Gnocchi y malfatti',
                        'Pasta seca al huevo',
                        'Lasagnas',
                        'Salsas',
                        'Vinos y Licores'
                    ];

                    this.categorias = response.data.classCategories;
                    this.categorias.sort((a, b) => {
                        return ordenDeseado.indexOf(a.name) - ordenDeseado.indexOf(b.name);
                    });
                    console.log(this.categorias)
                })
                .catch((error) => {
                    console.error('Error al obtener categorías:', error);
                });
        },

        getPriceByProduct(id_product) {
            if (this.cart) {
                let productFilter = this.cart.filter(e => e.id === id_product);
                if (productFilter.length > 0) {
                    let priceByProduct = productFilter[0].price * productFilter[0].quantity;
                    productFilter[0].priceByProduct = priceByProduct;

                    return priceByProduct;
                }
            }
            return null;
        },
        closeCartOnClickOutside() {
            this.showCartShop = false
        },
        toggleShopCart() {
            this.showCartShop = !this.showCartShop
        },
        closeCart() {
            this.showCartShop = false
        },
        openWhatsapp() {
            const whatsappurl = `https://api.whatsapp.com/send?phone=51947378352`;
            window.open(whatsappurl, "_blank");
        },
        openWhatsapp2() {
            const whatsappurl = `https://api.whatsapp.com/send?phone=51992855313`;
            window.open(whatsappurl, "_blank");
        },

        toggleSubMenu() {
            this.showSubMenuMobile = !this.showSubMenuMobile
        },
        openMenu() {
            console.log("entro a open menu")
            this.show_options_mega = !this.show_options_mega
        },
        handleResize() {
            if (typeof window !== 'undefined') {
                // Código para el navegador
                this.windowWidth = parseInt(window.innerWidth, 10);
                if (this.windowWidth >= 991) {
                    console.log(this.windowWidth)
                    this.showMobileOverlay = false;
                }
            }
        },
        reloadPage() {
            location.reload();
        },
        // overlayGoNext(route) {
        //     this.showMobileOverlay = false;
        //     this.$router.push({
        //         name: route.name,
        //         query: route.query ? route.query : null,
        //     });
        // },
    },
};
</script>
<style lang="css"></style>
<style lang="scss" scoped>
@import "resources/styles/variables";
@import "resources/styles/breakpoints";
@import "resources/styles/mixins";
@import "resources/styles/animations";
$font-path: '../../fonts/';
@font-face {
  font-family: 'FrankfurterMediumPlain';
  src: url(#{$font-path}FrankfurterMediumPlain.eot); 
  src: url(#{$font-path}FrankfurterMediumPlain.eot?#iefix) format('embedded-opentype'), 
       url(#{$font-path}FrankfurterMediumPlain.woff2) format('woff2'), 
       url(#{$font-path}FrankfurterMediumPlain.woff) format('woff'), 
       url(#{$font-path}FrankfurterMediumPlain.ttf) format('truetype'), 
       url(#{$font-path}FrankfurterMediumPlain.svg#FrankfurterMediumPlain) format('svg');
  font-weight: normal;
  font-style: normal;
}
* {
    font-family: "Montserrat", sans-serif;
    font-optical-sizing: auto;

    font-style: normal;

}

html,
body {
    margin: 0;
    padding: 0;
}

.box-general {
    position: sticky;
    z-index: 100;
    top: 0;
    left: 0;
    width: 100%;
    
    .modal-receta{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100vw;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        background-color: rgba(255, 255, 255, .7);
        
        .modal-inner-receta{
            .btn-close{
                
            }
            .modal-content-receta{
                display: flex;
                flex-direction: column;
                align-items: center;
                img{
                    width: 20px;
                }
                .title-receta{
                    color: #1A3D6E;
                    font-weight: 500;
                    font-family: 'FrankfurterMediumPlain', 'Arial', sans-serif;
                }
                .title-receta-2{
                    margin-top: 1rem;
                    color: #961921;
                    font-weight: 500;
                    font-family: 'FrankfurterMediumPlain', 'Arial', sans-serif;
                }
                .box-receta-1{
                    background-color: #961921;
                    padding: 1.5rem;
                    width: 100%;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    
                    p{
                        color: #ffffff;
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                    }
                }
                .box-receta-2{
                    background-color: #144220;
                    padding: 1.5rem;
                    width: 100%;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    p{
                        color: #ffffff;
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                    }
                    .text-receta-2{
                        width: 90%;
                        .text-bold{
                            font-weight: 700;
                        }
                        .box-time{
                            margin-left: 25px;
                        }
                    }
                }
                h1,p{
                    margin-bottom: 16px;
                }
                h1{
                    font-size: 2.5rem;
                }
            }
        }
    }
    .slide-fade-enter-active, .slide-fade-leave-active {
        transition: transform 0.5s ease;
    }

.slide-fade-enter-from, .slide-fade-leave-to /* .slide-fade-leave-active in <2.1.8 */ {
  transform: translateX(100%);
}

.slide-fade-enter-to, .slide-fade-leave-from /* .slide-fade-enter in <2.1.8 */ {
  transform: translateX(0);
}

    .cartmini__content {
        display: flex;
        gap: 0.5rem;
        padding-bottom: 0.5rem;
        align-items: center;
        border-bottom: 1px solid #d5d7d8;
        padding: 0rem 1rem 0.5rem 1rem;

        .box-image {
            img {
                width: 128px;
                height: 120px;
                object-fit: cover;
            }
        }

        .box-data-cart {
            width: 70%;
            position: relative;

            .box-name-delete {
                display: flex;
                justify-content: space-between;

                .box-delete {
                    cursor: pointer;
                }

                img {
                    width: 24px;
                }
            }

            .box-line {
                hr {
                    width: 100%;
                    border-top: 1px solid rgb(228, 228, 231);
                    margin: 1rem 0rem;
                }
            }

            .box-total {
                display: flex;
                justify-content: space-between;

                .text-total {
                    color: #010F1C;
                    font-size: 0.875rem;
                }

                .text-total-price {
                    color: #010F1C;
                    font-size: 1rem;
                    font-weight: 600;
                }
            }

            .box-quantity-cart {
                border-radius: 50%;
                background-color: #961921;
                width: 40px;
                height: 40px;
                right: 8px;
                position: absolute;
                z-index: 4;
                bottom: 35%;
                display: flex;
                align-items: center;
                justify-content: center;

                h5 {
                    color: #ffffff;

                }
            }

            .box-description {
                .cartmini__description {
                    font-size: 0.75rem;
                }
            }
        }
    }

    .box-overlay {
        overflow-y: scroll;

        &.opened-cart {
            background-color: #010F1C;
            height: 100%;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 9999;
            left: 0;
            opacity: 0.7;
            transition: all 0.3s 0s ease-out;
            overflow-y: hidden;
        }
    }

    .box-contact {
        padding: 0.5rem 1rem;
        height: 2rem;
        background: #144220;
        display: none;
        align-items: center;
        justify-content: space-between;

        .box-data-network {
            display: flex;
            gap: 0.5rem;

            .text-follow {
                color: #ffffff;
                font-size: 0.875rem;
            }
        }

        .box-data-contact {
            display: flex;
            gap: 1rem;

            .icon-text {
                display: flex;
                align-items: center;
                gap: 0.3rem;
            }

            .icon-contact {
                width: 20px;
                cursor: pointer;
            }

            .text-contact {
                color: #ffffff;
                font-weight: 400;
                font-size: 0.875rem;
            }
        }
    }

}

.box-menu {
    height: 40px;
    display: none;
    background: #e1e1e1;

    .tp-header-bottom-border {
        // margin: 1rem 1.5rem;
    }

    .tp-header-bottom {
        .container {
            padding: 0px 12px;
            margin: 0rem;
            max-width: none;

            .tp-header-category {
                .tp-category-menu-btn nav ul li::after {
                    position: absolute;
                    content: "";
                    left: 0;
                    top: 50%;
                    width: 2px;
                    height: 0;
                    background-color: #c7303a;
                    -webkit-transform: translateY(-50%);
                    -moz-transform: translateY(-50%);
                    -ms-transform: translateY(-50%);
                    -o-transform: translateY(-50%);
                    transform: translateY(-50%);
                    visibility: hidden;
                    opacity: 0;
                }

                .tp-category-menu-content {
                    background: rgb(255, 255, 255);
                    padding: 0rem;
                    position: absolute;
                    z-index: 100;
                    width: 233px;

                    ul {
                        li {

                            .mega-menu {
                                li {
                                    a.mega-menu-title {
                                        color: #55585B;
                                        font-weight: 700;
                                    }

                                    ul {
                                        li {
                                            a {
                                                color: #979a9c !important;
                                                font-weight: 400;
                                            }
                                        }

                                    }
                                }
                            }
                        }
                    }
                }
            }

            .box-logo {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                // width: 16%;

                .tp-header-category {
                    border-right: 3px solid #979a9c;
                }
            }

            .menu-box-top {
                // margin-left: 1.5rem;
            }

            .tp-mega-menu-wrapper {
                .text-logo {
                    color: #30F3A1;
                    font-weight: 500;
                    font-family: 'Helvetica Neue', sans-serif;
                    font-size: 24px;
                }

                .main-menu>nav>ul>li.has-dropdown>a::after {
                    content: none;

                }

                .row-custom {
                    display: grid;
                    grid-template-columns: minmax(150px, 15%) minmax(200px, 73%) minmax(100px, 12%);
                    gap: 1.5rem;

                    height: 40px;
                    width: 100%;
                    margin-left: initial;
                }

                .main-menu {
                    .tp-main-menu-content {
                        display: flex;
                        gap: 1.5rem;

                        .has-dropdown {
                            .mega-menu-style-custom {
                                width: 700px;
                                display: flex;
                                gap: 2rem;
                            }

                        }

                        a {
                            color: #515253;
                            font-weight: 500;
                            cursor: pointer;
                            &.category-active {
                                color: #961921;
                            }
                        }

                        a {
                            &:hover {
                                color: #961921;
                            }
                        }

                        .icon-chevron {
                            width: 10px;
                        }



                        li {
                            a {
                                &:hover {
                                    color: #f34e29;
                                }
                            }
                        }

                        .has-custom-menu {
                            display: flex;
                            gap: 0.5rem;
                            height: 40px;
                            margin-bottom: 0rem;
                            align-items: center;

                            .icon-chevron {
                                width: 10px;
                            }
                        }
                    }
                }

                .tp-header-category {
                    .tp-category-menu-btn {
                        padding: 0.5rem;
                        height: 40px;
                        display: flex;
                        align-items: center;
                        gap: 0.5rem;
                        justify-content: space-between;

                        .chev-down {
                            width: 15px;
                        }

                        .box-title {
                            display: flex;
                            gap: 0.5rem;
                            align-items: center;
                            color: #515253;
                            font-weight: 500;

                            &:hover {
                                color: #961921;
                            }
                        }

                        svg {
                            path {
                                fill: #ffffff;
                            }
                        }
                    }

                    .tp-category-menu-btn::after {
                        display: none;
                    }

                    .tp-category-menu-content {

                        .menu-by-category {
                            position: absolute;
                            top: 100%;
                            left: 0;
                            width: 100%;
                            background: #FFFFFF;
                            box-shadow: 0px 1px 3px rgba(1, 15, 28, 0.1);
                            z-index: 9;

                            li:hover {
                                color: #961921;
                                font-weight: 600;
                            }


                            li {
                                list-style: none;
                                padding: 0 30px;
                                position: relative;
                                margin-bottom: 0rem;

                                .sub-item-category {
                                    font-size: 15px;
                                    color: #55585B;
                                    width: 100%;
                                    padding: 13px 0 12px;
                                    border-bottom: 1px solid #EAEBED;
                                    background-color: #ffffff;
                                    font-weight: 500;
                                    position: relative;
                                    display: flex;


                                    &:hover {
                                        color: #961921;
                                        font-weight: 500;
                                    }

                                    span {
                                        img {
                                            transform: translateY(-2px);
                                        }
                                    }
                                }
                            }

                            .box-chevron {
                                .img-chevron {
                                    transform: translateY(0px);

                                }
                            }

                            .sub-item-category {
                                display: flex;
                                align-items: center;
                                gap: 0.5rem;
                                
                            }

                            .sub-item-category-menu {
                                display: flex;
                                align-items: center;
                                gap: 0.3rem;
                                justify-content: space-between;

                                &:hover {
                                    .box-icon-text {
                                        .text-category {
                                            color: #961921;
                                            font-weight: 500;

                                        }
                                    }
                                }

                                .box-icon-text {
                                    display: flex;
                                    align-items: center;
                                    gap: 0.3rem;

                                    .text-category {
                                        color: #55585B;
                                        font-weight: 500;
                                        font-size: 15px;
                                    }

                                }
                            }
                        }

                        ul {

                            li {
                                &:hover {
                                    a {
                                        color: #c7303a;
                                    }
                                }

                                a {
                                    &:hover {
                                        color: #c7303a;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

header.header {
    background: #961921;
    height: 3.5rem;

    // position: fixed;
    // top: 0;
    width: 100%;
    z-index: 99;

    .transition__slide-enter-active,
    .transition__slide-leave-active {
        transition: all 0.35s ease;

        // opacity: 0;
        transform: translateX(-100%);

    }

    .transition__slide-enter,
    .transition__slide-leave-to {
        opacity: 100;
        transition: transform 0.35s ease-in-out 0s;
        // transform: translateX(-100%);
        overflow: hidden;
    }

    // .transition__slide-enter-to, .transition__slide-leave {
    //     opacity: 100;
    //     transition: all 0.25s ease;
    //     transform: translateX(-100%);
    //     overflow: hidden;
    // }

    >.mobile__menu-overlay {
        padding: 1rem;
        background: rgb(255, 255, 255);
        display: flex;
        flex-direction: column;
        height: calc(100% - 56px);
        overflow: auto;
        position: fixed;
        top: 56px;
        transition: transform 0.25s ease-in-out 0s;

        width: 100vw;
        z-index: 26;

        .box-menu-mobile-overlay{
            &.hidden-menu{
                display: none;
            }
        }
        .offcanvas__wrapper {
            height: 100vh;

            .box-cart-general {
                display: flex;
                justify-content: space-around;

                .box-text {
                    color: #010F1C;
                    font-size: 0.875rem;
                }

                .box-order-general {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }

                .contain-icon {
                    .box-cart {
                        background: #b92b35;
                        padding: 0.35rem;
                        border-radius: 0.5rem;
                        width: 48px;
                        height: 48px;
                        display: flex;
                        justify-content: center;
                        align-items: center;

                        img {
                            width: 20px;
                        }
                    }

                    .box-order {
                        background: #144220;
                        padding: 0.35rem;
                        border-radius: 0.5rem;
                        width: 48px;
                        height: 48px;
                        display: flex;
                        justify-content: center;
                        align-items: center;

                        img {
                            width: 20px;
                        }
                    }

                }
            }

            .offcanvas__content {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }
            .box-tiendas{
                display: flex;
                gap: 0.5rem;
                padding: 10px 0;
                border-top: 1px solid rgba(1, 15, 28, 0.1);
                border-bottom: 1px solid rgba(1, 15, 28, 0.1);
            }
            .offcanvas__category {

                .slide-enter-active,
                .slide-leave-active {
                    transition: all 0.5s ease;
                    opacity: 0;

                }

                .slide-enter,
                .slide-leave-to {
                    transform: translateY(-30px);
                    opacity: 0;
                    max-height: 0;

                }

                .slide-enter-to,
                .slide-leave {
                    // max-height: 500px; /* Ajusta este valor según el contenido */
                    //   transform: translateY(10px);
                    opacity: 100;
                    transition: all 1s ease;

                    overflow: hidden;
                }

                .tp-offcanvas-category-toggle {
                    font-size: 16px;
                    color: var(--tp-common-white);
                    position: relative;
                    width: 100%;
                    text-align: left;
                    background-color: #961921;
                    padding: 10px 20px;
                }

                .tp-offcanvas-category-toggle svg,
                .tp-offcanvas-category-toggle i {
                    margin-right: 14px;
                    font-size: 16px;
                }

                .tp-offcanvas-category-toggle {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;

                    .box-all-categories {
                        .text-all {
                            color: #ffffff;
                        }

                        .fa-solid {
                            color: #ffffff;

                        }

                        ::before {
                            display: none;
                        }
                    }
                }

                .tp-category-mobile-menu {
                    .item-submenu {
                        list-style: none;
                        position: relative;
                        width: 100%;
                        padding: 0;
                        padding-left: 20px;
                        padding-right: 20px;
                        color: rgb(39, 39, 42);

                        .sub-item-category {
                            display: flex;
                            align-items: center;
                            gap: 0.5rem;
                            font-size: 16px;
                            color: var(--tp-common-black);
                            position: relative;
                            padding: 10px 0;
                            padding-right: 20px;
                            border-bottom: 1px solid rgba(1, 15, 28, 0.1);
                            &.category-active{
                                color: #961921;
                                font-weight: 600;
                            }
                            span {
                                .img-icon {
                                    transform: translateY(-1px);
                                }
                            }
                        }
                    }
                }
            }
        }

        >.close-button {
            position: absolute;
            right: 0;
            margin-right: 1rem;

            img {
                cursor: pointer;
            }
        }

        >.overlay-logo {
            text-align: center;
            flex: 1;
            padding: 1rem 0;

            img {
                cursor: pointer;
            }
        }

        // * Styles for options
        .overlay-options {
            display: flex;
            flex-direction: column;
            // margin-bottom: 2rem;

            >a.overlay-option {
                color: $text-dark-color-3;
                transition: all 0.2s;
                cursor: pointer;

                &:not(:last-child) {
                    margin-bottom: 2rem;
                }

                &.active {
                    color: $primary-color;
                    font-size: 1.3rem;
                    font-weight: bold;
                }

                &:hover {
                    color: $primary-color;
                    font-size: 1.3rem;
                    font-weight: bold;
                }
            }
        }
    }
    .transition__mobile-enter-active,
        .transition__mobile-leave-active {
            opacity: 100;
            
            transition: all 0.25s ease;
            transform: translateX(-100%);
        }

        .transition__mobile-enter,
        .transition__mobile-leave-to {
            opacity: 100;
            transition: transform 0.25s ease-in-out 0s;
            overflow: hidden;
        }
    .box-input-mobile{
        transition: transform 0.25s ease-in-out 0s;
        z-index: 26;
        width: 100vw;

        .autocomplete-suggestions{
            z-index: 20;
            position: absolute;
            overflow-y: scroll;
            background: #ffffff;
            padding: 0.8rem;
            border-radius: 0.5rem;
            margin-top: 0.15rem;
            width: 100%;
            height: 220px;
            border-bottom: 1px solid #979a9c;
            .loading-spinner{
                img{
                    width: 50px;
                }
            }
            .list-suggestions{
                li{
                    padding: 0.5rem;
                    border-radius: 0.5rem;
                    cursor: pointer;
                    &:hover{
                        background: #961921;
                        color: #ffffff;
                    }
                }
            }
        }
        .has-icons-left{
            display: flex;
            justify-content: space-between;
            width: 100%;
            align-items: center;
            gap: 0.5rem;
            input{
                height: 56px !important;
                width: 100%;
            }
            .icon-search{
                height: 30px;
                position: absolute;
                right: 10px;
            }
        }
    }
    >.header__mobile {
        // display: flex;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        align-items: center;
        height: 3.5rem;
        position: sticky;
        top: 0;
        z-index: 20;

        .search {
            display: flex;
            justify-content: flex-end;
            padding: 0.5rem 1rem;

        }

        .header-menu-logo {
            display: flex;
            justify-content: center;
        }

        >.header-menu {
            cursor: pointer;
            padding: 0.5rem 1rem;

            img {
                width: 1.5rem;
                min-width: 1.5rem;
            }
        }

        >hr {
            border-right: 1px solid #dedfe4;
            height: 100%;
        }

        >.header-logo {
            text-align: center;
            flex: 1;

            img {
                min-width: 10rem;
                width: 60%;
                max-width: 15rem;
                cursor: pointer;

                @include large {
                    width: auto;
                }
            }
        }
    }

    >.header__desktop {
        display: none;

        //* Styles for the logo
        .header-logo {
            width: 13em;
            min-width: 10rem;
            height: 5rem;
            cursor: pointer;

            @include flex-mixin(center, normal, row);

            img {
                width: 100%;
            }
        }

        // * Styles for options
        .header-tabs {
            >a.header-tab {
                color: #ffffff;
                font-size: 1rem;
                transition: all 0.2s;

                &:not(:last-child) {
                    margin-right: 2rem;
                }

                &.active {
                    font-size: 1.3rem;
                    font-weight: bold;
                }

                &:hover {
                    font-size: 1.3rem;
                    font-weight: bold;
                }
            }
        }

        .logged-in-options {
            display: flex;
            align-items: flex-end;
            flex-direction: column;

            // margin-left: 1rem;
            position: relative;
            max-height: 100%;

            .logged-in__notifications {
                display: flex;
                padding: 0 0.8rem;
                background: #f1f3f9;
                border: 1px solid #d3d5db;
                border-radius: 1rem;
                cursor: pointer;
                margin-right: 1rem;
            }

            .logged-in__avatar-image {
                border: 2px solid #e4e6ea;
                border-radius: 50%;
                max-width: 3rem;
                margin-right: 0.5rem;
            }

            .logged-in__user-name {
                display: flex;
                align-items: center;

                .chevron-icon {
                    height: 0.5rem;
                    margin: auto;
                    cursor: pointer;
                }
            }

            .user-options-dropdown {
                z-index: 10;

                * {
                    font-family: PoppinsRegular, Arial, Helvetica, sans-serif;
                }

                img {
                    width: 1rem;
                }

                .dropdown__user-information,
                .dropdown__user-profile,
                .dropdown__user-postulations,
                .dropdown__user-logout {
                    padding: 1rem;
                }

                .dropdown__user-profile,
                .dropdown__user-postulations,
                .dropdown__user-logout {
                    display: flex;
                    cursor: pointer;
                    background-color: white;
                    -webkit-transition: background-color 0.3s;
                    /* For Safari 3.0 to 6.0 */
                    transition: background-color 0.3s;
                    /* For modern browsers */

                    &:hover {
                        background-color: #f2f3f9;
                    }
                }

                position: absolute;
                min-width: 15rem;
                height: auto;

                top: 100%;
                margin-top: -1rem;

                background: #ffffff;
                box-shadow: 0px 2px 8px rgba(33, 44, 74, 0.16);
                border-radius: 8px;
            }
        }

        .logged-out-options {
            display: flex;
            align-items: center;
            color: $text-dark-color-3;
        }
    }

    .ab-modal {
        .ab-title {
            color: $secondary-color;
        }

        .ab-modal-card-body .form-fields .form-field {
            margin-bottom: 1rem;
        }

        .registered-modal {
            .registered-modal-title {
                font-family: HelveticaNeueBold, Arial, Helvetica, sans-serif;
                font-weight: bold;
            }
        }
    }
}

@include medium {
    .box-general {
        .box-contact {
            display: flex;
        }
    }
}

@media (min-width: 992px) {
    .box-menu {
        display: block;
    }
}

@include large {
    .box-general {
        .box-contact {
            display: flex;
        }

        .header {
            height: 5rem;

            .header__mobile {
                height: 5rem;
            }
        }
    }
}

@include large {
    header.header {
        display: flex;
        padding: 0rem 2rem;

        >.header__mobile {
            display: none;
        }

        >.header__desktop {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;

            .header-tabs {
                display: grid;
                grid-template-columns: 80% 10% 10%;
                width: 100%;
                align-items: center;
                gap: 1rem;

                .box-shop {
                    display: flex;
                    justify-content: center;
                    gap: 1rem;
                    span {
                        cursor: pointer;
                        font-size: 1rem;
                        color: #ffffff;
                        font-weight: 500;
                    }
                }

                .box-cart {
                    display: flex;
                    gap: 0.5rem;

                    .contain-icon {
                        cursor: pointer;
                        background: rgba(255, 255, 255, 0.2);
                        padding: 0.5rem;
                        border-radius: 0.35rem;

                        .tp-header-action-btn {
                            display: flex;
                            align-items: center;
                            gap: 0.4rem;

                            .tp-header-action-badge {
                                color: #ffffff;
                                font-weight: 500;
                            }
                        }

                        &:hover {
                            background: rgba(255, 255, 255, 0.1);
                        }

                        img {
                            width: 25px;
                            height: 25px;

                        }
                    }
                }

                .logo-search {
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                    .link-logo{
                        cursor: pointer;
                    }
                    .search-ads {
                        width: 80%;
                        position: relative;
                        .autocomplete-suggestions{
                            z-index: 20;
                            position: absolute;
                            overflow-y: scroll;
                            height: 320px;
                            background: #ffffff;
                            padding: 0.8rem;
                            border-radius: 0.5rem;
                            margin-top: 0.15rem;
                            width: 100%;
                            .loading-spinner{
                                img{
                                    width: 50px;
                                }
                            }
                            .list-suggestions{
                                li{
                                    padding: 0.5rem;
                                    border-radius: 0.5rem;
                                    cursor: pointer;
                                    &:hover{
                                        background: #961921;
                                        color: #ffffff;
                                    }
                                }
                            }
                        }
                        .has-icons-left {
                            position: relative;

                            .icon-search {
                                width: 20px;
                                height: 20px;
                                position: absolute;
                                bottom: 20%;
                                right: 10px;
                            }

                            .input {
                                width: 100%;
                                border-radius: 0.6rem;
                                border: transparent;
                            }

                            .icon {
                                position: absolute;
                                right: 10px;
                                top: 8px;
                            }
                        }

                        .control {
                            border-radius: 0.3rem;
                        }
                    }
                }
            }
        }
    }

    .ab-modal {
        .ab-modal-card {
            max-height: 80%;
            width: 65%;

            &.small {
                width: 45%;
            }
        }
    }
}
</style>
