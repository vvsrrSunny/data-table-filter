<template>
  <div
    class="
      pb-3
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
  </div>
</template>
<script>
import TheInput from "./TheInput.vue";

export default {
  components: {
    TheInput,
  },

  emits: ["offices", "tables", "price"],

  data() {
    return {
      offices: null,
      tables: null,
      price: {
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
  },
};
</script>
