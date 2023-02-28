<script setup>
import ApplicationLogo from '@/Components/Auth/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 ">
       


        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>

        <div class="flex items-center mt-10">           
            <img src="../../img/procuradoria-mulher.png" class="fill-white object-fill h-12 mr-8">
            <img src="../../img/chame.png" class="fill-white object-fill h-12 mr-8">
            <img src="../../img/logo-ale-rr.png" class="fill-white object-fill h-12">
        </div>
    </div>
</template>
