<template>
  <div class="pb-3 flex flex-row justify-between items-end">
    <div
      class="
        flex flex-col
        space-y-2
        md:flex-row md:items-end md:space-x-2 md:space-y-0
      "
    >
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
            id="price-from"
            placeholder="from"
            rounded="rounded-l-md"
          />
          <the-input
            v-model="price.to"
            type="number"
            id="price-to"
            placeholder="to"
            rounded="rounded-r-md"
          />
        </div>
      </div>

      <div>
        No of Square Meters
        <div class="flex flex-row w-40">
          <the-input
            v-model="square_meters.from"
            type="number"
            id="square-meters-from"
            placeholder="from"
            rounded="rounded-l-md"
          />
          <the-input
            v-model="square_meters.to"
            type="number"
            id="square-meters-to"
            placeholder="to"
            rounded="rounded-r-md"
          />
        </div>
      </div>
    </div>
    <div>

<the-search/>
    </div>
  </div>
</template>
<script>
import TheInput from "./TheInput.vue";
import TheSearch from "./TheSearch.vue";

export default {
  components: {
    TheInput,
    TheSearch,
  },

  emits: ["offices", "tables", "price", "square-meters"],

  data() {
    return {
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
    };
  },

  watch: {
    offices(val) {
      this.$emit("offices", val);
    },

    tables(val) {
      this.$emit("tables", val);
    },

    price: {
      deep: true,
      handler() {
        this.$emit("price", this.price);
      },
    },

    square_meters: {
      deep: true,
      handler() {
        this.$emit("square-meters", this.square_meters);
      },
    },
  },
};
</script>
