<template>
    <Head title="Atendimentos" />

    <AdminLayout>
        <div>
           
            <h1 class="mb-8 text-3xl font-bold flex items-center text-pink-600">
                <ph-user :size="32" class="mr-2"/> Assistidas
            </h1>

            <div class="w-full bg-white rounded-md overflow-hidden">

                <div class="flex flex-wrap -mb-8 -mr-6 p-8 outline-none box-border">
                    <!-- <div class="w-full mb-2 text-pink-600 text-xl font-bold flex items-center"><ph-magnifying-glass :size="24" class="mr-2"/>Pesquisar assistida </div> -->
                    <TextInput v-model="cpf" v-maska data-maska="###.###.###-##" class="pb-8 pr-6 w-full lg:w-1/3" label="CPF" />
                    <TextInput v-model="nome" class="pb-8 pr-6 w-full lg:w-1/3" label="Nome" />
                </div>

                 <div class="flex items-center justify-start px-8 py-4 bg-gray-50 border-t border-gray-100">
                    <LoadingButton @click="search" class="btn bg-pink-600 hover:bg-pink-800 cursor-pointer" type="button">Pesquisar</LoadingButton>
                </div>

            </div> 

            <Search v-if="assistida" :assistida="assistida"/>

        </div>        

    </AdminLayout>  
    
</template>

<script setup>
    import { Head, useForm } from '@inertiajs/inertia-vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import TextInput from '@/Components/TextInput.vue';
     import LoadingButton from '@/Components/LoadingButton.vue';
    import Search from '@/Pages/Assistido/Search.vue';
    import { vMaska } from "maska";
    import { ref } from 'vue';
    
    const cpf = ref(null);
    const nome = ref(null);

    const assistida = ref(null);

    const search = () => {
        let parametro = null;

        if(cpf.value){
            parametro = cpf.value;
        }else{
            parametro = nome.value;
        }

        axios.get('/api/assistido/pesquisa/'+parametro)
            .then(function (response) {
                assistida.value = response.data;
            })
            .catch(function (error) {
                console.error(error);
            })
            .then(function () {
                // sempre será executado
            });  
    }

</script>