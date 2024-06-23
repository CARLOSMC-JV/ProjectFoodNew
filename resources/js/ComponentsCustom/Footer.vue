<template>
  <div>
    <footer class="cs-footer">
      <div class="box-general-footer">
        <div class="box-footer">
          
          <div class="box-about">
            <div>
              <h2 class="text-about">Contacto</h2>
            </div>
            <div class="subtitle">
              <span class="text-sub">La casa de los ravioles</span>
              <span class="text-sub">Lima - Perú</span>
              <span class="text-sub">pedidos@lacasadelosravioles.pe</span>
              <span class="text-phone">(01) 435 4036</span>
              <div class="box-icons-network">
                <img class="img-icon" @click="openPageFb()" :src="iconFB" alt="">
                <img class="img-icon" @click="openPageInstagram()"  :src="iconInstagram" alt="">
                <img class="img-icon" @click="openWhatsapp()" :src="iconWhatsapp" alt="">
                <img class="img-icon" :src="iconYoutube" alt="">
              </div>
            </div>
          </div>

          <div class="box-about">
            <div>
              <h2 class="text-about">Acerca de</h2>
            </div>
            <div class="subtitle">
              <span class="text-sub" @click="redirectToShop()">Tiendas</span>
              <span class="text-sub">Términos y condiciones</span>
              <span class="text-sub">Política de privacidad</span>
            </div>
          </div>

          <div class="box-about">
            <div>
              <h2 class="text-about">Medios de pago</h2>
            </div>
          </div>

        </div>

        
      </div>
      <div class="box-general-footer-m">
        <div class="box-footer-mobile">
            <div class="box-about">
              <div>
                <h2 class="text-about">Contacto</h2>
              </div>
              <div class="subtitle">
                <span class="text-sub">La casa de los ravioles</span>
                <span class="text-sub">Lima - Perú</span>
                <span class="text-sub">pedidos@lacasadelosravioles.pe</span>
                <span class="text-phone">(01) 435 4036</span>
                <div class="box-icons-network">
                  <img class="img-icon" @click="openPageFb()" :src="iconFB" alt="">
                  <img class="img-icon" @click="openPageInstagram()" :src="iconInstagram" alt="">
                  <img class="img-icon" @click="openWhatsapp()" :src="iconWhatsapp" alt="">
                  <img class="img-icon" :src="iconYoutube" alt="">
                </div>
              </div>

              <div class="box-cash">
                <h2 class="text-about">Medios de pago</h2>
              </div>
            </div>

            <div class="box-about">
              <div>
                <h2 class="text-about-2">Acerca de</h2>
              </div>
              <div class="subtitle-2">
                <span class="text-sub" @click="redirectToShop()">Tiendas</span>
                <span class="text-sub">Términos y condiciones</span>
                <span class="text-sub">Política de privacidad</span>
              </div>
            </div>
        </div>
      </div>
    </footer>

  </div>
</template>

<script>
  import iconFB from '../../img/fb_icon.png';
  import iconInstagram from '../../img/instagram_icon.png';
  import iconWhatsapp from '../../img/whatsapp_icon.png';
  import iconYoutube from '../../img/youtube_icon.png';

  export default {
      data() {
        return {
          iconFB,
          iconInstagram,
          iconWhatsapp,
          iconYoutube
        }
      },
      methods:{
        redirectToShop(){
            if (this.$page.url !== '/shop') {
                this.$inertia.visit('/shop');
            }
        },
        openPageFb(){
            const fabeURL = `https://www.facebook.com/LaCasaDeLosRavioles/?locale=es_LA`;

            window.open(fabeURL, '_blank');
        },
        openPageInstagram(){
            const instagramURL = `https://www.instagram.com/la.casa.de.los.ravioles/`;

            window.open(instagramURL, '_blank');
        },
        openWhatsapp() {
          const whatsappurl = `https://api.whatsapp.com/send?phone=51947378352`;
          window.open(whatsappurl, "_blank");
        },
      }
  }
</script>

<style lang="scss" scoped>
.cs-footer{
  background-color: #144220;
}
.box-general-footer{
  padding: 2rem 2.5rem;
  display: none;

}
.box-general-footer-m{
  padding: 1rem;
  .box-footer-mobile{
    display: grid;
    grid-template-columns: 1fr 1fr;
    .box-about{
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      .subtitle-2{
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        .text-sub{
          color: #ffffff;
          font-weight: 400;
          font-size: 0.75rem;
          cursor: pointer;
        }
        .text-phone{
          color: #ffffff;
          font-weight: 600;
          font-size: 1rem;
        }
        .box-icons-network{
          display: flex;
          gap: 0.5rem;
          .img-icon{
            width: 20px;
            height: 20px;
          }
        }
      }
      .subtitle{
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        .text-sub{
          color: #ffffff;
          font-weight: 400;
          font-size: 0.75rem;
        }
        .text-phone{
          color: #ffffff;
          font-weight: 600;
          font-size: 1rem;
        }
        .box-icons-network{
          display: flex;
          gap: 0.5rem;
          .img-icon{
            width: 20px;
            height: 20px;
          }
        }
      }
      .box-cash{
        margin-top: 2rem;
      }
      .text-about{
        color: #ffffff;
        font-weight: 600;
        font-size: 1rem;
      }

      .text-about-2{
        text-align: center;
        color: #ffffff;
        font-weight: 600;
        font-size: 1rem;
      }
      
    }
  }
}
@media (min-width: 768px) {
  .box-general-footer{
    display: flex;
    .box-footer{
      width: 100%;
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      .box-about{
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        .subtitle{
          display: flex;
          flex-direction: column;
          gap: 0.5rem;
          .text-sub{
            cursor: pointer;
            color: #ffffff;
            font-weight: 400;
            font-size: 0.875rem;
          }
          .text-phone{
            color: #ffffff;
            font-weight: 600;
            font-size: 1rem;
          }
          .box-icons-network{
            display: flex;
            gap: 0.5rem;
            .img-icon{
              cursor: pointer;
              width: 20px;
              height: 20px;
            }
          }
        }
        .text-about{
          color: #ffffff;
          font-weight: 600;
          font-size: 1.25rem;
        }
        
      }
    }
  }
  .box-general-footer-m{
    display: none;
  }
  
}
*{
  font-family: "Montserrat", sans-serif;
font-optical-sizing: auto;

font-style: normal;

}
</style>