<template>
  <div class="container-fluid">
    <div class="btn-list btn-list-icon">
      <slot name="buttons"></slot>
      <button
        v-show="checkedData.length >= 1"
        type="button"
        @click="deleteItems(checkedData)"
        class="btn btn-danger"
      >
        <i class="fe fe-file-text me-2"></i>Eliminar
      </button>
      <button
        v-show="exportE === true"
        type="button"
        @click="exportPDF()"
        class="btn btn-success"
      >
        <i class="fe fe-trash-2 me-2"></i>Exportar
      </button>
    </div>
    <!-- <search @search-refresh="searchRefresh"></search> -->

    <div class="table-responsive">
      <table class="table">
        <thead :class="'text-' + color">
          <tr>
            <th v-show="selectedCheckboxes" >#</th>
            <th  v-for="(column, index) in columns" :key="index" scope="col">
              {{ column.label }}
            </th>
            <th width="15%" v-if="opts == true">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in data" :key="index">
            <td v-show="selectedCheckboxes">
              <input
                type="checkbox"
                :id="item.id"
                :value="item.id"
                v-model="checkedData"
              />
            </td>
            <td v-for="(column, index) in columns" :key="index">
              <div v-if="!column.slot_name" :class="'text-'+colorrows">
                {{ item[column.field] }}
              </div>
              <div v-else>
                <slot
                  :name="column.slot_name"
                  :row="item"
                  :column="column"
                ></slot>
              </div>
            </td>
            <td name="bstable-actions" v-if="opts == true">
              <div class="btn-list">
                <button
                  id="bEdit"
                  type="button"
                  class="btn btn-sm btn-primary"
                  @click="editItems(item)"
                >
                  <span class="fe fe-edit"> </span>
                </button>
                <button
                  id="bDel"
                  type="button"
                  class="btn btn-sm btn-danger"
                  @click="deleteItems([item.id])"
                >
                  <span class="fe fe-trash-2"> </span>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
        <tbody v-if="data.length < 1">
          <tr>
            <td colspan="{{ columns.length }}">
              <div class="text-center">
                <h3 :class="'text-'+colorrows">No se encontraron datos</h3>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <br />
      <pagination
        v-model="page"
        :records="rowCount"
        :per-page="config.perPage"
        @paginate="refresh(page)"
        :options="options"
      />
    </div>
  </div>
</template>

<script>
import jsPDF from "jspdf";
import { applyPlugin } from "jspdf-autotable";
applyPlugin(jsPDF);

export default {
  emits: ["onDeleteItems", "onEditItems"],
  props: {
    columns: {
      type: Array,
      default: () => [],
    },
    data: {
      type: Array,
      default: () => [],
    },
    exportE: {
      type: Boolean,
      default: false,
    },
    totalRows: {
      type: Number,
      default: 0,
    },
    config: {
      type: Object,
      required: true,
    },
    classes: {
      type: Object,
      default: function () {
        return {};
      },
    },
    fetchData: {
      type: Function,
      default: function () {
        return {};
      },
    },
    loading: {
      type: Boolean,
      default: true,
    },
    opts: {
      type: Boolean,
      default: false,
    },
    color: {
      type: String,
      default: "",
    },
    colorrows: {
      type: String,
      default: "",
    },
    selectedCheckboxes: {
      type: Boolean,
      default: true,
    },
    deleteTitle: {
      type: String,
      default: null,
    },
  },
  data() {
    return {
      checkedData: [],
      page: 1,
      options: {
        texts: {
          count:
            "Mostrando {from} a {to} de {count} registros|{count} registros|Un registro",
        },
      },
    };
    loading: true;
  },
  computed: {
    rowCount() {
      return this.totalRows;
    },
  },
  methods: {
    searchRefresh(query) {
      this.fetchData(query, this.config.perPage, 0);
    },
    refresh(page) {
      // this.page = page;
      const offset = this.config.perPage * (page - 1);
      console.log('offsets',offset);
      this.page = page;
      this.fetchData("", this.config.perPage, offset);
      // console.log(this.page, offset);
    },

    deleteItems(check) {
      // console.log(this.checkedData);
      this.$swal({
        title: this.deleteTitle? this.deleteTitle: "¿Seguro que quieres eliminar los datos?",
        text: `Se eliminará(n) ${
          this.checkedData.length >= 1
            ? this.checkedData.length + " archivos"
            : "1 archivo"
        }`,
        showDenyButton: true,
        icon: "question",
        // showCancelButton: true,
        cancelButtonText: '<i class="fe fe-x-circle me-2"></i> Cancelar',
        confirmButtonText: '<i class="fe fe-trash-2 me-2"></i> Eliminar',
        denyButtonText: `<i class="fe fe-x-circle me-2"></i> No eliminar`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          this.$emit("onDeleteItems", check);
          this.checkedData = [];
          this.$swal("Eliminado!", "", "success");
        } else if (result.isDenied) {
          this.checkedData = [];
          this.$swal("No se realizó ningún cambio", "", "info");
        }
      });
    },
    editItems(item) {
      this.$emit("onEditItems", item);
    },
    exportPDF() {
      require("jspdf-autotable");
      const columns = this.columns;
      const data = this.data;
      const arr = [];
      // data.map((item) =>
      //         );
      data.forEach((element) => {
        const arr2 = [];

        // columns.map((column) => arr2.push(element[column.field]));
        columns.forEach((column) => {
          const f = column.field;

          if (f.includes(".")) {
            const arrField = f.split(".");
            const field = element[arrField[0]];
            if (typeof field === "object") {
              const val = field[arrField[1]];
              arr2.push(val);
            }
          } else {
            arr2.push(element[f]);
          }
        });
        arr.push(arr2);
      });
      const doc = new jsPDF("p", "pt");

      const nameRoute = this.$store.state.route.name;
      doc.text("Tabla de " + nameRoute, 40, 40);
      doc.autoTable({
        head: [columns.map((column) => column.label)],
        body: arr,
        theme: "striped",
      });
      doc.save(nameRoute + ".pdf");
    },
  },
};
</script>

<style>
.VuePagination__pagination .pagination {
  margin-bottom: 10px;
}
.page-link {
  color: #2937F0;
}
.page-item.active .page-link {
  z-index: 1;
  background-color: #2937F0;
  color: #ffffff;
  border-color: #2937F0;
}
</style>
