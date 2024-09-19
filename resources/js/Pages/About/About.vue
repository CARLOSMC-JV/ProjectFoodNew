<script>
    import familiaImg from "@/../img/about/familia.webp";
    import AboutImg from "@/../img/about/quienes-somos-web.png";
    import AboutImgMobile from '@/../img/about/quienes_somos_movil.png'

    import manosImg from "@/../img/about/manos.webp";
    import firmaPageCasa from "@/../img/about/firma_page_casa.png";
    import MainNavCustom from "@/ComponentsCustom/MainNavCustom.vue";
    import Footer from "@/ComponentsCustom/Footer.vue";
    import { Head } from '@inertiajs/vue3';
    export default{
        data() {
            return {
                familiaImg,
                manosImg,
                AboutImg,
                firmaPageCasa,
                AboutImgMobile
            }
        },
        props:{
            class_category: {type: String}
        },
        components:{
            MainNavCustom,
            Footer,
            Head
        },
    }
</script>

<template>
    <Head title="Quienes Somos" />

    <MainNavCustom :category-active="class_category"/>
    <div class="general-about">
        <div class="img-header">
            <img class="img-desktop" :src="AboutImg">
            <img class="img-mobile" :src="AboutImgMobile">
        </div>
        <div class="information-page">
            <div class="text-about">
                <p>
                    La Casa de los Ravioles, fundada en 1974 por Giorgio
                    Chiamulera, su esposa Anna María de Chiamulera, ambos
                    de nacionalidad Italiana, fue creada con el propósito de
                    transmitir a través de una innovadora propuesta toda la
                    cultura y el arte de la cocina Italiana , la Pasta fresca,
                    salsas, fideos , lasagnas ,fueron un sueño que se convertía
                    en realidad en su primer local del C.C Monterrico.                    
                </p>
                <br>
                <p>
                    Estos primeros productos, elaborados con recetas
                    originales , procesos manuales junto con una dedicación
                    especial ,lograron en sus inicios una calidad excepcional
                    ARTESANAL y aceptación de sus primeros clientes .
                </p>
            </div>
            <div class="box-img">
                <img :src="manosImg">
            </div>
        </div>

        <div class="box-red-history">
            <p>
                Poco a poco a través de los años, los clientes satisfechos iban en aumento, lo que derivó en la modernización de los procesos
                productivos siempre con la visión de mantener el estándar y originalidad artesanal de sus productos, es por ello que se
                adquirieron maquinarias que nos ayudaran con estos procesos y hacerlos mas agiles.
            </p>
            <br>
            <p>
                A través de estos primeros 50 años , La Casa de los Ravioles ha venido creciendo de la mano de sus clientes que son nuestra
                principal razón de ser , siempre con el compromiso de una atención personalizada, esfuerzo ,calidad y servicio post venta .
                Actualmente La Casa de los Ravioles es una empresa familiar, cuenta con 4 locales en las zonas de Monterrico , Camacho , La
                Molina y Chacarilla , además de las plataformas de envió propio y delivery tercerizado.            
            </p>
            
            <div class="box-firma">
                <img :src="firmaPageCasa" class="firma-page">
            </div>
        </div>
    </div>
    <Footer />

</template>

<style lang="scss">
.general-about{
    .img-header{
        img{
            width: 100%;
            height: initial;
        }
        .img-desktop{
            display: none;
        }
        .img-mobile{
            display: flex;
        }
    }
    .information-page{
        display: flex;
        flex-direction: column;
        padding: 1.5rem;
        gap: 3rem;
        .text-about{
            font-size: 1rem;
            p{
                color: #39393a;
            }
        }
    }
    .box-red-history{
        background: #961921;
        padding: 1.5rem 2rem 3rem 2rem;
        p{
            color: #ffffff;
            font-weight: 300;
        }
        .box-firma{
            display: flex;
            justify-content: flex-end;
            margin-top: 2rem;
        }
    }
}

@media (min-width: 768px) {
    .general-about{
        .img-header{
            img{
                width: 100%;
            }
            .img-desktop{
                display: flex;
            }
            .img-mobile{
                display: none;
            }
        }
        .information-page{            
            display: grid;
            padding: 3rem 4rem;
            grid-template-columns: repeat(2, 1fr);
            .text-about{
                display: flex;
                flex-direction: column;
                justify-content: center;
                font-size: 1.25rem;
            }
        }
        .box-red-history{
            padding: 1.5rem 4rem 3rem 4rem;
            font-size: 1.25rem;
        }
    }
}
</style>