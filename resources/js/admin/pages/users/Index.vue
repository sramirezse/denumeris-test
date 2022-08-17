<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">{{ route.name }}</h4>
            <div class="container">
              <div class="row">
                <div class="col-lg-3 col-md-6">
                  <BaseInput
                    class="ml-2"
                    v-model="searchForm.name"
                    label="Nombre"
                    type="text"
                    @input="fetchData(false)"

                  ></BaseInput>
                </div>
                <div class="col-lg-3 col-md-6">
                  <BaseInput
                    class="ml-2"
                    v-model="searchForm.email"
                    label="Email"
                    type="text"
                    @input="fetchData(false)"
                  ></BaseInput>
                </div>
                <!-- <div class="col-lg-3 pt-1 mt-4  col-md-6">
                  <button
                    type="button"
                    @click="fetchData"
                    class="btn btn-secondary btn-lg w-100"
                  >
                    Buscar
                  </button>
                </div> -->
                <div class="col-lg-3 pt-1 mt-4  col-md-6">
                  <Modal
                    title="Añadir un nuevo usuario"
                    button_modal_text="Añadir"
                    close_button_text="Cerrar"
                    id="modal-add-user"
                    btnClass=" taurina btn-lg w-100"
                    :closeAction="closeModal"
                  >
                    <template v-slot:body>
                      <form @submit.prevent="saveUser">
                        <BaseInput
                          class="ml-2"
                          className="text-black text-uppercase"
                          type="text"
                          v-model="form.name"
                          label="Nombre"
                          :autoComplete="false"
                          id="name"
                        ></BaseInput>
                        <BaseInput
                          class="ml-2"
                          className="text-black text-uppercase"
                          type="text"
                          v-model="form.email"
                          label="Correo"
                          :autoComplete="false"
                          id="mail"
                        ></BaseInput>
                        <BaseInput
                          class="ml-2"
                          className="text-black text-uppercase"
                          type="text"
                          v-model="form.phone"
                          label="Teléfono"
                          id="phone"
                        ></BaseInput>
                        <BaseInput
                          class="ml-2"
                          className="text-black text-uppercase"
                          type="text"
                          v-model="form.password"
                          label="Contraseña"
                          :autoComplete="false"
                          id="password"
                        ></BaseInput>
                        <label>Elige un rol:</label>
                        <div
                          style="
                            background: rgba(255, 255, 255, 0.8) !important;
                            padding: 0.7px;
                            border-radius: 5px;
                            margin-bottom: 15px;
                          "
                        >
                          <v-select
                            class="style-chooser"
                            label="display_name"
                            :options="roles"
                            v-model="form.role"
                            id="role"
                            placeholder="Selecciona un rol"
                          ></v-select>
                        </div>

                        <button
                          type="button"
                          class="btn btn-danger"
                          @click="closeModal"
                          data-bs-dismiss="modal"
                        >
                          Cerrar
                        </button>
                        <button
                          type="submit"
                          data-bs-dismiss="modal"
                          class="btn btn-info"
                        >
                          Guardar
                        </button>
                      </form>
                    </template>
                  </Modal>
                </div>
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
import { mapActions } from "vuex";
import { computed, reactive } from "vue";
import { useStore } from "vuex";
import { useRoute } from "vue-router";

import Swal from "sweetalert2";
export default {
  setup() {
    const store = useStore();
    const route = useRoute();
    let searchForm = reactive({
      name: "",
      email: "",
    });
    const config = {
      perPage: 10,
      offset: 0,
    };
    const columns = [
      {
        field: "id",
        label: "ID",
      },
      {
        field: "name",
        label: "Nombre",
      },
      {
        field: "email",
        label: "Email",
      },
    ];
    const roles = [
      {
        name: "admin",
        display_name: "Administrador",
      },
      {
        name: "staff",
        display_name: "Staff",
      },
      {
        name: "user",
        display_name: "Usuario",
      },
    ];
    let form = reactive({
      name: "",
      email: "",
      password: "",
      phone: "",
      role: "",
    });
    const fetchData = (
      message = false,
      limit = config.perPage,
      offset = config.offset
    ) => {
      let search = [
        {
          field: "name",
          value: searchForm.name,
        },
        {
          field: "email",
          value: searchForm.email,
        },
      ];
      store
        .dispatch("user/fetchUsers", {
          search: search,
          limit: limit,
          offset: offset,
        })
        .then((response) => {
          if (message) Swal.fire("Se actualizo la lista correctamente.");
        });
    };
    const closeModal = () => {
      clearForm();
    };
    const clearForm = () => {
      form.name = "";
      form.email = "";
      form.password = "";
      form.phone = "";
      form.role = "";
    };
    const saveUser = async () => {
      await store
        .dispatch("user/saveUser", form)
        .then((response) => {
          fetchData(true);
          Swal.fire("Guardado correctamente!");
          closeModal();
          clearForm();
        })
        .catch((error) => {
          Swal.fire("Ocurrio un error al guardar el usuario.");
        });
    };
    return {
      users: computed(() => store.state.user.users),
      total: computed(() => store.getters["user/total"]),
      columns,
      config,
      route: computed(() => store.state.route),
      fetchData,
      searchForm,
      saveUser,
      form,
      closeModal,
      roles,
    };
  },
  mounted() {
    this.fetchData();
    console.log("this is the route", this.route.params);
  },
};
</script>

<style>
</style>
