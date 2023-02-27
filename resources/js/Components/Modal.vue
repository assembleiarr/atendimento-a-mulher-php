<template>
   
    <div class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full justify-center items-center flex" @click="$emit('close-modal')">
        <div class="relative w-full h-full max-w-2xl md:h-auto md:left-0" @click.stop>
            <div class="relative bg-white rounded-lg shadow">

                <div class="flex items-start justify-between p-4 border-b rounded-t">
                    
                    <h3 class="pl-2 text-xl font-bold text-pink-700 mt-2">
                        {{ header }}
                    </h3>

                    <button type="button" @click="$emit('close-modal')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-pink-700 rounded-3xl text-sm p-1.5 ml-auto inline-flex items-center">
                        <ph-x :size="24" weight="fill" />
                    </button>
                </div>

                <div class="p-6 space-y-6">
                    <slot></slot>
                </div>

                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                    <button  @click="$emit('close-modal')" type="button" class="btn mr-2 bg-pink-700 hover:bg-pink-500">Fechar</button>
                </div>
            </div>
        </div>      
    </div>
    
  </template>

<script setup>
    import { ref, computed, reactive } from "vue";

    const props = defineProps({
        header: String,
    })

</script>