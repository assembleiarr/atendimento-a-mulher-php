<template>
  <div>
   
    <div class="mb-4">   

      <div v-for="item in menu">
        <MenuList :items="item" />
      </div>      
      
      

      <Link class="group flex items-center py-3 text-gray-200" href="/atendimento">
        <ph-chat-teardrop-text :size="32" class="mr-2"/>     
        <div>Cadastrar atendimento</div>
      </Link>

      <Link class="group flex items-center py-3 text-gray-200" href="/atendimento/importar">
        <ph-file-arrow-down weight="fill" :size="32" class="mr-2"/>    
        <div>Importar atendimento</div>
      </Link>
    </div>
    
  </div>
</template>

<script setup>
    import MenuList  from '@/Components/MenuList.vue';

    const menu = [{
      'nome':'Atendimentos',
      'subitems': [{
          'nome' : 'Cadastrar atendimento',
          'link' : '/atendimento'
        },
        {
          'nome' : 'Importar atendimento',
          'link' : '/atendimento/importar'
        }],
    },
    // {
    //   'nome':'Atendimentos2',
    //   'subitems': [{
    //       'nome' : 'submenu2-1',
    //       'link' : 'link1'
    //     },
    //     {
    //       'nome' : 'submenu2-2',
    //       'link' : 'link2'
    //     }],
    // }
  ]

</script>