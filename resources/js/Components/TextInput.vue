<template>
  <div :class="$attrs.class">
    <label v-if="label" :class="error ? 'text-red-700 font-semibold' : '' " class="form-label flex items-center" :for="id"><component :is="icon" :size="22" class="mr-2"/>{{ label }}:</label>
    <input :id="id" ref="input" v-bind="{ ...$attrs, class: null }" class="bg-gray-50 form-input rounded border-gray-400 focus:ring-pink-300 focus:border-pink-300 placeholder:text-gray-400" :class="{ error: error }" :type="type" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" />
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script setup>
  import { ref, onMounted} from '@vue/runtime-core';
  import { v4 as uuid } from 'uuid';

  const inheritAttrs = false; 
  const componentKey = ref(0);

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
      focus: {
        type: Boolean,
        default() {
          return false
        },
      },
      modelValue: [String, Number, Boolean],
  })

  const emits = defineEmits(['update:modelValue'])
  
  const input = ref(null)

  onMounted(() => {
    if(props.focus == true){  
      input.value.focus()    
    }
  })
 
</script>