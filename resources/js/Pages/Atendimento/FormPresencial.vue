<template>
    <Head title="Cadastrar Atendimento" />

    <AdminLayout>
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

                <form @submit.prevent="form.post('/atendimento')">

                    <div class="flex flex-wrap -mb-8 -mr-6 p-8 outline-none box-border">       
                        <div class="pb-8 pr-6 w-full lg:w-1/3">
                            <label class="form-label flex items-center">Data do atendimento</label>
                            <v-date-picker v-model="form.data_cadastro" color="pink" :max-date='new Date()'>
                                <template #default="{ inputValue, inputEvents }">     
                                    
                                        <input class="bg-gray-50 form-input rounded border-gray-400 focus:ring-pink-300 focus:border-pink-300" :value="inputValue" v-on="inputEvents"/>
                                        <div v-if="form.errors.data_cadastro" class="form-error">{{ form.errors.data_cadastro }}</div>
                                   
                                </template>        
                            </v-date-picker>
                            </div>
                        
                        <div class="pb-8 pr-6 w-full lg:w-1/3">

                            <label class="form-label flex items-center">Horário do atendimento</label>

                            <select v-model="form.hora_h"  class="bg-gray-50 rounded mr-1 border-gray-400 focus:border-pink-400 focus:ring-pink-400 cursor-pointer">
                                <option :value="null">HH </option>
                                <option v-for="item in 24" :value="item-1">
                                    {{ item <= 10 ? '0'+(item-1) : item-1 }}
                                </option>
                            </select> 

                            <select v-model="form.hora_m" class="bg-gray-50 rounded border-gray-400 focus:border-pink-400 focus:ring-pink-400 cursor-pointer">
                                <option :value="null" >MM</option>
                                <option v-for="item in 60" :value="item-1">
                                    {{ item <= 10 ? '0'+(item-1) : item-1 }}
                                </option>
                            </select>  
                        </div>

                        <TextInput v-model="form.cpf" v-maska data-maska="###.###.###-##" :error="form.errors.cpf" class="pb-8 pr-6 w-full lg:w-1/3" label="CPF" />

                        <TextInput v-model="form.nome" :error="form.errors.nome" class="pb-8 pr-6 w-full lg:w-2/3" label="Nome do assistido"/>
                        <!-- <TextInput v-model="form.data_nascimento" v-maska data-maska="##/##/####" :error="form.errors.data_nascimento" class="pb-8 pr-6 w-full lg:w-1/3" label="Data de nascimento" icon='ph-calendar-blank' /> -->

                        <TextInput v-model="form.telefone_1" v-maska data-maska="(##) #####-####" :error="form.errors.telefone_1" class="pb-8 pr-6 w-full lg:w-1/3" label="Telefone"/>

                        <div class="pb-8 pr-6 w-full lg:w-2/3 pl-2">
                            <label class="form-label flex items-center">Áreas de atendimento: </label>

                            <div class="flex items-center pt-2">
                                <input @click="setAreas" class= "cursor-pointer appearance-none checked:bg-pink-500 checked:ring-0" type="checkbox" id="social"><label class="mr-8 pl-2 cursor-pointer hover:text-pink-500 ckecked:bg-pink-300" for="social">Social</label>
                                <input @click="setAreas" class="cursor-pointer appearance-none checked:bg-pink-500" type="checkbox" id="juridica"><label class="mr-8 pl-2 cursor-pointer hover:text-pink-500" for="juridica">Jurídica</label>
                                <input @click="setAreas" class="cursor-pointer appearance-none checked:bg-pink-500" type="checkbox" id="psicologica"><label class="mr-8 pl-2 cursor-pointer hover:text-pink-500" for="psicologica">Psicológica</label>
                                <input @click="setAreas" class="cursor-pointer appearance-none checked:bg-pink-500" type="checkbox" id="multidisciplinar"><label class="mr-8 pl-2 cursor-pointer hover:text-pink-500" for="multidisciplinar">Multidisciplinar</label>
                            </div>

                        </div>

                        <div class="pb-8 pr-6 w-full">
                            <TextAreaInput v-model="form.observacoes" :error="form.errors.observacoes" class="pb-8 pr-6 w-full lg:w-1/3" label="Observações" />   
                        </div>
                    </div>  

                    <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
                        <LoadingButton :loading="form.processing" class="btn bg-pink-600 hover:bg-pink-800" type="submit">Salvar</LoadingButton>
                    </div>

                    {{ data_cadastro }}

                    
                </form>
            </div> 
           
        </div>
    </AdminLayout>  
    
</template>

<script setup>
    import { Head, useForm } from '@inertiajs/inertia-vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import { computed, ref, reactive } from 'vue';
    
    import TextInput from '@/Components/TextInput.vue';
    import TextAreaInput from '@/Components/TextAreaInput.vue';

    import LoadingButton from '@/Components/LoadingButton.vue';

    import DatePicker from '@/Components/DatePicker.vue';

    import { vMaska } from "maska";   
    
    const form = useForm({
        data_cadastro: new Date(),
        hora_h: new Date().getHours(),
        hora_m: new Date().getMinutes(), 
        nome: null, 
        data_nascimento: null,
        cpf: null,
        telefone_1: null,
        areas: [],
        observacao: null,
    })

    const type_selected = ref('presencial');

    const hora_atendimento = computed ( () => {
        form.hora_atendimento = (form.hora_h < 10 ? '0'+form.hora_h : form.hora_h ) + ":" + (form.hora_m < 10 ? '0'+form.hora_m : form.hora_m );
    });

    function setAreas(event){
        if(event.target.checked){
            form.areas.push(event.target.id);
        }else{
            var index = form.areas.indexOf(event.target.id);

            if (index > -1)
            {
                form.areas.splice(index, 1);
            }
        }
    }
    
    function tipo(event) {
        type_selected.value = event.target.id;
    }

</script>