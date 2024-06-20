<script>
    import MainNavCustom from "@/ComponentsCustom/MainNavCustom.vue";
    import Footer from "@/ComponentsCustom/Footer.vue";
    import { Head } from '@inertiajs/vue3';
    import camionIcon from "@/../img/icons/camion.png";
    import relojIcon from "@/../img/icons/reloj.svg";
    import telephoneIcon from "@/../img/icons/telephone.png";

    export default{
        data() {
            return {
                address1: true,
                address2: false,
                address3: false,
                address4: false,
                camionIcon,
                relojIcon,
                telephoneIcon,
                arrayAddress:[
                    {range_hour1: '8am - 6pm', range_hour2: '8:30am - 1:30pm', title: "La casa de los Ravioles - Monterrico", address:"Centro Comercial Monterrico Pasaje la Pascana 186 Monterrico - Santiago de Surco", telephones:[{tele:['01 435 4036', '01 750 6118'], phone:['992 855 313', '998 199 411']}] },
                    {range_hour1: '8am - 6pm', range_hour2: '9am - 1:30pm', title: "La casa de los ravioles - Chacarilla", address:"Pasaje monteverdi 108 Santiago de Surco", telephones:[{tele:['01 492 2779', '01 750 6118'], phone:['919 297 561', '947 378 352']}]},
                    {range_hour1: '9:30am - 6pm', range_hour2: '9:30am - 1:30pm', title: "La casa de los ravioles - Camacho", address:"Centro Comercial Plaza Camacho - Tda 21 B Av. Javier Prado Este 5193 Camacho - La Molina", telephones:[{tele:['01 437 3001'], phone:['947 378 352']}]},
                    {range_hour1: '9:30am - 6pm', range_hour2: '9:30am - 1:30pm', title: "La casa de los ravioles - La Molina", address:"Centro Comercial Arena Mol - Tda 17 Segundo piso, frente al colegio Newton", telephones:[{tele:['01 479 2990'], phone:['983 530 501']}] },
                    {range_hour1: '', range_hour2: '', title: "RAPPI", address:"", telephones:[] },
                    {range_hour1: '', range_hour2: '', title: "PEDIDOS YA", address:"", telephones:[] }
                ],
                activeIndex: null 
            }
        },
        components:{
            MainNavCustom,
            Footer,
            Head
        },
        props:{
            class_category: {type: String}
        },
        methods:{
            handleClick(index) {
                this.activeIndex = index;
                const methodName = `linkAddress${index + 1}`;
                if (typeof this[methodName] === 'function') {
                    this[methodName]();
                }
            },
            linkAddress1(){
                this.address1=true
                this.address2=false
                this.address3=false
                this.address4=false
            },
            linkAddress2(){
                this.address1=false
                this.address2=true
                this.address3=false
                this.address4=false
            },
            linkAddress3(){
                this.address1=false
                this.address2=false
                this.address3=true
                this.address4=false
            },
            linkAddress4(){
                this.address1=false
                this.address2=false
                this.address3=false
                this.address4=true
            }
        },
        computed: {
            isActive() {
                return index => this.activeIndex === index;
            }
        }
    }
</script>

<template>
    <Head title="Tiendas" />

    <MainNavCustom :category-active="class_category"/>
    <div class="box-shop">
        <div class="box-title">
            <h2 class="title-shop">Tiendas</h2>
            <span class="subtitle-shop">Encuentra la tienda de tu preferencia</span>
        </div>
        <div class="data-maps">
            <section class="section-date-time">
                <div class="box-general-date" v-for="(address_item, address_item__index) in arrayAddress" :key="address_item__index">
                    <div class="info-date">
                        <span class="data-red" v-if="address_item__index !== 4 || address_item__index !== 5">Lunes a Sábado</span>
                        <span class="data-green">{{address_item.range_hour1}}</span>
                        <span class="data-red" v-if="address_item__index !== 4 || address_item__index !== 5">Domingos y feriados</span>
                        <span class="data-green">{{address_item.range_hour2}}</span>
                    </div>
                    <div class="box-address" @click="handleClick(address_item__index)" :class="{ 'active': isActive(address_item__index) }">
                        <h2>{{address_item.title}}</h2>
                        <span>{{address_item.address}}</span>
                        <div class="send-hour">
                            <div class="box-hour-home">
                                <div class="box-reloj">
                                    <img :src="relojIcon">
                                    <span  class="show-hour-text" v-if="address_item__index !== 4 || address_item__index !== 5">Ver horarios</span>
                                </div>
                                <div class="box-camion">
                                    <img :src="camionIcon">
                                    <span class="send-home-text" v-if="address_item__index !== 4 || address_item__index !== 5">Envío a domicilio</span>
                                </div>
                            </div>

                            <div>
                                <div v-for="(telephone_item, telephone_item__index) in address_item.telephones" :key="telephone_item__index" class="box-general-tele">
                                    <div class="box-thelephone">
                                        <div>
                                            <img class="img-telephone" :src="telephoneIcon">
                                        </div>
                                        <div class="item-thelephone">
                                            <span class="text-telephone" v-for="(tele_item, tele_item__index) in telephone_item.tele" :key="tele_item__index">{{tele_item}}</span>
                                        </div>
                                    </div>
                                    <div class="box-thelephone">
                                        <div>
                                            <img class="img-telephone" :src="telephoneIcon">
                                        </div>
                                        <div class="item-thelephone">
                                            <span class="text-telephone" v-for="(phone_item, phone_item__index) in telephone_item.phone" :key="phone_item__index">{{phone_item}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section-maps">
                <template v-if="address1">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.0569489953386!2d-76.9740654248582!3d-12.108253943048817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c734e53d6ae1%3A0x1a91c5ff02fc66d9!2sLA%20CASA%20DE%20LOS%20RAVIOLES%20SRL!5e0!3m2!1ses-419!2spe!4v1718895513846!5m2!1ses-419!2spe" width="656" height="1490" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </template>

                <template v-else-if="address2">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.0102323231845!2d-76.99384775977634!3d-12.111451832523898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c75d31f85743%3A0x84b81faa50e96e66!2sLa%20Casa%20de%20los%20Ravioles%20Chacarilla!5e0!3m2!1ses-419!2spe!4v1718898757461!5m2!1ses-419!2spe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </template>

                <template v-else-if="address3">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.468621364826!2d-76.96974342485866!3d-12.080037742521313!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c65501ff215f%3A0x85a93ac3c4fd5472!2sLa%20Casa%20de%20los%20Ravioles!5e0!3m2!1ses-419!2spe!4v1718898817130!5m2!1ses-419!2spe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </template>

                <template v-else-if="address4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.4418082153447!2d-76.9303396370861!3d-12.081877503608093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c7283979a615%3A0x9565d4eb309ff915!2sLa%20Casa%20de%20los%20Ravioles%20cc%20Arena%20Mol!5e0!3m2!1ses-419!2spe!4v1718898906396!5m2!1ses-419!2spe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </template>
            </section>
        </div>
    </div>
    <AsistanChef />

    <Footer />

</template>

<style lang="scss">
    .box-shop{
        padding: 2rem 5rem;
        .data-maps{
            display: flex;
            margin-top: 1.5rem;
            gap: 1rem;
            .section-date-time{
                display: flex;
                flex-direction: column;
                gap: 1rem;
                width: 50%;
                .box-general-date{
                    display: flex;
                    gap: 1rem;
                    .info-date{
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        width: 30%;
                        .data-red{
                            color:#961921;
                        }
                        .data-green{
                            color: #144220;
                        }
                    }
                    .box-address{
                        padding: 1.5rem;
                        background: #e1e1e1;
                        width: 70%;
                        cursor: pointer;
                        h2{
                            font-weight: 600;      
                            font-size: 1.125rem;
                        }
                        span{
                            color: #383838;
                        }
                        &:hover{
                            border: 1px solid #961921;
                        }
                        &.active{
                            border: 1px solid #961921;
                            h2{
                                color: #961921;
                                font-weight: 600;
                            }
                        }
                        .send-hour{
                            display: flex;
                            gap: 1.5rem;
                            margin-top: 1rem;
                            .box-general-tele{
                                display: flex;
                                flex-direction: column;
                                gap: 1rem;
                                .box-thelephone{
                                    display: flex;
                                    gap: 1rem;
                                    align-items: center;
                                    .img-telephone{
                                        width: 25px;
                                    }
                                    .item-thelephone{
                                        display: flex;
                                        flex-direction: column;
                                        .text-telephone{
                                            color: #961921;
                                        }
                                    }
                                }
                            }
                            .box-hour-home{
                                display: flex;
                                flex-direction: column;
                                gap: 0.5rem;
                                .box-reloj{
                                    display: flex;
                                    align-items: center;
                                    gap: 0.5rem;
                                    img{
                                        width: 20px;
                                    }
                                }
                                .box-camion{
                                    display: flex;
                                    align-items: center;
                                    gap: 0.5rem;

                                    img{
                                        width: 20px;
                                    }
                                }
                            }
                            .show-hour-text{
                                color: #961921;  
                                font-weight: 600;
                            }
                            .send-home-text{
                                color: #144220;
                                font-weight: 600;
                            }
                        }
                    }
                }
            }
            .section-maps{
                width: 45%;
                iframe{
                    height: 1100px;
                }
            }
        }
    }
</style>