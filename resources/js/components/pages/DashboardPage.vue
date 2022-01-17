<template>
  <the-table>
    <template v-slot:heading>
      <th
        scope="col"
        class="
          px-6
          py-3
          text-left text-xs
          font-medium
          text-gray-500
          uppercase
          tracking-wider
        "
      >
        Name
      </th>
      <th
        scope="col"
        class="
          px-6
          py-3
          text-left text-xs
          font-medium
          text-gray-500
          uppercase
          tracking-wider
        "
      >
        Price
      </th>
      <th
        scope="col"
        class="
          px-6
          py-3
          text-left text-xs
          font-medium
          text-gray-500
          uppercase
          tracking-wider
        "
      >
        Offices
      </th>
      <th
        scope="col"
        class="
          px-6
          py-3
          text-left text-xs
          font-medium
          text-gray-500
          uppercase
          tracking-wider
        "
      >
        Tables
      </th>
      <th
        scope="col"
        class="
          px-6
          py-3
          text-left text-xs
          font-medium
          text-gray-500
          uppercase
          tracking-wider
        "
      >
        no of Square meters
      </th>
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
  </the-table>
</template>

<script>
import TheTable from "../TheTable.vue";

export default {
  components: {
    TheTable,
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
