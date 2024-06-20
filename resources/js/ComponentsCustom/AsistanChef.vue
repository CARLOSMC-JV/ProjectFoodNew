<script>  
    import iconChef from '../../img/chef_icon.png';
    import { ref } from 'vue';
    import iconWhatsapp from '../../img/icons/icon-whatsapp.svg';

    export default {
        name: "helpAsistant",
        data() {
            return{
                iconChef,
                iconWhatsapp,
                showNetworkSocial: false
            }
        },
        methods: {
            openNetworkSocial(){
                this.showNetworkSocial=true
            },
            openWhatsapp() {
                const whatsappurl = `https://api.whatsapp.com/send?phone=51947378352`;
                window.open(whatsappurl, "_blank");
            },
        },
        setup() {
            const isActive = ref(false);

            const animateText = () => {
            isActive.value = !isActive.value;
            };

            return {
            isActive,
            animateText,
            };
        },
    };
</script>
<template>
    <div class="chef">
        <!-- <h2>Hola mundo</h2> -->
        <div class="box-help">
            <div class="text"><p>¡Hola! Somos la casa de los ravioles. Si necesitas ayuda con tu pedido, ¡estamos listos para ayudarte!</p></div>

            <div class="image-chef"><img @click="animateText" :src="iconChef"></div>
            
            <div :class="['animated-text', { active: isActive }]">

                <img class="img-what" :src="iconWhatsapp" @click="openWhatsapp()">
            </div>
        </div>

    </div>
</template>

<style lang="scss">
    .chef{
        .box-help{
            position: fixed;
            display: flex;
            bottom: 8%;
            right: 2%;
            .img-what{
                cursor: pointer;
            }
        }

    }

    .animated-text {
        position: absolute;
        right: 10%;
        width: 50px;
        height: 50px;
        background-color: #fff;
        box-shadow: 0 3px 12px rgba(0, 0, 0, .15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: translateY(0);
        transition: opacity 0.5s ease, transform 0.5s ease;
        background: #0bd561;
        padding: 0.4rem;
    }

    .animated-text.active {
        opacity: 1;
        transform: translateY(-70px);
    }
</style>
