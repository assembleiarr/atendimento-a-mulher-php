<template>
      <label v-if="label" class="form-label" :for="id"><i v-if="icon" :class="icon" class="pr-1"></i>{{ label }}:</label>
      <textarea  :id="id" ref="input" v-bind="{ ...$attrs, class: null }" rows="8" class="form-textarea block p-2.5 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-pink-300 focus:border-pink-300" :class="{ error: error }" :type="type" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
      
      <div v-if="error" class="form-error">{{ error }}</div>
  </template>
  
  
  <script setup>
  import { v4 as uuid } from 'uuid';

  const inheritAttrs = false; 

  const props =defineProps({
    id: {
      type: String,
      default() {
        return `text-area-input-${uuid()}`
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

</script>