<template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <select :id="id" ref="input" v-model="selected" v-bind="{ ...$attrs, class: null }" class="form-select rounded border-gray-400 bg-gray-50 focus:border-pink-400 focus:ring-pink-400 cursor-pointer" :class="{ error: error }">
      <slot />
    </select>
    <div v-if="error" class="form-error">{{ error }}</div>
  </div>
</template>

<script setup>
  import { v4 as uuid } from 'uuid';
  import { reactive, computed} from 'vue';

  const inheritAttrs = false;

  const props = defineProps({
    id: {
      type: String,
      default() {
        return `select-input-${uuid()}`
      },
    },
    error: String,
    label: String,       
    modelValue: [String, Number, Boolean], 
  })

  const emit = defineEmits(['update:modelValue']);

  const selected = computed({
    get() {
      return props.modelValue;
    },
    set(selected) {
      emit('update:modelValue', selected)
    }
  })

  function focus() {
    this.$refs.input.focus()
  }

  function select() {
    this.$refs.input.select()
  }

</script>
