<template>
    <Head title="Atendimentos" />

    <AdminLayout>
        <div>
            <h1 class="mb-8 text-3xl font-bold flex items-center text-pink-600">
                <ph-chat-teardrop-text :size="32" class="mr-2"/> Atendimentos
            </h1>

            <div class="bg-white rounded-md shadow">

                <table class="table-default">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CPF</th>
                            <th class="start">Assistido</th>
                            <th>Data</th>
                            <th>Recepção</th>
                            <th>Importado</th>
                           
                            <th>Telefone</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="atendimento in atendimentos.data" :key="atendimento.id">

                            <td>{{ atendimento.id }}</td>
                            <td>{{ atendimento.assistido.pessoa.cpf }}</td>
                            <td class="start">{{ atendimento.assistido.pessoa.nome }}</td>
                            <td>{{ atendimento.data_hora }}</td>
                            <td>{{ atendimento.recepcao_tipo }}</td>
                            <td>{{ atendimento.is_importado }}</td>
                           
                            <td>{{ atendimento.assistido.pessoa.telefone_principal }}</td>

                        </tr>

                    </tbody>                    
                </table>
            </div>
        </div>


        <Pagination class="mt-6" :links="atendimentos.links" />

    </AdminLayout>  
    
</template>

<script setup>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import Pagination from '@/Components/Pagination.vue';
    
    const proos = defineProps({
        atendimentos: Object,
    });


</script>

    