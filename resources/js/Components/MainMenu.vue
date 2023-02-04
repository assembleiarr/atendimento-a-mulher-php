<template>
  <nav>    
    <div class="mb-2">
      <ul>
        <li> Menu 1</li>
        <li> Menu 2</li>
        <li> Menu 3</li>
        <li> Menu 4</li>
      </ul>  
      
      <ul>
        <li>Submenu 1</li>
        <li>Submenu 2</li>
        <li>Submenu 3</li>
        <li>Submenu 4</li>
      </ul>
    </div>       
  </nav>
</template>

<script setup>
    import { usePage } from '@inertiajs/inertia-vue3'
    import { computed } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    const ous = computed(() => usePage().props.value.ous)         
</script>