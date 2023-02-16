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

            <TableLite 
                :is-re-search="table.isReSearch"
                :columns="table.columns"
                :rows="table.rows"
                :total="table.totalRecordCount"
                :sortable="table.sortable"
                @do-search="doSearch"
            />
        </div>        

    </AdminLayout>  
    
</template>

<script setup>
    import { ref, computed, reactive} from 'vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import AdminLayout from '@/Layouts/AdminLayout.vue';
    import TableLite from "vue3-table-lite";
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/css/index.css';
    
    const props = defineProps({
        atendimentos: Object,
    });

    const isLoading = ref(false);


    const table = reactive({
        isReSearch: false,
        columns: [
            {
                label: "ID.",
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
                label: "Nome do assistido",
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
        ],
        rows: [],
        totalRecordCount: 0,
        sortable: {
            order: "id",
            sort: "asc",
        },
    });

    const doSearch = (offset, limit, order, sort) => {
        isLoading.value = true;
       
        table.isReSearch = offset == undefined ? true : false;
        
        if(offset >= limit){
            limit = offset+limit;
        }

        table.rows = getDados(props.atendimentos, offset, limit, order, sort);

        table.totalRecordCount = table.rows.length;
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

            elemento.data_atendimento =elemento.data_atendimento.split('-').reverse().join('/');

            return elemento;    
        });
    }   

    doSearch(0,20,'id','desc');
    
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
   
</style>

    