<template>
    <Head title="Editar atendimento" />

    <AdminLayout> 
        <h1>{{ atendimento.id }}</h1>

        {{ atendimento.assistido.pessoa.nome }}
        {{ atendimento.data_atendimento }}
           
    </AdminLayout> 
    
</template>

<script setup>
    import { Head } from '@inertiajs/inertia-vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';

 
    const props = defineProps({
        atendimento: Object
    })
</script>