<template>
    
    <transition name="modal-animation">
        
        <div v-show="modalActive" class="modal-receta">
            <div class="base-modal-background" @click="closeByBackground()"></div>
            <transition name="modal-animation-inner">
                <div v-show="modalActive" class="modal-inner-receta">
                    <button @click="close" type="button" class="btn-close"><img :src="iconCloseRed"></button>
                    <slot />
                </div>
            </transition>
        </div>
    </transition>
</template>

<script>
    import iconCloseRed from '../../img/icons/close-icon-red.svg';

    export default{
        data() {
            return {
                iconCloseRed
            }
        },
        props:{
            modalActive: {
                type: Boolean,
                required: false,
            },
            closable: {
                type: Boolean,
                default: false,
            },
            closeOnBackground: {
                type: Boolean,
                default: false,
            },
        },
        methods:{
            closeModal() {
                this.$emit("on-close");
            },
            closeByBackground() {
                if (this.closeOnBackground) {
                    this.$emit("on-close");
                }
            },
        },
        setup(props, {emit}){
            const close = () =>{
                emit('close');
            }

            return {close};
        }
    }
</script>

<style lang="scss" scoped>
 .modal-animation-enter-active, .modal-animation-leave-active {
    transition: opacity .3s cubic-bezier(.52, .02, .19, 1.02);
 }
 .modal-animation-enter-from,
 .modal-animation-leave-to{
    opacity: 0;
 }

 .modal-animation-inner-enter-active{
    transition: all .3s cubic-bezier(.52, .02, .19, 1.02) 0.15s;
 }

 .modal-animation-inner-leave-active{
    transition: all .3s cubic-bezier(.52, .02, .19, 1.02);
 }

 .modal-animation-inner-enter-from{
    opacity: 0;
    transform: scale(0.8);
 }
 .modal-animation-inner-leave-to{
    transform: scale(0.8);
 }

 .modal-receta{
    .base-modal-background{
        background-color: rgba(10, 10, 10, 0.86);
        bottom: 0;
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
    }
    .modal-inner-receta{
        position: relative;
        max-width: 840px;
        width: 90%;
        background-color: #fff;
        padding: 0.5rem;
        height: 90%;
        overflow-y: scroll;

        .modal-content-receta{
            .title-receta{
                text-align: center;
            }
            .title-receta-2{
                text-align: center;
            }
        }

        .btn-close{
            position: absolute;
            right: 10px;
            top: 10px;
            border: none;
            font-size: 16px;
            color: #fff;
            cursor: pointer;
        }
    }

    .modal-inner-receta::-webkit-scrollbar {
        -webkit-appearance: none;
    }
    
    .modal-inner-receta::-webkit-scrollbar:vertical {
        width:9px;
    }
    
    .modal-inner-receta::-webkit-scrollbar-button:increment,.modal-inner-receta::-webkit-scrollbar-button {
        display: none;
    } 
    
    .modal-inner-receta::-webkit-scrollbar:horizontal {
        height: 10px;
    }
    
    .modal-inner-receta::-webkit-scrollbar-thumb {
        background-color: #9c9c9c;
        border-radius: 15px;
        transition: background-color 0.3s ease;
    }

    .modal-inner-receta::-webkit-scrollbar-thumb:hover {
        background-color: #B0B3BA;
    }
    
    .modal-inner-receta::-webkit-scrollbar-track {
        background-color: rgba(128, 128, 128, 0.2);
        border-radius: 10px;  
    }
 }

 @media (min-width: 768px) {
    .modal-receta{
        .modal-inner-receta{
            width: 100%;
            padding: 1.5rem 0rem;
            .modal-content-receta{
                .title-receta{
                    text-align: initial;
                }
                .title-receta-2{
                    text-align: initial;
                }
            }
        }
    }
 }

</style>