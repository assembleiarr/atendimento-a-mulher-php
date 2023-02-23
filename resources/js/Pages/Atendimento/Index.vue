<template>
    <Head title="Atendimentos" />

    <AdminLayout>
        <div>
             <Loading :active.sync="isLoading" 
                :can-cancel="true" 
                :is-full-page="false" 
                color="#DB2777" 
            />

            <h1 class="mb-8 text-3xl font-bold flex items-center text-pink-600">
                <ph-chat-teardrop-text :size="32" class="mr-2"/> Atendimentos
            </h1>

            <div class="w-full mb-5 flex flex-wrap outline-none box-border">
                <TextInput class="w-full md:w-1/3 mb-2" v-model="nomeOuCPF" @keyup="searchNomeOuCPF" type="text" placeholder="Buscar por Nome ou CPF"/>
                <div class="w-2/3"></div>
                    <!-- <TextInput class="w-full md:w-1/3 mb-2" v-model="searchNome" type="text" placeholder="Buscar por nome"/>
                    <div class="w-2/3"></div> -->

                <!-- 
                    CRIAR UM RANGE DE DATAS
                    <v-date-picker v-model="searchDataAtendimento" color="pink" :max-date='new Date()' >
                    <template #default="{ inputValue, inputEvents }">     
                        
                            <input placeholder="Buscar por data do atendimento" class="bg-gray-50 form-input rounded border-gray-400 focus:ring-pink-300 focus:border-pink-300" :value="inputValue" v-on="inputEvents"/>
                                               
                    </template>        
                </v-date-picker> -->

                <!-- <TextInput class="w-full md:w-1/3" v-model="searchDataAtendimento" type="text" placeholder="Buscar por data do atendimento"/> -->
                <!-- <TextInput class="w-full md:w-1/3" v-model="searchDataAtendimento" type="text" placeholder="Buscar por data do atendimento"/>
                <TextInput class="w-full md:w-1/3" v-model="searchDataAtendimento" type="text" placeholder="Buscar por data do atendimento"/> -->
            </div>

            <TableLite
                :key="componentKey" 
                :is-re-search="table.isReSearch"
                :columns="table.columns"
                :rows="table.rows"
                :total="table.totalRecordCount"
                :sortable="table.sortable"
                :is-hide-paging="table.isHidePaging"
                :messages="table.messages"
                @do-search="doSearch"
            />
        </div>        

    </AdminLayout>  
    
</template>

<script setup>
    import { ref, computed, reactive} from 'vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import TextInput from '@/Components/TextInput.vue';
    import TableLite from "vue3-table-lite";
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/css/index.css';
    
    
    const props = defineProps({
        atendimentos: Object,
    });

    const isLoading = ref(false);
    const nomeOuCPF = ref('');
    const componentKey = ref(0);

    const table = reactive({
        isReSearch: false,
        columns: [
            {
                label: "ID",
                field: "id",
                width: "3%",
                headerClasses: ["center"],
                columnClasses: ["center"],
                sortable: true,
                isKey: true,
            },
            {
                label: "CPF",
                field: "cpf",
                width: "3%",
                sortable: false,
            },
            {
                label: "Nome da assistida",
                field: "nome",
                width: "10%",
                sortable: true,
            },
            {
                label: "Data atendimento",
                field: "data_atendimento",
                width: "3%",
                sortable: true,
            },
            {
                label: "Recepção",
                field: "recepcao_tipo",
                width: "3%",
                sortable: true,
                display: function (row) {
                    return (
                       row.recepcao_tipo == 'zapchame' 
                       ? '<span class="bg-pink-300 text-pink-900 text-[11px] py-[3px] px-3 rounded-lg font-bold uppercase">'+row.recepcao_tipo+'</span>' 
                       : '<span class="bg-gray-200 text-gray-500 text-[11px] py-[3px] px-3 rounded-lg font-bold uppercase">'+row.recepcao_tipo+'</span>'               
                    );
                },
            },
            {
                label: "Importado",
                field: "is_importado",
                width: "3%",
                sortable: true,
                display: function (row) {
                    return (
                       row.is_importado == true 
                       ? '<span class="bg-green-300 text-green-900 text-[11px] py-[3px] px-3 rounded-lg font-bold uppercase">IMPORTADO</span>' 
                       : ''               
                    );
                },
            },
            {
                label: "Áreas de atendimento",
                field: "areas",
                width: "5%",
                sortable: false,
            },
        ],
        rows: [],
        totalRecordCount: 0,
        sortable: {
            order: "id",
            sort: "asc",
        },
         messages: {
            pagingInfo: "Exibindo {0}-{1} de {2}",
            pageSizeChangeLabel: "Exibir:",
            gotoPageLabel: "Ir para página:",
            noDataAvailable: "Sem registros encontrados",
        },
    });

    const doSearch = (offset, limit, order, sort) => {
        isLoading.value =  nomeOuCPF.value == '' ? true : false;
       
        table.isReSearch = offset == undefined ? true : false;
        
        if(offset >= limit){
            limit = offset+limit;
        }

        table.rows = getDados(props.atendimentos, offset, limit, order, sort).filter(
            (x) =>
                x.cpf.match(/\d/g).join("").includes(nomeOuCPF.value.toLowerCase()) ||
                x.nome.toLowerCase().includes(nomeOuCPF.value.toLowerCase())
        );

        table.totalRecordCount = props.atendimentos.length;
        table.sortable.order = order;
        table.sortable.sort = sort;

        isLoading.value = false;
       
    };

    const getDados = (atendimentos, offst, limit, order, sort) => {  
        let data = [];

        if(atendimentos){
            for (let i = offst; i < limit; i++) {                
                if(atendimentos[i]){
                    data.push({
                        id: atendimentos[i].id,           
                        cpf: atendimentos[i].assistido.pessoa.cpf,               
                        nome: atendimentos[i].assistido.pessoa.nome, 
                        data_atendimento: atendimentos[i].data_atendimento,
                        recepcao_tipo: atendimentos[i].recepcao_tipo,   
                        is_importado: atendimentos[i].is_importado,            
                        areas: atendimentos[i].areas            
                    });
                }               
            }
        }   
        
        if(sort == 'asc'){
            const propComparator = (propName) =>
                (a, b) => a[propName] == b[propName] ? 0 : a[propName] < b[propName] ? -1 : 1

            data.sort(propComparator(order));

        }else{
            const propComparator = (propName) =>
                (a, b) => a[propName] == b[propName] ? 0 : a[propName] > b[propName] ? -1 : 1

            data.sort(propComparator(order));
        }      


        return data.map((elemento) => {  
            if(elemento.data_atendimento){
                elemento.data_atendimento = elemento.data_atendimento.split('-').reverse().join('/');
            }else{
                elemento.data_atendimento = 'Não cadastrado';
            }

            let areas = '';

            elemento.areas.forEach((item, index) => {
                if(index > 0){
                    areas += "; "+item.nome;
                }else{
                     areas += item.nome;
                }
                
            })

            elemento.areas = areas;

            return elemento;    
        });
    }   

    function searchNomeOuCPF(){
        componentKey.value += 1; 
        table.isHidePaging = nomeOuCPF.value != '' ? true : false;      
        
        if(/^\d+$/.test(nomeOuCPF.value)){
            nomeOuCPF.value = nomeOuCPF.value.replace(/[^\d]+/g,'');
        }

        doSearch(0, nomeOuCPF.value == '' ? 10 : 100, "order", "asc", nomeOuCPF.value);               
    }

    doSearch(0,10,'id','desc');
    
</script>

<style scope>
    .center {
        text-align: center !important;
    }

    .vtl-table{       
        @apply rounded-md mb-5 bg-white border-0;
    }

    .vtl-tbody-td{       
        @apply border-x-0 !important;
    }

    .vtl-table thead th{
        @apply border-0 !important;
        @apply bg-gray-600 !important;
        
    }

    .vtl-table thead th .vtl-sortable{
        @apply hover:text-pink-400;
    }

    .vtl-card{
        @apply bg-gray-100 !important;
    }
    .vtl-paging-count-label{
        @apply mr-1;
    }

    .vtl-paging-page-label{
        @apply mr-1 ml-4;
    }

    .vtl-paging-count-dropdown{
        @apply px-2 py-1.5 !important;
        @apply w-16 !important;
        @apply rounded;
    }

    .vtl-paging-page-dropdown{
        @apply px-2 py-1.5 !important;
        @apply w-16 !important;
        @apply rounded;
    }

    .vtl-paging-pagination-page-link-next, 
    .vtl-paging-pagination-page-link-last, .vtl-paging-pagination-page-link-prev, .vtl-paging-pagination-page-link-first{
        @apply text-pink-600 !important;
    }

    .vtl-paging-pagination-page-link{
        @apply text-pink-600 !important;
        @apply hover:bg-pink-600 !important;
        @apply hover:text-white !important;
    }

    .vtl-paging-pagination-page-li.vtl-paging-pagination-page-li-number.page-item.disabled a{
        @apply text-gray-300 !important;     
    }

</style>

    