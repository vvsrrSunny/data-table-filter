<template>
  <table-layout>
    <template #filters>
      <div>
        Offices
        <the-input
          v-model="offices"
          type="number"
          id="offices"
          placeholder="Offices"
        />
      </div>
      <div>
        Tables
        <the-input
          v-model="tables"
          type="number"
          id="tables"
          placeholder="Tables"
          class="w-40"
        />
      </div>

      <div>
        Price
        <div class="flex flex-row w-40">
          <the-input
            v-model="price.from"
            type="number"
            id="name"
            placeholder="from"
            rounded="rounded-l-md"
          />
          <the-input
            v-model="price.to"
            type="number"
            id="name"
            placeholder="to"
            rounded="rounded-r-md"
          />
        </div>
      </div>
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
import TheInput from "./TheInput.vue";

export default {
  components: {
    TableLayout,
    TableHeaderCell,
    TableCell,
    TheInput,
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
    };
  },

  watch: {
    offices() {
      this.displayBusinessTable();
    },

    tables() {
      this.displayBusinessTable();
    },
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
