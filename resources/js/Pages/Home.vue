<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import {CompanyPagination} from "@/types";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import CompanyGallery from "@/Components/gallery/CompanyGallery.vue";
import PaginationSimple from "@/Components/ui/pagination/PaginationSimple.vue";

defineProps<{
    companies: CompanyPagination;
    status: boolean;
}>();
</script>

<template>
  <Head title="Home" />
  <GuestLayout>
    <div class="container mx-auto my-6 bg-transparent">
        <CompanyGallery :companies="companies" :status="status" />
        <PaginationSimple :companies="companies" />
    </div>
  </GuestLayout>
</template>

<style scoped>

</style>
