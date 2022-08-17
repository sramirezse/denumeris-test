
<template>
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-4 col-md-6 col-sm-12">
        <v-select
          class="style-chooser"
          label="d_estado"
          v-model="form.state"
          :options="$store.state.states.states"
          :reduce="(state) => state.d_estado"
          @option:selected="getCities(true)"
          id="states"
          placeholder="Selecciona el estado"
        ></v-select>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12">
        <v-select
          class="style-chooser"
          label="D_mnpio"
          v-model="form.city"
          :options="$store.state.states.cities"
          :reduce="(state) => state.D_mnpio"
          @option:selected="getStations"
          id="cities"
          placeholder="Selecciona la ciudad"
        ></v-select>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-12">
        <select
          @change="getCities"
          class="form-control"
          v-model="form.order_by"
        >
          <option value="">Selecciona una opción</option>
          <option value="asc">Ascendente</option>
          <option value="desc">Descendente</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <Table
          color="primary"
          :data="stations"
          :totalRows="total"
          :columns="columns"
          :fetchData="getStations"
          :config="form"
          :selectedCheckboxes="false"
        >
        </Table>
      </div>
      <div class="col-lg-6 col-md-12">
        <GMapMap
          :center="center"
          :zoom="10"
          map-type-id="terrain"
          style="45vw; height: 70vh"
          :options="{
            zoomControl: true,
            mapTypeControl: true,
            scaleControl: true,
            streetViewControl: true,
            rotateControl: true,
            fullscreenControl: true,
          }"
        >
          <GMapCluster :minimumClusterSize="2" :zoomOnClick="true">
            <GMapMarker
              :key="index"
              v-for="(marker, index) in markers"
              :position="marker.position"
              :clickable="true"
              :draggable="true"
              @click="center = marker.position"
            />
          </GMapCluster>
        </GMapMap>
      </div>
    </div>
  </div>
</template>
<script setup>
import { useStore } from "vuex";
import { computed, reactive, onMounted } from "vue";

const store = useStore();
const columns = reactive([
  {
    field: "calle",
    label: "Calle",
  },
  {
    field: "colonia",
    label: "Colonia",
  },
  {
    field: "regular",
    label: "Regular",
  },
  {
    field: "premium",
    label: "Premium",
  },
  {
    field: "razonsocial",
    label: "Razon Social",
  },
]);
let form = reactive({
  state: "",
  city: "",
  order_by: "desc",
  perPage: 10,
  offset: 0,
});

const getStates = async () => {
  await store.dispatch("states/getStates", form);
};
const getCities = async (band = false) => {
  await store.dispatch("states/getCities", form);
  if (band) {
    console.log("getCities", band);
    getStations();
  }
};
const getStations = async (search = null, perPage = null, offset = null) => {

    form.perPage = perPage || form.perPage;
    form.offset = offset || form.offset;
  await store.dispatch("stations/getStations", form);
};
const center = computed(() => {
  console.log("center", markers.value[0]);
  if (markers.value.length > 0) {
    console.log("center", markers.value[0].position.lat);
    return {
      lat: markers.value[0].position.lat,
      lng: markers.value[0].position.lng,
    };
  } else {
    return {
      lat: 19.432608,
      lng: -99.133209,
    };
  }
});
const markers = computed(() => store.state.stations.markers);
const stations = computed(() => store.state.stations.stations);
const total = computed(() => store.state.stations.total);

onMounted(() => {
  getStates();
});
</script>

