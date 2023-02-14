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
                        <TextInput @blur="loadAssistido" v-model="form.cpf" v-maska data-maska="###.###.###-##" :error="form.errors.cpf" class="pb-8 pr-6 w-full lg:w-1/3" label="CPF" />
                        <div class="w-2/3"></div>

                        <TextInput v-model="form.nome" :error="form.errors.nome" class="pb-8 pr-6 w-full lg:w-2/3" label="Nome do assistido"/>
                        <TextInput v-model="form.local_arquivo" :error="form.errors.local_arquivo" class="pb-8 pr-6 w-full lg:w-1/3" label="Nº/LETRA de identificação no Arquivo"/>

                        <TextInput v-model="form.data_atendimento" v-maska data-maska="##/##/####" placeholder="DD/MM/AAAA" :error="form.errors.data_atendimento" class="pb-8 pr-6 w-full lg:w-1/3" label="Data do atendimento"/>

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

                        <TextInput v-model="form.telefone_principal" v-maska data-maska="(##) #####-####" :error="form.errors.telefone_principal" class="pb-8 pr-6 w-full lg:w-1/3" label="Telefone"/>

                        <div class="pb-8 pr-6 w-full lg:w-2/3 pl-2">
                            <label class="form-label flex items-center" :class="form.errors.areas ? 'text-red-700 font-semibold' : '' ">Áreas de atendimento: </label>

                            <div class="flex items-center pt-2">
                                <div v-for="area, key in areas">
                                    <input  @click="setAreas" type="checkbox" :id="key" class="cursor-pointer appearance-none checked:bg-pink-500"/><label :for="area.key" class="mr-8 pl-2 cursor-pointer hover:text-pink-500 ckecked:bg-pink-300">{{ area }}</label>
                                </div>
                                
                                <!-- <input @click="setAreas"  id="social"><label class="mr-8 pl-2 cursor-pointer hover:text-pink-500 ckecked:bg-pink-300" for="social">Social</label>
                                <input @click="setAreas"  id="juridica"><label class="mr-8 pl-2 cursor-pointer hover:text-pink-500" for="juridica">Jurídica</label>
                                <input @click="setAreas" class="cursor-pointer appearance-none checked:bg-pink-500" type="checkbox" id="psicologica">
                                <input @click="setAreas" class="cursor-pointer appearance-none checked:bg-pink-500" type="checkbox" id="multidisciplinar"><label class="mr-8 pl-2 cursor-pointer hover:text-pink-500" for="multidisciplinar">Multidisciplinar</label> -->
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
        
    import TextInput from '@/Components/TextInput.vue';
    import SelectInput from '@/Components/SelectInput.vue';

    import LoadingButton from '@/Components/LoadingButton.vue';
    
    import { vMaska } from "maska";   

    const props = defineProps({
        estados: Object,
        areas: Object,
    });

    const municipios = ref([]);
    const municipios_off = ref('disabled');
    
    const form = useForm({
        data_atendimento: null,
        nome: null, 
        local_arquivo: null,
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
        const cpf = form.cpf.replace(/\D/gim, '');

        axios.get('/api/assistido/'+cpf)
            .then(function (response) {
               

                if(response.data){ 
                    let fields = Object.keys(response.data);             

                    fields.forEach((item) => {
                       
                        form[item] = response.data[item];
                    });

                }else{
                    form.nome = null;
                }
            })
            .catch(function (error) {
                console.error(error);
            })
            .then(function () {
                // sempre será executado
            });  

    }

</script>