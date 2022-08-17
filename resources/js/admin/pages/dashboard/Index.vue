<template>
  <div class="container-fluid">
    <h1>Hola mundo</h1>
  </div>
</template>

<script>
import { computed, reactive } from "vue";
import { useStore } from "vuex";
export default {
  components: {
  },
  setup() {
    const store = useStore();


    return {

    };
  },
  mounted() {
  },
};
</script>

<style>
</style>
