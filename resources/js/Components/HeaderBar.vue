<template>
     
    <div :class="isActive ? 'bg-slate-200' : 'bg-white'" class="md:w-1/2 relative border rounded-lg flex items-center">
        <i class="ph-magnifying-glass-light pl-3 text-xl"></i>
    </div>    

    <Dropdown class="" placement="bottom-end">
        <template #default>
            
            <div class="group flex items-center cursor-pointer select-none">
                <div class="bg-white  p-2 rounded h-full border border-gray-300 text-gray-500 text-md items-baseline cursor-pointer group-hover:bg-cyan-700 group-hover:text-white group-hover:border-0">
                    <i class="ph-list-bold text-xl align-middle"></i>
                    <!-- <i class="pt-[2px] ml-2 ph-caret-down w-5 h-5 fill-gray-700 group-hover:text-sky-600 focus:text-sky-600"></i> -->
                </div>                
            </div>
        </template>        
   
        <template #dropdown>
            <div class="mt-2 py-2 text-sm bg-white rounded shadow-xl">
                <Link class="text-base px-4 py-2 w-full text-left hover:text-white hover:bg-cyan-700 flex items-center" href="/usuario" method="GET" as="button"><i class="ph-user-plus text-lg mr-2"></i>Criar usuário</Link>
                <Link class="text-base px-4 py-2 w-full text-left hover:text-white hover:bg-cyan-700 flex items-center" href="/unidade" method="GET" as="button"><i class="ph-folder-simple-plus text-lg mr-2"></i>Criar unidade</Link>
                <Link class="text-base px-4 py-2 w-full text-left hover:text-white hover:bg-cyan-700 flex items-center" href="/relatorios" method="GET" as="button"><i class="ph-file-text text-lg mr-2"></i>Relatórios</Link>
                <Link class="text-base px-4 py-2 w-full text-left hover:text-white hover:bg-cyan-700 flex items-center" href="/logout" method="post" as="button"><i class="ph-sign-out text-lg mr-2"></i>Logout ({{ username }})</Link>
            </div>
        </template>
               
    </Dropdown>

</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3';
    import Dropdown from '@/Components/Dropdown.vue';   
</script>
