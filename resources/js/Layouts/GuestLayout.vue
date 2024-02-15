<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full absolute flex flex-row-reverse right-16">
      <Link :href="route('login')">
        Giriş Yap
      </Link>

    </div>
    <div>
      <Link href="/">
        <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
      </Link>
    </div>

      <slot />
    </div>
</template>
