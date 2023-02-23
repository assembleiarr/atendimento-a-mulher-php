<template>
    <Head title="Importar Atendimento" />

    <AdminLayout>
    

        <div>  

            <Loading :active.sync="isLoading" 
                :can-cancel="true" 
                :is-full-page="false" 
                color="#DB2777" 
            />

            <h1 class="mb-8 text-3xl font-bold flex items-center text-pink-600">
                <ph-archive-box :size="32" class="mr-2"/> Importar atendimento
            </h1>

            <div class="w-full bg-white rounded-md shadow overflow-hidden">

                <form @submit.prevent="form.post('/atendimento')">

                    <div class="flex flex-wrap -mb-8 -mr-6 p-8 outline-none box-border">
                        <div class="w-full mb-2 text-pink-600 text-xl font-bold">Dados pessoais</div>

                        <TextInput :focus="cpfFocus" @blur="loadAssistido" v-model="form.cpf" v-maska data-maska="###.###.###-##" :error="form.errors.cpf" class="pb-8 pr-6 w-full lg:w-1/3" label="CPF" />
                                                                        
                        <TextInput :key="componentKey"  :focus="dataFocus" v-model="form.data_atendimento" v-maska data-maska="##/##/####" placeholder="DD/MM/AAAA" :error="form.errors.data_atendimento" class="pb-8 pr-6 w-full lg:w-1/3" label="Data do atendimento"/>

                        <div class="pb-8 pr-6 w-full lg:w-1/3">

                            <label class="form-label flex items-center">Nº/LETRA de identificação no Arquivo</label>

                            <div class="flex items-center">
                                <input v-model="form.local_arquivo_id" type="text" class="form-input rounded bg-gray-50 border-gray-400 w-2/3 focus:border-pink-400 focus:ring-pink-400 "/>

                                <select v-model="form.local_arquivo_letra" class="ml-2 text-gray-600 bg-gray-50 rounded border-gray-400 w-1/3  focus:border-pink-400 focus:ring-pink-400 cursor-pointer">
                                    <option :value="null" selected>Letra</option>
                                    <option v-for="letra in letras" :value="letra">
                                        {{ letra }}
                                    </option>
                                </select>  
                            </div>

                        </div>

                        <TextInput  v-model="form.nome" :error="form.errors.nome" class="pb-8 pr-6 w-full lg:w-2/3" label="Nome da assistida"/>
                        <TextInput v-model="form.data_nascimento" v-maska data-maska="##/##/####" placeholder="DD/MM/AAAA" :error="form.errors.data_nascimento" class="pb-8 pr-6 w-full lg:w-1/3" label="Data de nascimento"/>

                        <div class="w-full mb-2 mt-3 text-pink-600 text-xl font-bold">Informações de contato</div>

                        <SelectInput @change="loadMunicipios(form.estado)" v-model="form.estado" :error="form.errors.estado" class="pb-8 pr-6 w-full lg:w-1/3" label="Estado">
                            <option :value="null">Selecione o Estado </option>
                            <option v-for="estado, key in estados" :value="key">{{ estado}}</option>
                        </SelectInput>

                        <SelectInput :disabled="municipios_off" v-model="form.municipio_id" :error="form.errors.municipio_id" class="pb-8 pr-6 w-full lg:w-1/3" label="Cidade">
                            <option :value="null">Selecione a cidade </option>
                            <option v-for="municipio, key in municipios" :value="key">{{ municipio }}</option>
                        </SelectInput>
                        
                        <TextInput v-model="form.logradouro" :error="form.errors.logradouro" class="pb-8 pr-6 w-full lg:w-1/3" label="Rua" />
                        <TextInput v-model="form.numero" :error="form.errors.numero" class="pb-8 pr-6 w-full lg:w-1/3" label="Número" />
                        <TextInput v-model="form.bairro" :error="form.errors.bairro" class="pb-8 pr-6 w-full lg:w-1/3" label="Bairro" />

                        <TextInput v-model="form.telefone_principal" v-maska data-maska="(##) #########" :error="form.errors.telefone_principal" class="pb-8 pr-6 w-full lg:w-1/3" label="Telefone"/>

                        <div class="pb-8 pr-6 w-full lg:w-2/3 pl-2">
                            <div class="w-full mb-2 text-pink-600 text-xl font-bold">Áreas de atendimento</div>

                            <!-- <label class="form-label flex items-center" :class="form.errors.areas ? 'text-red-700 font-semibold' : '' ">Áreas de atendimento: </label> -->

                            <div class="flex items-center pt-2">
                                <div v-for="area, key in areas">
                                    <input  @click="setAreas" type="checkbox" :id="key" class="cursor-pointer appearance-none checked:bg-pink-500"/><label :for="area.key" class="mr-8 pl-2 cursor-pointer hover:text-pink-500 ckecked:bg-pink-300">{{ area }}</label>
                                </div>
                            </div>

                            <div v-if="form.errors.areas" class="form-error">{{ form.errors.areas }}</div>
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
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/css/index.css';
        
    import TextInput from '@/Components/TextInput.vue';
    import SelectInput from '@/Components/SelectInput.vue';

    import LoadingButton from '@/Components/LoadingButton.vue';
    
    import { vMaska } from "maska";   

    const props = defineProps({
        estados: Object,
        areas: Object,
        letras: Array,
    });

    const municipios = ref([]);
    const municipios_off = ref('disabled');

    const isLoading = ref(false);

    const cpfFocus = ref(true);
    const dataFocus = ref(false);

    const componentKey = ref(0);

    const form = useForm({
        data_atendimento: null,
        nome: null, 
        local_arquivo_id: null,
        local_arquivo_letra: null,
        data_nascimento: null,
        cpf: null,
        estado: null,
        municipio_id: null,
        logradouro: null,
        numero: null,
        bairro: null,
        telefone_principal: null,
        recepcao_tipo: 'presencial',
        is_importado: true,
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

        console.log(form.areas);
    }

    function loadMunicipios(estado_id){
        municipios_off.value = 'disabled';
        form.municipio_id = null;       

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

    function loadAssistido(){
        if(form.cpf != null){
            const cpf = form.cpf.replace(/\D/gim, '');

            isLoading.value = true;

            axios.get('/api/assistido/'+cpf)
                .then(function (response) {              

                    if(response.data){ 
                        let fields = Object.keys(response.data);         
                        
                        form.nome = response.data.nome;
                        form.telefone_principal = response.data.telefone_principal;
                        form.local_arquivo_id = response.data.assistido.local_arquivo.split("-")[0];
                        form.local_arquivo_letra = response.data.assistido.local_arquivo.split("-")[1];
                        form.data_nascimento = response.data.data_nascimento;
                        form.logradouro = response.data.endereco.logradouro;
                        form.numero = response.data.endereco.numero;
                        form.bairro = response.data.endereco.bairro;
                        form.estado = response.data.endereco.municipio.estado_id;
                        
                        loadMunicipios(response.data.endereco.municipio.estado_id);
                        form.municipio_id = response.data.endereco.municipio_id;
                    
                    }else{                  
                        form.reset();                 
                        form.cpf = cpf;                    
                    }
                })
                .catch(function (error) {
                    console.error(error);
                })
                .then(function () {
                    isLoading.value = false;
                    dataFocus.value = true;
                    componentKey.value = componentKey.value + 1;                   
                });  
        }
        

    }

</script>