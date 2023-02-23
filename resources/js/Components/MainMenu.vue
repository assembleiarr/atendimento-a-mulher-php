<template>
  <div>
   
    <div class="mb-4">   

      <div v-for="item in menu">
        <MenuList :items="item" />
      </div>            
      
<!-- 
      <Link class="group flex items-center py-3 text-gray-200" href="/atendimento">
        <ph-chat-teardrop-text :size="32" class="mr-2"/>     
        <div>Cadastrar atendimento</div>
      </Link>

      <Link class="group flex items-center py-3 text-gray-200" href="/atendimento/importar">
        <ph-file-arrow-down weight="fill" :size="32" class="mr-2"/>    
        <div>Importar atendimento</div>
      </Link> -->
    </div>
    
  </div>
</template>

<script setup>
    import MenuList  from '@/Components/MenuList.vue';

    const menu = [{
      'nome':'Atendimentos',
      'icon' : 'ph-chat-teardrop-text',
      'link' : 'atendimentos',
      'subitems': [
        {
          'nome' : 'Consultar atendimentos',
          'link' : 'atendimentos'
        },
        {
          'nome' : 'Novo atendimento',
          'link' : 'atendimento.cadastrar'
        },
        {
          'nome' : 'Importar atendimento',
          'link' : 'atendimento.importar'
        }],
    },
    // {
    //   'nome':'Assistidas',
    //   'icon' : 'ph-user',
    //   'link' : 'assistidas'
    // },
    {
      'nome':'Relatórios',
      'icon' : 'ph-chart-line-up',
      'link' : 'relatorios'
    }
    // {
    //   'nome':'Atendimentos2',
    //   'icon' : 'ph-user',
    //   'link' : 'assistidas',
    //   'subitems': [
    //     {
    //       'nome' : 'submenu2-1',
    //       'link' : 'atendimentos'
    //     },
    //     {
    //       'nome' : 'submenu2-2',
    //       'link' : 'atendimentos'
    //     }]        
    // }
  ]

</script>