<script>
    import MainNavCustom from "@/ComponentsCustom/MainNavCustom.vue";
    import axios from 'axios';
    import { Head, useForm } from '@inertiajs/vue3';
    import Footer from "@/ComponentsCustom/Footer.vue";
    import CarouselSplideGallery from "@/ComponentsCustom/CarouselSplideGallery.vue";
    import iconMore from '../../../img/more-icon.png';
    import chevronDownRed from '@/../img/icons/chevron-down-red.svg';
    import  {useToast}  from 'vue-toastification';
    import { useStore } from '../../store';
    import { computed, onMounted  } from 'vue';


    export default {
        data() {
            return {
                descriptionProduct:true,
                iconMore,
                chevronDownRed
            }
        },
        components:{
            MainNavCustom,
            Head,
            Footer,
            CarouselSplideGallery
        },
        props:{
            product: {type: Object},
            cart:{type: Object}
        },
        created(){
            console.log(this.cart)
        },
        methods:{
            formatPrice(price) {
                let num = Number(price);
                return !isNaN(num) ? num.toFixed(2) : '0.00';
            },
            openGetInfoByWhatsapp(product) {
                let message = "";
                message += `✅ ${product.name} - Cantidad: 1 - Precio: S/ ${this.formatPrice(product.price)}\n`;
                let total = `\n\u{1F4B0} Total: S/ ${this.formatPrice(product.price)}`;

                let whatsappurl = "https://api.whatsapp.com/send?phone=51992855313" + "&text=Esta es mi compra 🛒 %0A" + message +"%0A"+total;
                window.open(
                    whatsappurl,
                    '_blank'
                );
            },
            async addToCart(productId) {
                try {
 
                    axios.post(route('cart.add', {product_id: productId, quantity: 1}))
                    .then(res => {
                        this.setCarts(res.data.cart)
                    }) 
                    this.toast.success("Producto agregado correctamente");
                    

                } catch (error) {
                    console.error(error);
                    this.toast.error('Hubo un problema al agregar el producto');

                }
            },
           
        },
        setup(props) {
            const toast = useToast();
            const store = useStore();
            console.log(store)
            const cart = computed(() => Object.values(store.cart));
            console.log(props.cart)
            console.log(cart.value)

            const getCart = async () => {
                try {
                    axios.get(route('cart.view'))
                    .then(res => {
                        store.initializeCart(res.data.cart);
                    }) 
                } catch (error) {
                    console.error(error);
                }
            };

            onMounted(() => {
                if (cart.value.length === 0) {
                    getCart();
                }
            });

            return { toast,      
                cart: cart, 
                onAddCart: store.addToCart,
                setCarts: store.initializeCart,
                getCart
            };
        },
    }
</script>

<template>
    <div>
        <Head :title="product.name" />
        <MainNavCustom/>
        <div id="product_detail">
            <div class="box-detail-product">
                <p>
                    <a :href="route('home')">Inicio</a> / {{ product.class_category.name }} {{ product.subcategory ? product.subcategory.name : '' }} / {{ product.name }}
                </p>

                <div class="container-image">
                    <div class="img-left">
                        <!-- <img :src="product.image" alt=""> -->
                        <CarouselSplideGallery :product="product"></CarouselSplideGallery>
                    </div>
                    <div class="data-right">
                        <p class="text-product-small">{{ product.class_category.name }}</p>
                        <p class="text-product">{{ product.name }}</p>
                        <p class="text-price">S/. {{ product.price }}</p>
                        <p class="text-product-small">{{ product.name }}</p>

                        <!-- <p class="text-product-small">{{ product.description }}</p> -->
                        <div class="box-shop-button">
                            <a class="button-show" @click="openGetInfoByWhatsapp(product)">Comprar</a>
                            
                            <div class="box-button-general">
                                <div class="box-button-more">
                                    <button class="button-show-add mobile" @click.stop="addToCart(product.id)"><img :src="iconMore"></button>
                                    <button class="button-show-add desktop" @click.stop="addToCart(product.id)"><img :src="iconMore">Añadir al carrito</button>
                                </div>
                            </div>
                        </div>
                        <section class="container-questions">
                            <section class="form-container-body first-section">
                                <div class="border-box">
                                    <div class="chevron-down" @click="descriptionProduct=!descriptionProduct">
                                        <h4 class="title-questions">INFORMACIÓN DEL PRODUCTO</h4>
                                        <div class="background-circle"> <img class="chevron-icon" v-bind:class="[ descriptionProduct ? 'rotatechev' : '']" :src="chevronDownRed" ></div>
                                    </div>
                                    <div class="questions-general" v-show="descriptionProduct">
                                        <p class="detail-answer">{{ product.description }}</p>                       
                                    </div>
                                </div>
                            </section>
                        </section>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <Footer />
</template>



<style lang="scss" scoped>
    *{
        font-family: "Montserrat", sans-serif;
    }
    .data-right{
        position: relative;
        
    }
</style>
