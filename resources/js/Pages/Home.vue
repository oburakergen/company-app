<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import {CompanyPagination} from "@/types";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import CompanyGallery from "@/Components/CompanyGallery.vue";
import PaginationSimple from "@/Components/PaginationSimple.vue";

defineProps<{
    companies: CompanyPagination;
}>();
</script>

<template>
  <Head title="Home" />
  <GuestLayout>
    <div class="container mx-auto my-6 bg-transparent">
        <CompanyGallery :companies="companies" />
        <PaginationSimple :companies="companies" />
    </div>
  </GuestLayout>
</template>

<style scoped>

</style>
