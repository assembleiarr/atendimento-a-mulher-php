<template>   
        <div class="w-full mb-3 text-pink-600 text-xl font-bold">Dados do atendimento</div>

        <TextInput  v-model="form.data_atendimento" v-maska data-maska="##/##/####" placeholder="DD/MM/AAAA" :error="form.errors.data_atendimento" class="pb-8 pr-6 w-full lg:w-1/3" label="Data do atendimento"/>

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

        <TextInput v-model="form.cpf" @blur="loadAssistido" v-maska data-maska="###.###.###-##" :error="form.errors.cpf" class="pb-8 pr-6 w-full lg:w-1/3" label="CPF" />
        <TextInput v-model="form.nome" :error="form.errors.nome" class="pb-8 pr-6 w-full lg:w-2/3" label="Nome da assistida"/>         
        <TextInput v-model="form.telefone_principal" v-maska data-maska="(##) #########" :error="form.errors.telefone_principal" class="pb-8 pr-6 w-full lg:w-1/3" label="Telefone"/>

        <div class="pb-8 pr-6 w-full lg:w-2/3">
            <div class="w-full mb-2 text-pink-600 text-xl font-bold">Áreas de atendimento</div>

            <div class="flex items-center pt-2">
                <div v-for="area, key in areas">
                    <input  @click="setAreas" type="checkbox" :id="key" class="cursor-pointer appearance-none checked:bg-pink-500"/><label :for="area.key" class="mr-8 pl-2 cursor-pointer hover:text-pink-500 ckecked:bg-pink-300">{{ area }}</label>
                </div>
            </div>

            <div v-if="form.errors.areas" class="form-error">{{ form.errors.areas }}</div>

        </div>

         <div class="pb-8 pr-6 w-full">
            <div class="w-full mb-2 text-pink-600 text-xl font-bold">Observações</div>
            <TextAreaInput v-model="form.observacoes" :error="form.errors.observacoes" class="pb-8 pr-6 w-full lg:w-1/3" label="" />   
        </div>

</template>

<script setup>
    import TextInput from '@/Components/TextInput.vue';
    import { vMaska } from "maska";  
    import TextAreaInput from '@/Components/TextAreaInput.vue';

    const props = defineProps({
        form: Object,
        areas: Object,
    })

    const emit = defineEmits(['isLoading'])

    function setAreas(event){
        if(event.target.checked){
            props.form.areas.push(event.target.id);
        }else{
            var index = props.form.areas.indexOf(event.target.id);

            if (index > -1)
            {
                props.form.areas.splice(index, 1);
            }
        }
    }

    function loadAssistido(){
        if(props.form.cpf != null){
            const cpf = props.form.cpf.replace(/\D/gim, '');

            emit('isLoading',true);

            axios.get('/api/assistido/'+cpf)
                .then(function (response) {              

                    if(response.data){ 
                        let fields = Object.keys(response.data);            
                        props.form.nome = response.data.nome;
                        props.form.telefone_principal = response.data.telefone_principal;                      
                    
                    }else{                  
                        props.form.reset();                 
                        props.form.cpf = cpf;                    
                    }
                })
                .catch(function (error) {
                    console.error(error);
                })
                .then(function () {
                    emit('isLoading', false);
                });  
        }
        

    }
    
</script>