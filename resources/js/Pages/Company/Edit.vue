<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps<{
  title: string;
}>();
</script>

<template>
  <Head :title="`Company - ${title}`" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight flex flex-row items-center gap-4">
        <span>{{ title }}</span>
      </h2>
    </template>
    <div>
      <slot />
    </div>

  </AuthenticatedLayout>
</template>

<style scoped>

</style>