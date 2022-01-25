<template>
  <table-layout>
    <template v-slot:heading>
      <table-header-cell> Name </table-header-cell>
      <table-header-cell> Price </table-header-cell>
      <table-header-cell> Offices </table-header-cell>
      <table-header-cell> Tables </table-header-cell>
      <table-header-cell> no of Square meters </table-header-cell>
    </template>

    <template v-slot:body>
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

export default {
  components: {
    TableLayout,
    TableHeaderCell,
    TableCell,
  },

  mounted() {
    axios.get("/").then((response) => {
      this.business_data = response.data.data;
      console.log(response.data.data);
    });
  },
  data() {
    return {
      business_data: [],
    };
  },
};
</script>
