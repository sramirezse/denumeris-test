<template>
  <div class="bg-loader">
    <img class="animate__animated animate__rotateIn animate__infinite infinite" width="300" src="../../../images/admin/logo.png" alt="">
  </div>
</template>

<script>
import { computed, reactive } from "vue";
import { useStore } from "vuex";
export default {
  props: {},
  setup() {
    const store = useStore();
    return {};
  },
};
</script>

<style>
.lds-ripple {
  display: inline-block;
  position: relative;
  width: 500px;
  height: 500px;
}
.lds-ripple div {
  position: absolute;
  border: 4px solid #fff;
  opacity: 1;
  border-radius: 50%;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
.lds-ripple div:nth-child(2) {
  animation-delay: -0.5s;
}
@keyframes lds-ripple {
  0% {
    top: 360px;
    left: 360px;
    width: 0;
    height: 0;
    opacity: 0;
  }
  4.9% {
    top: 360px;
    left: 360px;
    width: 0;
    height: 0;
    opacity: 0;
  }
  5% {
    top: 360px;
    left: 360px;
    width: 0;
    height: 0;
    opacity: 1;
  }
  100% {
    top: 0px;
    left: 0px;
    width: 720px;
    height: 720px;
    opacity: 0;
  }
}
.bg-loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(62, 61, 61, 0.684);
  z-index: 99999;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
