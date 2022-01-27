<template>
  <table-layout>
    <template #filters>
      <filters
        @offices="(val) => (offices = val)"
        @tables="(val) => (tables = val)"
        @price="(val) => (price = val)"
        @square-meters="(val) => (square_meters = val)"
        @search="(val) => (search = val)"
      />
    </template>
    <template #heading>
      <table-header-cell> Name </table-header-cell>
      <table-header-cell> Price </table-header-cell>
      <table-header-cell> Offices </table-header-cell>
      <table-header-cell> Tables </table-header-cell>
      <table-header-cell> no of Square meters </table-header-cell>
    </template>

    <template #body>
      <tr v-for="dataRecord in business_data" :key="dataRecord.id">
        <table-cell>
          {{ dataRecord.name }}
        </table-cell>
        <table-cell>
          {{ dataRecord.price }}
        </table-cell>
        <table-cell>
          {{ dataRecord.offices }}
        </table-cell>
        <table-cell>
          {{ dataRecord.tables }}
        </table-cell>
        <table-cell>
          {{ dataRecord.square_meters }}
        </table-cell>
      </tr>
    </template>
  </table-layout>
</template>

<script>
import TableLayout from "./TableLayout.vue";
import TableHeaderCell from "./TableHeaderCell.vue";
import TableCell from "./TableCell.vue";
import Filters from "./Filters.vue";
import debounce from "lodash/debounce";

export default {
  components: {
    TableLayout,
    TableHeaderCell,
    TableCell,
    Filters,
  },

  mounted() {
    this.displayBusinessTable();
  },
  data() {
    return {
      business_data: [],
      offices: null,
      tables: null,
      price: {
        from: null,
        to: null,
      },
      square_meters: {
        from: null,
        to: null,
      },
      search: null,
    };
  },

  watch: {
    offices() {
      this.displayBusinessTable();
    },

    tables: () => {
      this.displayBusinessTable();
    },

    price: {
      deep: true,
      handler() {
        this.displayBusinessTable();
      },
    },

    square_meters: {
      deep: true,
      handler() {
        this.displayBusinessTable();
      },
    },

    search: debounce(function () {
      this.displayBusinessTable();
    }, 250),
  },

  methods: {
    displayBusinessTable() {
      let filters = this.getFilter();

      let endpoint = this.makeEndPoint(filters);

      axios.get(endpoint).then((response) => {
        this.business_data = response.data.data;
      });
    },

    getFilter() {
      let filters = [];

      if (this.offices) {
        filters.push({
          name: "offices",
          value: this.offices,
        });
      }

      if (this.tables) {
        filters.push({
          name: "tables",
          value: this.tables,
        });
      }

      if (this.price.from && this.price.to) {
        filters.push({
          name: "price[from]",
          value: this.price.from,
        });

        filters.push({
          name: "price[to]",
          value: this.price.to,
        });
      }

      if (this.square_meters.from && this.square_meters.to) {
        filters.push({
          name: "square_meters[from]",
          value: this.square_meters.from,
        });

        filters.push({
          name: "square_meters[to]",
          value: this.square_meters.to,
        });
      }

      if (this.search) {
        filters.push({
          name: "search",
          value: this.search,
        });
      }
      return filters;
    },

    makeEndPoint(filters, endpoint = "/") {
      filters.forEach((element, index) => {
        if (index == 0) {
          endpoint = `${endpoint}?${element.name}=${element.value}`;

          return;
        }

        endpoint = `${endpoint}&${element.name}=${element.value}`;
      });

      return endpoint;
    },
  },
};
</script>
