<template>
  <div>
    <div
      class="
        pb-3
        flex flex-col
        space-y-2
        md:flex-row md:items-end md:space-x-2 md:space-y-0
      "
    >
      <the-input v-model="name" id="name" placeholder="Name" class="w-40" />
    </div>
    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div
            class="
              shadow
              overflow-hidden
              border-b border-gray-200
              sm:rounded-lg
            "
          >
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <slot name="heading" />
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <slot name="body" />
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TheInput from "./TheInput.vue";
export default {
  components: { TheInput },

  data() {
    return {
      name: "",
    };
  },
};
</script>
