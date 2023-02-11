<template>
    <Head title="Importar Atendimento" />

    <AdminLayout>
        <div>  
            <h1 class="mb-8 text-3xl font-bold flex items-center text-pink-600">
                <ph-archive-box :size="32" class="mr-2"/> Importar atendimento
            </h1>

            <div class="w-full bg-white rounded-md shadow overflow-hidden">

                <form @submit.prevent="form.post('/atendimento')">

                    <div class="flex flex-wrap -mb-8 -mr-6 p-8 outline-none box-border">    
                        <TextInput v-model="form.nome" :error="form.errors.nome" class="pb-8 pr-6 w-full lg:w-2/3" label="Nome do assistido"/>
                        <TextInput v-model="form.arquivo" :error="form.errors.arquivo" class="pb-8 pr-6 w-full lg:w-1/3" label="Nº/LETRA de identificação no Arquivo"/>

                        <TextInput v-model="form.data_nascimento" v-maska data-maska="##/##/####" :error="form.errors.data_nascimento" class="pb-8 pr-6 w-full lg:w-1/3" label="Data do atendimento"/>

                        <TextInput v-model="form.cpf" v-maska data-maska="###.###.###-##" :error="form.errors.cpf" class="pb-8 pr-6 w-full lg:w-1/3" label="CPF" />

                        <div class="pb-8 pr-6 w-full lg:w-1/3">
                            <label class="form-label">Nacionalidade: </label>

                            <div class="flex items-center pt-2">
                                <input @click="loadPais" type="radio" name="nacionalidade" class="cursor-pointer appearance-none checked:bg-pink-500" value="brasileira"/><label class="mr-8 pl-2" for="brasileira">Brasileira</label>
                                <input @click="loadPais" type="radio" name="nacionalidade" class="cursor-pointer appearance-none checked:bg-pink-500" value="estrangeira"><label class="mr-8 pl-2" for="estrangeira">Estrangeira</label>
                            </div>

                        </div>

                        <SelectInput :disabled="estados_off" v-if="nacionalidade == 'brasileira'" @change="loadMunicipios(form.estado)" v-model="form.estado" :error="form.errors.estado" class="pb-8 pr-6 w-full lg:w-1/3" label="Estado">
                            <option :value="null">Selecione o Estado </option>
                            <option v-for="estado, key in estados" :value="key">{{ estado}}</option>
                        </SelectInput>  

                        <SelectInput @input="municipios" :disabled="municipios_off" v-model="form.municipio" :error="form.errors.municipio" class="pb-8 pr-6 w-full lg:w-1/3" :label="municipio_label">
                            <option :value="null">Selecione o {{ municipio_label }} </option>
                            <option v-for="municipio, key in municipios" :value="key">{{ municipio }}</option>
                        </SelectInput>
                        
                        <TextInput v-model="form.rua" :error="form.errors.rua" class="pb-8 pr-6 w-full lg:w-1/3" label="Rua" />
                        <TextInput v-model="form.numero" :error="form.errors.numero" class="pb-8 pr-6 w-full lg:w-1/3" label="Número" />
                        <TextInput v-model="form.bairro" :error="form.errors.bairro" class="pb-8 pr-6 w-full lg:w-1/3" label="Bairro" />

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
    import { computed, ref, reactive } from 'vue';
    //import axios from 'axios';
    
    import TextInput from '@/Components/TextInput.vue';
    import SelectInput from '@/Components/SelectInput.vue';

    import LoadingButton from '@/Components/LoadingButton.vue';

    import DatePicker from '@/Components/DatePicker.vue';

    import { vMaska } from "maska";   

    const props = defineProps({
        estados: Object,
    });

    const municipios = ref([]);
    const municipios_off = ref('disabled');
    const estados_off = ref('disabled');
    const nacionalidade = ref('brasileira');
    const municipio_label = ref('Município');
    
    const form = useForm({
        data_cadastro: new Date(),
        nome: null, 
        data_nascimento: null,
        cpf: null,
        estado: null,
        municipio: null,
        rua: null,
        numero: null,
        bairro: null,
        telefone_1: null,
        areas: [],
    })

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

    function loadMunicipios(estado_id){
        municipios_off.value = 'disabled';
        form.municipio = null;       

        axios.get('/api/municipios/'+estado_id)
            .then(function (response) {
                municipios.value = response.data;
                municipios_off.value = false;
            })
            .catch(function (error) {
                console.error(error);
            })
            .then(function () {
                // sempre será executado
            });  
    }

    function loadPais($event){
        
        form.estado = null;
        form.municipio = null;

        if($event.target.value == 'brasileira'){
           nacionalidade.value = 'brasileira';
        }else{
            nacionalidade.value = 'estrangeira';
            municipio_label.value = 'País';

            axios.get('/api/paises')
                .then(function (response) {
                    municipios.value = response.data;
                    municipios_off.value = false;
                })
                .catch(function (error) {
                    console.error(error);
                })
                .then(function () {
                    // sempre será executado
                });
        }        

        estados_off.value = false;
    }

</script>