<template>
    <Head title="Cadastrar Atendimento" />

    <AdminLayout>
        <Loading :active.sync="isLoading" 
            :can-cancel="true" 
            :is-full-page="false" 
            color="#DB2777" 
        />

        <div>  
            <h1 class="mb-8 text-3xl font-bold flex items-center text-pink-600">
                <ph-chat-teardrop-text :size="32" class="mr-2"/> Cadastrar atendimento
            </h1>
            
            <div class="inline-flex rounded-md shadow-sm mb-6" role="group">

                <button 
                    @click="tipo" 
                    id="presencial" 
                    type="button" 
                    :class="type_selected == 'presencial' ? 'bg-pink-500 text-white' : 'bg-white'" 
                    class="px-4 py-2 border border-gray-200 rounded-l-lg hover:bg-pink-100 hover:text-pink-700 focus:z-10 focus:ring-0">
                    Presencial
                </button>  

                <button @click="tipo" 
                    id="zapchame" 
                    type="button" 
                    :class="type_selected == 'zapchame' ? 'bg-pink-500 text-white' : 'bg-white'" 
                    class="px-4 py-2 bg-white border border-gray-200 rounded-r-md hover:bg-pink-100 hover:text-pink-700 focus:ring-0">
                    ZAPCHAME
                </button>

            </div>

            <div class="w-full bg-white rounded-md shadow overflow-hidden">

                <form @submit.prevent="form.post('/atendimento/salvar/'+type_selected)">
                    
                    <div class="flex flex-wrap -mb-8 -mr-6 p-8 outline-none box-border">

                        <FormZap @is-loading="setLoading" :form="form" :areas="areas" v-if="type_selected == 'zapchame'"/>                        

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
    import FormZap from '@/Pages/Atendimento/FormZap.vue'
    import { ref } from 'vue';
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/css/index.css';
    import LoadingButton from '@/Components/LoadingButton.vue';   
    
    const form = useForm({
        data_atendimento: new Date().toLocaleDateString(),
        hora_h: new Date().getHours(),
        hora_m: new Date().getMinutes(), 
        nome: null, 
        data_nascimento: null,
        cpf: null,
        telefone_principal: null,
        areas: [],
        observacoes: null,
    })

    const props = defineProps({
        areas: Object,
    });

    const isLoading = ref(false);

    const type_selected = ref('zapchame');

    function setLoading(n){
        isLoading.value = n;
    }
    
    function tipo(event) {
        type_selected.value = event.target.id;
    }

</script>