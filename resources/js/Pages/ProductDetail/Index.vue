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
    import { computed } from 'vue';


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
        },
        methods:{
            openGetInfoByWhatsapp(product) {
                const phoneNumber = '51992855313'; 
                const message = encodeURIComponent(this.generateWhatsAppMessage(product));
                const whatsappURL = `https://wa.me/${phoneNumber}?text=${message}`;

                window.open(whatsappURL, '_blank');
            },
            generateWhatsAppMessage(product) {
                console.log(product)
                let price = Number(product.price);

                let message = `\u{1F6D2} Esta es tu compra:\n\n`;
                message += `\uD83D\uDD22 ${product.name} - Cantidad: ${product.quantity} - Precio: S/ ${!isNaN(price) ? price.toFixed(2) : '0.00'}\n`;

                let total = Number(product.price) * Number(product.quantity);
                message += `\n\u{1F4B0} Total: S/ ${!isNaN(total) ? total.toFixed(2) : '0.00'}`;
                return message;
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

            if(props.cart){
                store.initializeCart(props.cart)
            }

            return { toast,      
                cart: props.cart, 
                onAddCart: store.addToCart,
                setCarts: store.initializeCart
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
