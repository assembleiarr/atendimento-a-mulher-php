<template>

    <Modal :header="atendimento.nome">
        <div class="flex flex-wrap">
            <div class="pb-8 pr-6 w-full lg:w-1/3">
                <label class="font-semibold">Data atendimento</label>
                <p>{{ atendimento.data_atendimento }}</p>
            </div>  

            <div class="pb-8 pr-6 w-full lg:w-1/3">
                <label class="font-semibold">ID do atendimento</label>
                <p>{{ atendimento.id }}</p>
            </div>    

            <div class="pb-8 pr-6 w-full lg:w-1/3">
                <label class="font-semibold">CPF</label>
                <p>{{ atendimento.cpf }}</p>
            </div>    
            
            <div class="pb-8 pr-6 w-full lg:w-1/3">
                <label class="font-semibold">Data de nascimento</label>
                <p v-if="atendimento.data_nascimento">{{ atendimento.data_nascimento }}</p>
                <p v-else>Não cadastrado</p>
            </div>                 
             
            <div class="pb-8 pr-6 w-full lg:w-1/3">
                <label class="font-semibold">Telefone</label>
                <p>{{ atendimento.telefone_principal }}</p>
            </div>      
            
            <div class="pb-8 pr-6 w-full lg:w-3/3">
                <label class="font-semibold">Endereço</label>
                <p v-if="atendimento.endereco">
                    {{ atendimento.endereco.logradouro+", "+atendimento.endereco.numero+" - "
                    +atendimento.endereco.bairro+" - "+atendimento.endereco.municipio.nome+" / "
                    +atendimento.endereco.municipio.estado.sigla }}
                </p>
                <p v-else>Não cadastrado</p>
            </div>     
            
            <div class="pb-8 pr-6 w-full lg:w-3/3">
                <label class="font-semibold">Áreas de atendimento</label>
                <p>{{ atendimento.areas }}</p>
            </div>
        </div>
    </Modal>

</template>

<script setup>
    import Modal from '@/Components/Modal.vue';

    const props = defineProps({
        atendimento: Object,
    })
    
</script>