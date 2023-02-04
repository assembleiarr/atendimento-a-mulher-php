<template>
  <div>
    <div id="dropdown" />
    <div class="md:flex md:flex-col">
      <div class="md:flex md:flex-col md:h-screen bg-stone-50">
        <div class="md:flex md:flex-shrink-0 md:h-20">
          
          <div class="md:text-md flex items-center justify-between p-4 w-full text-sm bg-white border-b md:px-6 md:py-0">
            <div class="mr-4 w-full flex items-center justify-between">
              BARRA SUPERIOR
            </div>           
          </div>

        </div>
        <div class="md:flex md:flex-grow md:overflow-hidden">
          <MainMenu class="hidden flex-shrink-0 p-4 w-64 overflow-y-auto md:block bg-white" />
          <div class="p-6 md:flex-1 md:p-6 md:overflow-y-auto" scroll-region>
            <FlashMessages />

            <main>
              <slot />
            </main>

          </div>
          
        </div>
        <!-- <Footer /> -->
      </div>
    </div>
  </div>
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3';
    //import HeaderBar from '@/Components/HeaderBar.vue';
    import MainMenu from '@/Components/MainMenu.vue';
    import FlashMessages from '@/Components/FlashMessages.vue';
</script>