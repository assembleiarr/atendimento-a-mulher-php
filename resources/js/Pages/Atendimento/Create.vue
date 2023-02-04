<template>
    <Head title="Cadastrar Atendimento" />

    <AdminLayout>
        <div>  
            <h1 class="mb-8 text-2xl">
                Cadastrar atendimento
            </h1>

            <div class="w-full bg-white rounded-md shadow overflow-hidden">
                <form @submit.prevent="form.post('/atendimento')">

                    <div class="flex flex-wrap -mb-8 -mr-6 p-8">       
                        <TextInput v-model="form.nome" :error="form.errors.nome" class="pb-8 pr-6 w-full lg:w-1/3" label="Data cadastro" />
                        <TextInput v-model="form.nome" :error="form.errors.nome" class="pb-8 pr-6 w-full lg:w-1/3" label="Hora cadastro" />
                        
                        <TextInput v-model="form.nome" :error="form.errors.nome" class="pb-8 pr-6 w-full lg:w-2/3" label="Nome do Assistido" />
                        <TextInput v-model="form.nome" :error="form.errors.nome" class="pb-8 pr-6 w-full lg:w-1/3" label="Data de nascimento" />

                        <TextInput v-model="form.nome" :error="form.errors.nome" class="pb-8 pr-6 w-full lg:w-1/3" label="CPF" />    
                        <TextInput v-model="form.nome" :error="form.errors.nome" class="pb-8 pr-6 w-full lg:w-1/3" label="Telefone" />

                        <TextInput v-model="form.nome" :error="form.errors.nome" class="pb-8 pr-6 w-full lg:w-3/3" label="Áreas" />
                        <TextInput v-model="form.nome" :error="form.errors.nome" class="pb-8 pr-6 w-full lg:w-3/3" label="Observação" />
                    </div>  

                    <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                        <LoadingButton :loading="form.processing" class="btn bg-pink-600 hover:bg-pink-800" type="submit">Salvar</LoadingButton>
                    </div>
                </form>
            </div> 
           
        </div>
    </AdminLayout>  
    
</template>

<script setup>
    import { Head, useForm } from '@inertiajs/inertia-vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';   
    
    import TextInput from '@/Components/TextInput.vue';
    import LoadingButton from '@/Components/LoadingButton.vue';

    const form = useForm({
        nome: null, 
        cpf: null,
        telefone: null,
        areas: null,
        observacao: null,
    })

</script>