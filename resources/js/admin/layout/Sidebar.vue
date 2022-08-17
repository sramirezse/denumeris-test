<template>
  <aside
    class="
      sidenav
      navbar navbar-vertical navbar-expand-xs
      border-0 border-radius-xl
      my-3
      fixed-start
      ms-3
      bg-gradient-dark
    "
    id="sidenav-main"
  >
    <div class="sidenav-header">
      <i
        class="
          fas
          fa-times
          p-3
          cursor-pointer
          text-white
          opacity-5
          position-absolute
          end-0
          top-0
          d-none d-xl-none
        "
        aria-hidden="true"
        id="iconSidenav"
      ></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
        <img
          src="../../../images/admin/logo.png"
          class="navbar-brand-img h-200"
          alt="main_logo"
          v-if="screenWidth > 1200"
        />
        <img
          src="../../../images/admin/logo.png"
          class="navbar-brand-img h-200"
          alt="main_logo"
          v-if="screenWidth < 1200"
        />
        <span class="ms-1 font-weight-bold text-sidebar-title">Tablero</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2" />
    <br />
    <div
      class="collapse navbar-collapse w-auto max-height-vh-100"
      id="sidenav-collapse-main"
    >
      <ul class="navbar-nav">
        <li
          :class="actualRoute.path == route.path ? 'active' : ''"
          v-for="(route, index) in routes"
          :key="index"
        >
          <router-link
            class="nav-link text-sidebar-title"
            :class="actualRoute == route.path ? 'bg-gradient-primary' : ''"
            :to="route.path"
          >
            <div
              class="
                text-sidebar-title text-center
                me-2
                d-flex
                align-items-center
                justify-content-center
              "
            >
              <i class="material-icons">{{ route.meta.icon }}</i>
            </div>
            <span class="nav-link-text ms-1"
              ><p>{{ route.name }}</p></span
            >
          </router-link>
        </li>
      </ul>
    </div>

    <div class="sidenav-footer position-absolute w-100 bottom-0">
      <div class="mx-3">
        <a class="btn button-primary mt-4 w-100" @click="logout" href="#" type="button"
          >Salir</a
        >
      </div>
    </div>
  </aside>
</template>

<script>
import { useRoute, useRouter } from "vue-router";
import { computed } from "vue";
import { useStore } from "vuex";
export default {
  props: {},
  setup() {
    const store = useStore();

    const router = useRouter();
    const routes = router.options.routes.filter((route) => route.meta.sidebar);
    // console.log(routes);
    const logout = () => {
      store.dispatch("auth/logout").then(() => {
        window.location.href = "/admin/login";
      });
    };
    const screenWidth = computed(() => {

        return window.innerWidth;
    });
    return {
      store,
      // actualRoute,
      actualRoute: computed(() => {
        const route = useRoute();
        return route;
      }),
      routes,
      logout,
      screenWidth,
    };
  },
};
</script>

<style scoped>
a {
  text-decoration: none;
}
.active a p {
  color: #fff;
}
.slide .active {
  border: 1px solid #ffffff;
  border-radius: 20px;
}
.nav-link span p {
  color: #fff;
}
.active {
  background-color: #f67965;
}
.active span p {
  color: #fff !important;
}
.text-sidebar-title {
  color: #fff;
}
@media (max-width: 1200px) {
  .nav-link span p {
    color: rgb(73, 73, 73);
  }
  .text-sidebar-title {
    color: rgb(73, 73, 73);
  }
}
</style>
