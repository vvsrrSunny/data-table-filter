<template>
  <input
    :type="type"
    :name="name"
    :id="id"
    class="
      shadow-sm
      focus:ring-gray-800 focus:border-gray-800
      block
      sm:text-sm
      border-gray-300
    "
    :class="[width ? width : 'w-full', rounded ? rounded : 'rounded-md']"
    :placeholder="placeholder"
    v-model="inputVal"
    :min="min"
  />
</template>

<script>
export default {
  emits: ["update:modelValue"],

  props: {
    min: {
      type: Number,
      default: 0,
    },

    width: {
      type: String,
      default: null,
    },

    rounded: {
      type: String,
      default: null,
    },

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

