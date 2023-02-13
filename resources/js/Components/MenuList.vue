<template>
  
    
      
      <div class=" py-3 text-gray-200">
        
        <div :class="submenu==true ? 'bg-gray-300 text-gray-500':'' " class="rounded p-1 flex items-center cursor-pointer" @click="submenu = !submenu">
          <ph-chat-teardrop-text :size="24" class="mr-2"/>
          <div >{{ items.nome }}</div>
          
          <ph-caret-down  v-show="!submenu" :size="16" class="ml-8"/>
          <ph-caret-up  v-show="submenu" :size="16" class="ml-8"/>
        
        </div>
       
        <div class="text-sm" v-show="submenu">
            <div class="p-1 pl-6" v-for="ix in items.subitems">
              <Link class="hover:text-pink-200" :href="ix.link">{{ ix.nome }}</Link>              
            </div>
        </div>

      </div>
                
    
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3';
    import { ref } from 'vue';

    const props = defineProps({
        nome: String,
        items: Object,
    })

    const submenu  = ref(false);

</script>