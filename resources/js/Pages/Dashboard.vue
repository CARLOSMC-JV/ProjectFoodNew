<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import HeroSlider from "@/ComponentsCustom/HeroSlider.vue";
import HeroSlider2 from "@/ComponentsCustom/HeroSlider2.vue";
import MainNav3 from "@/ComponentsCustom/MainNav3.vue";
import MainNavCustom from "@/ComponentsCustom/MainNavCustom.vue";
import ListProductsMain from "@/ComponentsCustom/ListProductsMain.vue";
import FooterVue from "@/ComponentsCustom/Footer.vue";
import PopularCategories from "@/ComponentsCustom/PopularCategories.vue";
import LoadingSpinner from "@/ComponentsCustom/LoadingSpinner.vue";
import axios from 'axios';
import { computed } from 'vue';

import { useStore } from '@/store';

export default {
    props: {
        latestProducts: {
            type: Array,
            required: false,
        },
        allProducts: {
            type: Array,
            required: false,
        },
        categories: {
            type: Array,
            required: true,
        },
        cart: {
            type: Array,
            required: false,
            default: () => [],   
        },
        isFirstVisit: {
            type: Boolean,
            required: true,
        },
    },
    head() {
        return {
            title: 'Título de tu página',
            link: [
                {
                rel: 'icon',
                type: 'image/x-icon',
                href: 'https://res.cloudinary.com/drza9lfnl/image/upload/v1717364627/logo/logo_food_yefp0z.png' 
                }
            ]
        };
    },
    data(){
        return{
            isLoading: true,
            suggestions: []
        }
    },
    created(){
        
        // this.fetchProducts()
    },
    mounted() {
        const store = useStore();
        if (this.isFirstVisit) {
            setTimeout(() => {
                store.setLoading(false);
            }, 1500);
        } else {
            store.setLoading(false);
        }
    },
    methods:{
        async fetchProducts(){
            await axios.get('/api/products')
            .then((response) => {
                this.products = response.data;
                console.log(this.products)
            }).catch(error => {
                console.error("Hubo un error al cargar los productos:", error);
            });
        },
        finishLoading() {
            const store = useStore();
            store.setLoading(false);
        },
        searchProducts(event) {
            const query = event.target.value.toLowerCase();
            if (query.length > 2) { 
                this.suggestions = this.products.filter(product => 
                    product.name.toLowerCase().includes(query)
                );
            } else {
                this.suggestions = [];
            }
        },
    },
    components:{
        Head,
        AuthenticatedLayout,
        HeroSlider,
        HeroSlider2,
        MainNav3,
        MainNavCustom,
        ListProductsMain,
        FooterVue,
        PopularCategories,
        LoadingSpinner,

    },
    setup(props) {
        const store = useStore();
        
        store.initializeCart(props.cart);

        store.setLatestProducts(props.latestProducts);
        console.log("latestProducts ",props.latestProducts)
        store.setAllProducts(props.allProducts);
        store.setCategories(props.categories);

        store.setLoading(props.isFirstVisit);

        const isLoading = computed(() => store.isLoading);


        return {
            latestProducts: store.latestProducts,
            allProducts: store.allProducts,
            categories: store.categories,
            cart: store.cart,
            isLoading
        };
    },
}
</script>

<template>
    <Head title="LA CASA DE LOS RAVIOLES" />
    <div class="box-general" v-if="!isLoading">

        <MainNavCustom :latestProducts="latestProducts"/>
        
        <HeroSlider2/>
        <ListProductsMain :latest-products="latestProducts"/>
        <FooterVue />
        <AsistanChef />
    </div>
    <LoadingSpinner v-else />

</template>
