<template>
    <div id="loading">
         <div id="loading-center">
            <div id="loading-center-absolute">
               <!-- loading content here -->
               <div class="tp-preloader-content">
                    
                    <img src="../../img/logo/logo_food.png" alt="">
                    <h3 class="tp-preloader-title">La Casa de los Ravioles</h3>
                    <div class="tp-preloader-logo">
                        <div class="tp-preloader-circle">
                            <svg width="190" height="190" viewBox="0 0 380 380" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle stroke="#D9D9D9" cx="190" cy="190" r="180" stroke-width="6" stroke-linecap="round"></circle> 
                                <circle stroke="red" cx="190" cy="190" r="180" stroke-width="6" stroke-linecap="round"></circle> 
                            </svg>
                        </div>
                    </div>
               </div>
            </div>
         </div>  
      </div>
  </template>
  
  <script>
  export default {
    name: 'LoadingSpinner',
  };
  </script>
  
  <style scoped>
  .loading-spinner {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: white;
    z-index: 9999;
  }
  #loading-center {
  width: 100%;
  height: 100%;
  position: relative;
}

#loading-center-absolute {
  position: absolute;
  left: 50%;
  top: 50%;
  width: 25%;
  transform: translate(-50%, -50%);
}

@media only screen and (min-width: 1200px) and (max-width: 1399px) {
  #loading-center-absolute {
    width: 40%;
  }
}
@media only screen and (min-width: 992px) and (max-width: 1199px) {
  #loading-center-absolute {
    width: 40%;
  }
}
@media only screen and (min-width: 768px) and (max-width: 991px) {
  #loading-center-absolute {
    width: 45%;
  }
}
@media only screen and (min-width: 576px) and (max-width: 767px) {
  #loading-center-absolute {
    width: 50%;
  }
}
@media (max-width: 575px) {
  #loading-center-absolute {
    width: 90%;
  }
}
#loading {
  background-color: #fff;
  height: 100%;
  width: 100%;
  position: fixed;
  z-index: 999999;
  margin-top: 0px;
  top: 0px;
}

#loading-center {
  width: 100%;
  height: 100%;
  position: relative;
}

#loading-center-absolute {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

.tp-preloader-logo {
  width: 60px;
  height: 60px;
  line-height: 180px;
  position: relative;
  text-align: center;
  margin: auto;
}
.tp-preloader-circle {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
.tp-preloader-circle svg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  -webkit-animation: tp-rotate 5s linear infinite;
  -moz-animation: tp-rotate 5s linear infinite;
  -ms-animation: tp-rotate 5s linear infinite;
  -o-animation: tp-rotate 5s linear infinite;
  animation: tp-rotate 5s linear infinite;
}
.tp-preloader-circle svg circle:last-child {
  stroke: #961921;
  stroke-dashoffset: 0;
  stroke-dasharray: 1128, 3150;
  -webkit-animation: tp-loading 4s linear infinite;
  -moz-animation: tp-loading 4s linear infinite;
  -ms-animation: tp-loading 4s linear infinite;
  -o-animation: tp-loading 4s linear infinite;
  animation: tp-loading 4s linear infinite;
  transform-origin: center center;
}
@-webkit-keyframes tp-loading {
  0% {
    stroke-dashoffset: 0;
    stroke-dasharray: 0, 3150;
  }
  100% {
    stroke-dashoffset: -1131;
    stroke-dasharray: 1128, 3138;
  }
}
@-moz-keyframes tp-loading {
  0% {
    stroke-dashoffset: 0;
    stroke-dasharray: 0, 3150;
  }
  100% {
    stroke-dashoffset: -1131;
    stroke-dasharray: 1128, 3138;
  }
}
@-ms-keyframes tp-loading {
  0% {
    stroke-dashoffset: 0;
    stroke-dasharray: 0, 3150;
  }
  100% {
    stroke-dashoffset: -1131;
    stroke-dasharray: 1128, 3138;
  }
}
@keyframes tp-loading {
  0% {
    stroke-dashoffset: 0;
    stroke-dasharray: 0, 3150;
  }
  100% {
    stroke-dashoffset: -1131;
    stroke-dasharray: 1128, 3138;
  }
}
@-webkit-keyframes tp-rotate {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes tp-rotate {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-ms-keyframes tp-rotate {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes tp-rotate {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
.tp-preloader-content {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    text-align: center;
}
.tp-preloader-title {
color: #961921;
  font-size: 20px;
  font-weight: 500;
  line-height: 1;
  margin-bottom: 0px;
}
@media (max-width: 575px) {
  .tp-preloader-title {
    font-size: 70px;
  }
}
.tp-preloader-subtitle {
  font-size: 16px;
  margin-bottom: 0;
  color: var(--tp-common-black);
}
  </style>
  