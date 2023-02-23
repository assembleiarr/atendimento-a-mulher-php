<template>
    <div class="mt-10">
        <table class="table-default">
            <thead>
                <tr>
                    <th>CPF</th>
                    <th>Nome da assistida</th>
                    <th>Nascimento</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="a in assistida">
                    <td>{{ a.cpf }}</td>
                    <td>{{ a.nome }}</td>
                    <td>{{ a.data_nascimento }}</td>
                </tr>
            </tbody>
        </table>
        
    </div>
</template>

<script setup>
    const props = defineProps({
        assistida: Array,
    })
</script>