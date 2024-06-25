
<script>
    import CarouselProducts from '@/ComponentsCustom/CarouselProducts.vue';
    import { useStore } from '@/store';
    import iconMore from '../../img/more-icon.png';
    import  {useToast}  from 'vue-toastification';
    import axios from 'axios';
    import { computed } from 'vue';
    import imgCapelleti from '../../img/categories_food/capelletti.webp';
    import imgGnocchi from '../../img/categories_food/gnocchi.webp';
    import imgLasagna from '../../img/categories_food/lasagna.webp';
    import imgPastaFresca from '../../img/categories_food/pasta_fresca.webp';
    import imgPastasSecas from '../../img/categories_food/pastas_secas.webp';
    import imgPizzas from '../../img/categories_food/pizzas.webp';
    import imgRavioles from '../../img/categories_food/ravioles.webp';
    import imgSalsas from '../../img/categories_food/salsas.webp';
    import imgVinosLicores from '../../img/categories_food/vinos_licores.webp';
    import CarouselSplideCategories from '@/ComponentsCustom/CarouselSplideCategories.vue';

    export default {
        components:{
            CarouselProducts,
            CarouselSplideCategories
        },
        data() {
            return {
                iconMore
            }
        },
        props:{
            latestProducts: {
                type: Array,
                required: false,
            }
        },
        created(){
        },
        methods:{
            generateWhatsAppMessage(product) {
                console.log(product)
                let message = `\u{1F6D2} Esta es tu compra:\n\n`;
                message += `\uD83D\uDD22 ${product.name} - Cantidad: ${product.quantity} - Precio: S/ ${product.price.toFixed(2)}\n`;
                 
                message += `\n\u{1F4B0} Total: S/ ${product.price.toFixed(2)}`;
                return message;
            },
            openGetInfoByWhatsapp(product) {
                const phoneNumber = '51992855313'; 
                const message = encodeURIComponent(this.generateWhatsAppMessage(product));
                const whatsappURL = `https://wa.me/${phoneNumber}?text=${message}`;

                window.open(whatsappURL, '_blank');
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
            redirectToProductDetails(category, product) {
                console.log(category)
                this.$inertia.visit(route('product.details', { categoria2: category, id: product.id }));
            },
        },
        setup(props) {
            const store = useStore();
            const toast = useToast();
            // store.initializeCart(props.cart);

            store.setLatestProducts(props.latestProducts);
            console.log(store.categories)
            const categories = computed(() => {
                return store.categories.map(category => {
                    // const categoryName = category.name.toLowerCase();

                    switch (category.name) {
                        case 'Capelletti':
                            category.image = imgCapelleti;
                            break;
                        case 'Gnocchi y malfatti':
                            category.image = imgGnocchi;
                            break;
                        case 'Lasagnas':
                            category.image = imgLasagna;
                            break;
                        case 'Ravioles':
                            category.image = imgRavioles;
                            break;
                        case 'Salsas':
                            category.image = imgSalsas;
                            break;
                        case 'Pasta seca al huevo':
                            category.image = imgPastasSecas;
                            break;
                        default:
                            category.image = null; // O una imagen por defecto
                    }
                    return category;
                });
            });

            return {
                latestProducts: store.latestProducts,
                categories,
                toast,
                cart_store: store.cart,
                onAddCart: store.addToCart,
                setCarts: store.initializeCart
            };
        },
    }
</script>

<template>
    <div>
        <section id="category_product">
            <div class="box-title-products">
                <h2 class="title">Productos destacados</h2>
            </div>
            <div class="section-product">
                <div class="list-documents">
                    <div class="box-documents">
        
                        <div class="document-item" v-for="(productByCategoryItem) in latestProducts" :key="productByCategoryItem.id" >
                            <div class="box-data-document">
                                <div class="box-img-data" @click="redirectToProductDetails(productByCategoryItem.class_categories_id, productByCategoryItem)">
                                    <img :src="productByCategoryItem.images.length>0 ? productByCategoryItem.images[0].image_path : productByCategoryItem.image" alt="" class="img-preview">
                                </div>
                                    
                                    
                                <div class="data-product">   
                                    <div class="box-data-general">
                                        <h2 class="title-item" @click="redirectToProductDetails(productByCategoryItem.class_categories_id, productByCategoryItem)">{{productByCategoryItem.name}}</h2>
                                        <h2 class="title-desription">{{productByCategoryItem.description}}</h2> 
                                        <div class="box-price-mobile">
                                            <h2 class="title-price">S/. {{(productByCategoryItem.price).toFixed(2)}}</h2>
                                            <button class="button-buy" @click.stop="openGetInfoByWhatsapp(productByCategoryItem)">Comprar</button>
                                        </div>
                                    </div>
                                    <div class="box-button-general">
                                        <div class="box-button-more">
                                            <button class="button-show" @click.stop="addToCart(productByCategoryItem.id)"><img :src="iconMore"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-price">
                                    <h2 class="title-price">S/. {{(productByCategoryItem.price).toFixed(2)}}</h2>
                                    <button class="button-buy" @click.stop="openGetInfoByWhatsapp(productByCategoryItem)">Comprar</button>
                                </div>
                            </div>
        
                        </div>
                        <div class="box-categories">
                            <h2 class="title-category" :style="{margin: `1.5rem 0rem 1rem 0rem`, padding:`0rem`}">Categorias</h2>
                            <div class="list-categories">
                                <div class="item-category" 
                                v-for="(item_category, item_category__index) in categories" :key="item_category__index"
                                :style="{ backgroundImage: `url(${item_category.image})` }">
                                    <a :href="route('classcategory.index', { categoria: item_category.id })" class="item-link">
                                        <span class="text-name-category">{{item_category.name}}</span>
                                    </a>
                                </div>                                
                            </div>

                            <div class="list-categories-mobile">
                                <CarouselSplideCategories :categories_list="categories"></CarouselSplideCategories>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<style lang="scss" scoped>
*{
    font-family: "Open Sans", sans-serif;

}
</style>

