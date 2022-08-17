<template>
  <div>
    <label
      class="form-label"
      v-if="label != ''"
      for="exampleInputEmail1"
      >{{ label }}</label
    >
    <div class="input-group input-group-outline">
      <input
        :type="type"
        class="form-control mb-4"
        :aria-describedby="ariaDescribedby"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        :autocomplete="autoComplete"
        :name="modelValue"
        :required="required"
        :id="id"
      />
    </div>
  </div>
</template>

<script>
export default {
  props: {
    autoComplete: {
      type: Boolean,
      default: true,
    },
    className: {
      type: String,
      default: "",
    },
    id: {
      type: String,
      default: "",
    },
    label: {
      type: String,
      default: "",
    },
    type: {
      type: String,
      default: "text",
    },
    placeholder: {
      type: String,
      default: "",
    },
    ariaDescribedby: {
      type: String,
      default: "",
    },
    small: {
      type: String,
      default: "",
    },
    required: {
      type: Boolean,
      default: true,
    },
    modelValue: {
      type: [String, Number, Boolean],
      default: "",
    },
  },
  setup(props) {},
};
</script>

<style>
.form-control {
  color: #ffffff !important;
}
.text-black {
  color: #bf0bf6 !important;
}
.vs__deselect{
    color: #ffffff !important;
}
</style>
