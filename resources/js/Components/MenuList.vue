<template>
  
      <div class="mt-2 text-gray-200 font-bold">

        <div :class="submenu == true ? 'bg-gray-300 text-gray-700' : ''" class="rounded p-1.5 py-2 flex items-center cursor-pointer" @click="submenu = !submenu">
          <component :is="items.icon" weight="bold" :size="24" class="mr-2"/>
          
          <div class="w-2/3 pl-2">
            {{ items.nome }}
          </div>
          
          <div v-if="items.subitems" class="float-right">
            <ph-caret-down  v-show="!submenu" :size="16" class="ml-8"/>
            <ph-caret-up  v-show="submenu" :size="16" class="ml-8"/>
          </div>      
        
        </div>

        <div class="pl-6 font-semibold mb-4 py-3" v-show="submenu">
            <div class="p-1 mt-2" v-for="ix in items.subitems">
              
              <Link :class="ix.link == routeActive ? 'text-pink-400' : ''" class="hover:text-pink-400 flex items-center" :href="$route(ix.link)">
                {{ ix.nome }}
              </Link>       
                       
            </div>
        </div>

      </div>          
    
</template>

<script setup>
    import { Link, usePage } from '@inertiajs/inertia-vue3';
    import { ref, computed } from 'vue';

    const props = defineProps({
        nome: String,
        items: Object,
    })

    const submenu  = ref(false);

    const routeActive = computed(() => { 
      submenu.value = true;
      return usePage().props.value.ziggy.routeName;
    })

</script>