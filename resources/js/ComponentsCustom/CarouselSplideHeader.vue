<script>
import carousel from 'vue-owl-carousel'
import img01 from '../../img/shop/01.jpg'
import img02 from '../../img/shop/02.jpg'
import img03 from '../../img/shop/03.jpg'
import img04 from '../../img/shop/04.jpg'
import img05 from '../../img/shop/05.jpg'
import img06 from '../../img/shop/06.jpg'
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import '@splidejs/vue-splide/css';
import '@splidejs/vue-splide/css/sea-green';

export default {
    props: {
        categorias: {
            type: Array,
            required: true,
        },
    },
    data(){
        return{
            img01,
            img02,
            img03,
            img04,
            img05,
            img06,
            slides: [
                img01,
                img02,
                img03,
                img04,
                img05,
                img06,
            ],
            splideOptions: {
                perPage: 9,
                autoWidth: true,
                arrows: true,
                breakpoints: {
                    1200: {
                        perPage: 7,
                    },
                    992: {
                        perPage: 7,
                    },
                },
            },
        }
    },
    created(){
        console.log("estos ",this.products)
    },
    components: {
        carousel,
        Splide,
        SplideSlide,
    },
    methods:{
        navigateToCategory(categoryId) {
            this.$inertia.visit(route('classcategory.index', { categoria: categoryId }));
        },
        openGetInfoByWhatsapp(product, event){
                let urlOfProduct="https://bikeperushop.pe/product/bottom-bracket-sram-dub-bsa-68-73mm-a-granel/"
                let customMessage=`Hola+Bicizona+estoy+interesado+en+este+producto *+${product.name}+*%0AURL: %20${urlOfProduct}`
                event.stopPropagation();
                event.preventDefault();

                console.log(product)
                console.log(customMessage)
                let whatsappurl = `https://api.whatsapp.com/send?phone=51992855313&text=${customMessage}`
                window.open(
                    whatsappurl,
                    '_blank' 
                );
        },  
    }
}
</script>

<template>
    <div style="width: 100%;">

        <Splide :options="splideOptions" aria-label="My Favorite Images">
            <SplideSlide v-for="(category_item, category_item__index) in categorias" :key="category_item.id">

                <a class="name-category"
                    @click.prevent="navigateToCategory(category_item.id)">{{ category_item.name }}</a>
            </SplideSlide>
        </Splide>
    </div>
</template>



<style lang="scss">
/* Add your custom styles here */
.thumbnails {
  display: flex;
  margin: 1rem auto 0;
  padding: 0;
  justify-content: center;
}

.thumbnail {
  width: 70px;
  height: 70px;
  overflow: hidden;
  list-style: none;
  margin: 0 0.2rem;
  cursor: pointer;
}

.thumbnail img {
  width: 100%;
  height: auto;
}
.tp-mega-menu-wrapper{
    .row{
        position: relative;
        .menu-box-top{
            width: 80%;
            left: 15%;
            .main-menu{
                .tp-main-menu-content{
                    width: 100%;
                }
            }
        }
    }
}
.splide {
    padding: 0rem;
}
.splide__list{
    align-items: center;
    gap: 1.5rem;
}
.splide__slide {
    display: flex;
    justify-content: center;
    .name-category{
        color: #515253;
        font-weight: 500;
        cursor: pointer;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        &:hover {
            color: #961921;
        }
    }
}
.splide__arrows {
    .splide__arrow:hover:not(:disabled) svg{
        fill: #e46971;

    }
    .splide__arrow--prev {
        transform: translate(-90%, -50%);
        svg{
            fill: #961921;
            width: 1rem;
            left: 0;
            position: absolute;
            :hover{
                fill: #e46971;
            }
        }
    }
    .splide__arrow--next{
        transform: translate(160%, -50%);
        svg{
            fill: #961921;
            width: 1rem;
            left: 0;
            position: absolute;
            :hover{
                fill: #e46971;
            }
        }
    }
}
.splide__pagination {
    display: none;
}
</style>