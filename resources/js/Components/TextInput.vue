<template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label" :for="id"><i v-if="icon" :class="icon" class="pr-1"></i>{{ label }}:</label>
    <input :id="id" ref="input" v-bind="{ ...$attrs, class: null }" class="form-input rounded border-gray-400" :class="{ error: error }" :type="type" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script setup>
  import { v4 as uuid } from 'uuid';

  const inheritAttrs = false; 

  const props =defineProps({
    id: {
      type: String,
      default() {
        return `text-input-${uuid()}`
      },
    },
    type: {
      type: String,
      default: 'text',
    },
      error: String,
      label: String,
      icon: String,
      modelValue: [String, Number, Boolean],
  })

  const emits = defineEmits(['update:modelValue'])

  function focus() {
      this.$refs.input.focus()
  }
  function select() {
    this.$refs.input.select()
  }
  function setSelectionRange(start, end) {
    this.$refs.input.setSelectionRange(start, end)
  }

</script>