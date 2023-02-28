<template>
    <Head title="Editar atendimento" />

    <AdminLayout> 
        <h1 class="mb-8 text-3xl font-bold flex items-center text-pink-600">Atendimento #{{ atendimento.id }}</h1>

        <div class="w-full flex flex-wrap p-4 bg-white rounded-md">
            <div class="bg-white md:w-1/2 p-2">
                <label for="" class="bg-white font-bold mr-2">Assistida:</label>
                <span> {{ atendimento.assistido.pessoa.nome }}</span>
            </div>

            <div class="bg-white md:w-1/2 p-2">
                <label for="" class="bg-white font-bold mr-2">Data do atendimento:</label>
                <span> {{ atendimento.data_atendimento  }}</span>
            </div>

            <div class="bg-white md:w-1/2 p-2">
                <label for="" class="bg-white font-bold mr-2">Tipo de recepção:</label>
                <span> {{ atendimento.recepcao_tipo  }}</span>
            </div>

            <div class="bg-white md:w-1/2 p-2">
                <label for="" class="bg-white font-bold mr-2">Importado:</label>
                <span> {{ atendimento.iss_importado ? 'Sim' : 'Não'  }}</span>
            </div>

            <div class="bg-white md:w-full p-2">
                <label for="" class="bg-white font-bold mr-2">Áreas de atendimento:</label>
                <span v-for="area in atendimento.areas" class="mr-2"> {{ area.nome }}</span>
            </div>

            <div class="bg-white md:w-1/2 p-2">
                <label for="" class="bg-white font-bold mr-2">Observações:</label>
                <span> {{ atendimento.observacoes ? atendimento.observacoes : 'Sem observações' }}</span>
            </div>
            
        </div>

        <div class="p-6 mt-6 w-full flex flex-wrap bg-white rounded-md">
            <h2 class="w-full p-2 font-semibold text-lg text-pink-600">Dados da assistida</h2>

            <div class="bg-white md:w-1/2 p-2">
                <label for="" class="bg-white font-bold mr-2">Nome completo:</label>
                {{ atendimento.assistido.pessoa.nome }}
            </div>

            <div class="bg-white md:w-1/2 p-2">
                <label for="" class="bg-white font-bold mr-2">CPF:</label>
                {{ atendimento.assistido.pessoa.cpf }}
            </div>

            <div class="bg-white md:w-1/3 p-2">
                <label for="" class="bg-white font-bold mr-2">Data de nascimento:</label>
                {{ atendimento.assistido.pessoa.data_nascimento }}
            </div>

            <div class="bg-white md:w-1/3 p-2">
                <label for="" class="bg-white font-bold mr-2">Telefone:</label>
                {{ atendimento.assistido.pessoa.telefone_principal }}
            </div>
        </div>

        <div v-if="atendimento.recepcao_tipo == 'presencial'" class="p-6 mt-6 w-full flex flex-wrap bg-white rounded-md">
            <h2 class="w-full p-2 font-semibold text-lg text-pink-600">Endereço</h2>
            
            <div class="bg-white md:w-1/3 p-2">
                <label for="" class="bg-white font-bold mr-2">Rua:</label>
                {{ atendimento.assistido.pessoa.endereco.logradouro }}
            </div>

            <div class="bg-white md:w-1/3 p-2">
                <label for="" class="bg-white font-bold mr-2">Número:</label>
                {{ atendimento.assistido.pessoa.endereco.numero }}
            </div>

            <div class="bg-white md:w-1/3 p-2">
                <label for="" class="bg-white font-bold mr-2">Bairro:</label>
                {{ atendimento.assistido.pessoa.endereco.bairro }}
            </div>

            <div class="bg-white md:w-1/3 p-2">
                <label for="" class="bg-white font-bold mr-2">Cidade:</label>
                {{ atendimento.assistido.pessoa.endereco.municipio.nome }}
            </div>

            <div class="bg-white md:w-1/3 p-2">
                <label for="" class="bg-white font-bold mr-2">Estado:</label>
                {{ atendimento.assistido.pessoa.endereco.municipio.estado.nome }}
            </div>
        </div>
           
    </AdminLayout>  
    
</template>

<script setup>
    import { Head } from '@inertiajs/inertia-vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import computed from 'vue';
 
    const props = defineProps({
        atendimento: Object
    })

    const idade = computed(() => {
        return props.atendimento.data_nascimento;
    })
</script>