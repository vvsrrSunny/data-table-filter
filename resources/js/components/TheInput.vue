<template>
  <input
    :type="type"
    :name="name"
    :id="id"
    class="
      shadow-sm
      focus:ring-red-500 focus:border-red-500
      block
      w-full
      sm:text-sm
      border-gray-300
      rounded-md
    "
    :placeholder="placeholder"
    v-model="inputVal"
  />
</template>

<script>
export default {
  emits: ["update:modelValue"],

  props: {
    id: {
      type: String,
      required: true,
    },

    name: {
      type: String,
      default: "",
    },

    placeholder: {
      type: String,
      default: "",
    },
    type: {
      type: String,
      default: "text",
    },

    modelValue: {
      type: String,
      default: "",
    },
  },
  data() {
    return {
      inputVal: this.modelValue,
    };
  },

  watch: {
    inputVal() {
      this.$emit("update:modelValue", this.inputVal);
    },

    modelValue() {
      this.inputVal = this.modelValue;
    },
  },
};
</script>

