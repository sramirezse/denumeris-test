<template>
  <Loader v-show="loading"></Loader>
  <Sidebar v-if="isLoggin === 'true' && route.name != 'not-found'"></Sidebar>
  <main
    class="main-content border-radius-lg"
    v-if="isLoggin === 'true' && route.name != 'not-found'"
  >
    <div class="container-fluid py-4">
      <Header></Header>
      <!-- {{loading}} -->
      <router-view></router-view>
      <Footer></Footer>
    </div>
  </main>

  <main v-else class="page-main">
    <router-view></router-view>
  </main>
</template>

<script>
import { computed } from "vue";
import { useRoute } from "vue-router";
import { useStore } from "vuex";
import { onMounted, onUpdated, onUnmounted } from "vue";
import Sidebar from "./Sidebar.vue";
import Header from "./Header.vue";
import Footer from "./Footer.vue";
export default {
  components: {
    Sidebar,
    Header,
    Footer,
  },
  setup() {
    const route = useRoute();
    const store = useStore();
    const getUser = async () => {
    //   if (store.getters["auth/isLoggedIn"] === "true")
        await store.dispatch("auth/fetchUser");
      // console.log('storimage.pnge lo hice bitch');
    };
    onMounted(() => {
      getUser();
    });
    return {
      index: computed(() => route.meta.index),
      title: computed(() => route.name),
      isLoggin: computed(() => store.getters["auth/isLoggedIn"]),
      route: route,
      loading: computed(() => store.getters["response/loading"]),
    };
  },
};
</script>

<style>
.form-control::placeholder {
  color: #fff;
}
.form-group label {
  color: #fff;
}
.button-primary{
    background-color: #F67965;
    color: white;
}

</style>
