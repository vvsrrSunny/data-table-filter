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
  </the-table>
</template>

<script>
import TheTable from "../TheTable.vue";

export default {
  components: {
    TheTable,
  },
};
</script>
