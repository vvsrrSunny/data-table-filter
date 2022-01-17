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
        <td
          class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
        >
          {{ dataRecord.name }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
          {{ dataRecord.price }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
          {{ dataRecord.offices }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
          {{ dataRecord.tables }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
          {{ dataRecord.square_meters }}
        </td>
      </tr>
    </template>
  </table-layout>
</template>

<script>
import TableLayout from "../TableLayout.vue";
import TableHeaderCell from "../TableHeaderCell.vue";

export default {
  components: {
    TableLayout,
    TableHeaderCell,
  },
  data() {
    return {
      business_data: [
        {
          name: "St Georges Terrace",
          price: 5000,
          offices: 6,
          tables: 20,
          square_meters: 400,
        },
      ],
    };
  },
};
</script>
