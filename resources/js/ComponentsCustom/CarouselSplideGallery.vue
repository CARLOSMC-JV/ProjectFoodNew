<template>
  <div class="wrapper">
    <Splide
      aria-labelledby="thumbnail-example-heading"
      :options="mainOptions"
      ref="main"
      class="main-product"
      :isNavigation="true"
    >
      <template v-if="product.images.length>0">
        <SplideSlide v-for="(product_item, product__index) in product.images" :key="product__index">
          <div class="image-container" @click.passive="openGallery(product__index)">

            <vue-image-zoomer 
            :regular="product_item.image_path" 
            :zoom="product_item.image_path" 
            :zoom-amount="2" 
            :click-zoom="false"
            />
          </div>
          
        </SplideSlide>
      </template>

      <template v-else>          
        <SplideSlide>
          <div class="image-container" @click.passive="openGallery(0)">
            <vue-image-zoomer 
              :regular="product.image" 
              :zoom="product.image" 
              :zoom-amount="2" 
              :click-zoom="false"
            />
          </div>
            
        </SplideSlide>
      </template>

    </Splide>

    <Splide
      aria-label="The carousel with thumbnails. Selecting a thumbnail will change the main carousel"
      :options="thumbsOptions"
      ref="thumbs"
      class="thumbnails"
    >

      <template v-if="product.images.length>0">
        <SplideSlide v-for="(product_item, product__index) in product.images" :key="product__index">
          <img :src="product_item.image_path">
        </SplideSlide>
      </template>

      <template v-else>          
        <SplideSlide>
          <img :src="product.image">
        </SplideSlide>
      </template>
    </Splide>

    <div v-if="showGallery" class="gallery-modal" @click="closeGallery">
      <div class="gallery-content" @click.stop>
        <img class="img-product" :src="galleryImages[selectedIndex].src" :alt="galleryImages[selectedIndex].alt">
        <button class="gallery-button-left" @click="prevImage"><img :src="iconChevronLeft"></button>
        <button class="gallery-button-rigth" @click="nextImage"><img :src="iconChevronRigth"></button>
      </div>
      <button class="gallery-close" @click="closeGallery"><img :src="iconCloseRed"></button>

    </div>
  </div>
</template>

<script>
import { Splide, SplideSlide } from '@splidejs/vue-splide';
import { defineComponent, onMounted, ref } from 'vue';
import { VueImageZoomer } from 'vue-image-zoomer'
import VuePictureSwipe from 'vue3-picture-swipe';
import iconChevronLeft from '../../img/icons/chevron-left.png';
import iconChevronRigth from '../../img/icons/chevron-rigth.png';
import iconCloseRed from '../../img/icons/close-icon-red.svg';
import '@splidejs/vue-splide/css';
import 'vue-image-zoomer/dist/style.css';

import img1 from '../../img/categories/01.jpg'
import img2 from '../../img/categories/02.jpg'
import img3 from '../../img/categories/03.jpg'
import img4 from '../../img/categories/04.jpg'


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
      iconChevronLeft,
      iconChevronRigth,
      iconCloseRed
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
    }
  },

  props:{
    product: Object,
  },

  created(){
    console.log(this.product)
    this.galleryImages = this.product.images.map(image => ({
      src: image.image_path,
      alt: image.alt, 
    }));
  },

  setup() {
    const main   = ref();
    const thumbs = ref();
    const slides = [
        { image: img1, thumbnail: img1, alt: 'Product 1' },
        { image: img2, thumbnail: img2, alt: 'Product 2' },
        { image: img3, thumbnail: img3, alt: 'Product 3' },
        { image: img4, thumbnail: img4, alt: 'Product 4' },
    ]

     
    const mainOptions = {
      type      : 'slide',
      perPage   : 1,
      perMove   : 1,
      gap       : '1rem',
      pagination: false,
      autoWidth: false,
      focus: 'center',

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

<style>
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
  align-items: center;
}

.gallery-content {
  display: flex;
  justify-content: center;
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
  width: 25px;
  left: 10px;
  top: 48%;
}

.gallery-button-rigth {
  position: absolute;
  width: 25px;
  right: 10px;
  top: 48%;
}
.gallery-modal .gallery-close {
  position: absolute;
  top: 60px;
  right: 10px;
  background: transparent;
  border: none;
  padding: 10px;
  cursor: pointer;
  font-size: 16px;
}

.image-container {
  position: relative;
  display: inline-block;
}
.image-container .vh--message{
  display: none;
}
.gallery-modal .gallery-close img{
    width: 30px;
  }

@media (min-width: 768px) {
  .gallery-modal .gallery-close {
    top: 20px;
  }
  
  .gallery-content .img-product{
    height: 100%;
    width: 65%;
  }
}
</style>