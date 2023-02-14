<template>

    <input @click="check" :id="value" type="checkbox"><label class="mr-8 pl-2 cursor-pointer hover:text-pink-500 ckecked:bg-pink-300" :for="nome">{{ nome }}</label>

  </template>
  
  <script setup>
    import { ref } from 'vue';
    
    const props = defineProps({
        nome: String,
        value: String,
    })

    const checkeds = [];
    
    function check(event){
        
        if(event.target.checked){
            checkeds.push(event.target.id);
        }else{
            // var index = checkeds.value.indexOf(event.target.id);

            // if (index > -1)
            // {
            //     checkeds.value.splice(index, 1);
            // }
        }

        console.log(checkeds);
    }

    const emits = defineEmits(['update:modelValue'])
    
  </script>