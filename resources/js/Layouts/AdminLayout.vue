<template>
  <div>
    <div id="dropdown" />
    <div class="md:flex md:flex-col">
      <div class="md:flex md:flex-col md:h-screen">
        <div class="md:flex md:flex-shrink-0">
          <div class="flex items-center justify-between px-6 py-4 bg-white md:flex-shrink-0 md:justify-center md:w-64 md:h-16">
            <Link  href="/">
              <img class="fill-white object-fill h-14" src="../../img/procuradoria-mulher.png"/>
            </Link>
            <Dropdown class="md:hidden" placement="bottom-end">
              <template #default>
                <svg class="w-6 h-6 fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg>
              </template>
              <template #dropdown>
                <div class="mt-2 px-8 py-4 bg-indigo-800 rounded shadow-lg">
                  <MainMenu />
                </div>
              </template>
            </Dropdown>
          </div>
          <div class="md:text-md flex items-center shadow justify-between p-4 w-full text-sm bg-white md:px-12 md:py-0">
            <div class="mr-4 mt-1 flex items-center text-pink-700 font-bold text-lg">
              <!-- <img class="fill-white object-fill h-12 mr-5" src="../../img/chame.png"/>  -->
              CENTRO HUMANITÁRIO DE APOIO À MULHER
            </div> 
            <Dropdown class="mt-1" placement="bottom-end">
              <template #default>
                <div class="group flex items-center cursor-pointer select-none">
                  <div class="mr-1 text-gray-700 group-hover:text-indigo-600 focus:text-indigo-600 whitespace-nowrap">
                    <span>Weverson</span>
                    <span class="hidden md:inline">&nbsp;Neto</span>
                  </div>
                  <!-- <icon class="w-5 h-5 fill-gray-400 group-hover:fill-indigo-600 focus:fill-indigo-600" name="cheveron-down" /> -->
                </div>
              </template>
              <template #dropdown>
                <div class="mt-2 py-2 text-sm bg-white rounded shadow-xl">
                  <Link class="block px-6 py-2 hover:text-white hover:bg-indigo-500" :href="`/users/2/edit`">My Profile</Link>
                  <Link class="block px-6 py-2 hover:text-white hover:bg-indigo-500" href="/users">Manage Users</Link>
                  <Link class="block px-6 py-2 w-full text-left hover:text-white hover:bg-indigo-500" href="/logout" method="delete" as="button">Logout</Link>
                </div>
              </template>
            </Dropdown>
          </div>
        </div>
        <div class="md:flex md:flex-grow md:overflow-hidden">
          <MainMenu class="hidden flex-shrink-0 p-4 w-64 bg-gray-800 overflow-y-auto md:block" />
          <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto" scroll-region>
            <FlashMessages />
            <slot />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3';
    import HeaderBar from '@/Components/HeaderBar.vue';
    import MainMenu from '@/Components/MainMenu.vue';
    import FlashMessages from '@/Components/FlashMessages.vue';
    import Dropdown from '@/Components/Dropdown.vue';

    const props = defineProps({
      auth: Object,
    })
</script>