<template>
    <div class="wrapper">
      <Splide
        aria-labelledby="thumbnail-example-heading"
        :options="mainOptions"
        ref="main"
        class="main-product"
        :isNavigation="true"
      >

          <SplideSlide v-for="(category_item, category_item__index) in categories_list" :key="category_item__index">
            <div class="image-container" @click.prevent="navigateToCategory(category_item.id)">
                <!-- {{ category_item.name }} -->
                <img class="image-category" :src="category_item.image">
            </div>
              
          </SplideSlide>  
        
  
      </Splide>

    </div>
  </template>
  
  <script>
  import { Splide, SplideSlide } from '@splidejs/vue-splide';
  import { defineComponent, onMounted, ref } from 'vue';
  import { VueImageZoomer } from 'vue-image-zoomer'
  import VuePictureSwipe from 'vue3-picture-swipe';
  
  import '@splidejs/vue-splide/css';
  import 'vue-image-zoomer/dist/style.css';
  
  
  // import { generateSlides } from '../utils';
  import img1 from '../../img/categories/01.jpg'
  import img2 from '../../img/categories/02.jpg'
  import img3 from '../../img/categories/03.jpg'
  import img4 from '../../img/categories/04.jpg'
  // import lupa from '../../img/icons/lupa.png'
  
  
  export default defineComponent( {
    name: 'ThumbnailsExample',
  
    components: {
      Splide,
      SplideSlide,
      VueImageZoomer,
      VuePictureSwipe
    },
    data() {
      return {
        showGallery: false,
        selectedIndex: 0,
        galleryImages: [],
        isMagnifierVisible: false,
        magnifierIndex: 0,
      };
    },
    methods: {
      openGallery(index) {
        console.log(index)
        this.selectedIndex = index;
        this.showGallery = true;
      },
      closeGallery() {
        this.showGallery = false;
      },
      prevImage() {
        if (this.selectedIndex > 0) {
          this.selectedIndex--;
        } else {
          this.selectedIndex = this.galleryImages.length - 1;
        }
      },
      nextImage() {
        if (this.selectedIndex < this.galleryImages.length - 1) {
          this.selectedIndex++;
        } else {
          this.selectedIndex = 0;
        }
      },
      navigateToCategory(categoryId) {
            this.$inertia.visit(route('classcategory.index', { categoria: categoryId }));
        },
    },
  
    props:{
        categories_list: Array,
    },
  
    created(){
      
    },
  
    setup() {
      const main   = ref();
      const thumbs = ref();
      const slides = [
          { image: img1, thumbnail: img1, alt: 'Product 1' },
          { image: img2, thumbnail: img2, alt: 'Product 2' },
          { image: img3, thumbnail: img3, alt: 'Product 3' },
          { image: img4, thumbnail: img4, alt: 'Product 4' },
          // Add more products as needed
      ]
  
       
      const mainOptions = {
        type: 'slide',
        perPage: 2,
        gap: '1rem',
        pagination: false,
        autoWidth: true,
        rewind: true
      };
  
      const thumbsOptions = {
        type        : 'slide',
        rewind      : true,
        gap         : '1rem',
        arrows: false,
        pagination  : true,
        autoWidth: false,
  
        fixedWidth  : 70,
        fixedHeight : 70,
        cover       : true,
        focus       : 'center',
        isNavigation: true,
        updateOnMove: true,
      };
  
      onMounted( () => {
        const thumbsSplide = thumbs.value?.splide;
  
        if ( thumbsSplide ) {
          main.value?.sync( thumbsSplide );
        }
      } );
  
      return {
        slides,
        main,
        thumbs,
        mainOptions,
        thumbsOptions,
      }
    },
  } );
  </script>
  
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
  
  .gallery-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    padding: 1.5rem 0rem;
    z-index: 1000;
  }
  
  .gallery-content {
    display: flex;
    align-items: center;
    position: relative;
    max-width: 90%;
    max-height: 100%;
  }
  
  .gallery-content img {
    width: 100%;
    height: auto;
  }
  
  .gallery-button-left {
    position: absolute;
  
    left: 10px;
    top: 50%;
  }
  
  .gallery-button-rigth {
    position: absolute;
  
    right: 10px;
    top: 50%;
  }
  /* .gallery-button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: #fff;
    border: none;
    padding: 10px;
    cursor: pointer;
    font-size: 16px;
  } */
  .gallery-modal .gallery-close {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #fff;
    border: none;
    padding: 10px;
    cursor: pointer;
    font-size: 16px;
  }
  
  .image-container {
    position: relative;
    display: inline-block;
    .image-category {
        height: 10rem;

    }
  }
  
  @media (min-width: 768px) {
    .gallery-content{
      display: initial;
    }
    .image-container {
        position: relative;
        display: inline-block;
        .image-category {
            height: 19rem;

        }
    }
    .gallery-content img{
      height: 100%;
    }
  }
  </style>