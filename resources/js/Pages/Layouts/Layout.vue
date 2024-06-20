<template>
    <div class="box-general" v-if="!isLoading">
      <MainNavCustom :latestProducts="latestProducts" />
      <router-view :latest-products="latestProducts" />
      <FooterVue />
      <AsistanChef />
    </div>
    <LoadingSpinner v-else />
  </template>
  
  <script>
  import MainNavCustom from "@/ComponentsCustom/MainNavCustom.vue";
  import FooterVue from "@/ComponentsCustom/Footer.vue";
  import AsistanChef from "@/ComponentsCustom/AsistanChef.vue";
  import LoadingSpinner from "@/ComponentsCustom/LoadingSpinner.vue";
  
  export default {
    props: {
      latestProducts: {
        type: Array,
        required: false,
      },
    },
    data() {
      return {
        isLoading: true,
      };
    },
    mounted() {
      setTimeout(() => {
        this.isLoading = false;
      }, 1500);
    },
    components: {
      MainNavCustom,
      FooterVue,
      AsistanChef,
      LoadingSpinner,
    },
  };
  </script>
  
  <style scoped>
  /* Tus estilos aquí */
  </style>
  