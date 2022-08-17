<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">{{ route.name }}</h4>
            <div class="container">
              <div class="row">

              </div>
            </div>
            <!-- <p class="card-category">Here is a subtitle for this table</p> -->
          </div>
          <div class="card-body">
            <Table
              color="primary"
              :data="users"
              :totalRows="total"
              :columns="columns"
              :fetchData="fetchData"
              :config="config"
              :selectedCheckboxes="false"
            >
            </Table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import { mapActions } from "vuex";
// import { computed, reactive } from "vue";
// import { useStore } from "vuex";
// import Swal from "sweetalert2";
export default {
  setup() {
    // const store = useStore();
    // let searchForm = reactive({
    //   name: "",
    //   email: "",
    // });
    // const config = {
    //   perPage: 10,
    //   offset: 0,
    // };
    // const columns = [
    //   {
    //     field: "id",
    //     label: "ID",
    //   },
    //   {
    //     field: "name",
    //     label: "Nombre",
    //   },
    //   {
    //     field: "email",
    //     label: "Email",
    //   },
    // ];
    // let form = reactive({
    //   name: "",
    //   email: "",
    //   password: "",
    // });
    // const fetchData = (message = false) => {
    //   store.dispatch("auth/fetchUsers").then((response) => {
    //     if (message) Swal.fire("Se actualizo la lista correctamente.");
    //   });
    // };
    // const closeModal = () => {
    //   $("#modal-add-user").modal("hide");
    // };
    // const saveUser = async () => {
    //   await store
    //     .dispatch("auth/saveUser", form)
    //     .then((response) => {
    //       fetchData(true);
    //       Swal.fire("Guardado correctamente!");
    //       $("#modal-add-user").modal("hide");
    //       form.name = "";
    //       form.email = "";
    //       form.password = "";
    //     })
    //     .catch((error) => {
    //       // console.log(error);
    //       Swal.fire("Ocurrio un error al guardar el usuario.");
    //     });
    // };
    // return {
    //   //   users: computed(() => store.state.auth.users),
    //   //   total: computed(() => store.getters["auth/total"]),
    //   //   columns,
    //   //   config,
    //   //   route: computed(() => store.state.route),
    //   //   fetchData,
    //   //   searchForm,
    //   //   saveUser,
    //   //   form,
    //   //   closeModal,
    // };
  },
  mounted() {
    // this.fetchData();
  },
};
</script>

<style>
.input-group {
  margin: 0 !important;
  height: 80%;
}

@media screen and (max-width: 985px) {
  .input-group {
    margin-bottom: 15px !important;
  }
}
</style>
