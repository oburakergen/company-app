<script setup lang="ts">
import {Card, CardContent, CardFooter} from "@/Components/ui/card";
import { UseImage } from "@vueuse/components";
import {CompanyPagination} from "@/types";
import { Link } from "@inertiajs/vue3";

defineProps<{
    companies: CompanyPagination;
    status: boolean;
}>();

</script>

<template>
    <div class="flex flex-row flex-wrap gap-4 justify-center">
        <Card v-for="company in companies.data" :key="company.id" class="hover:bg-accent">
            <CardContent class="p-6 flex justify-center">
                <div class="w-[200px]">
                 <Link :href="status ? route('company') : route('login')">
                   <UseImage class="rounded-2xl object-cover shadow shadow-gray-300" :src="company.logo" >
                     <template #loading>
                       Loading..
                     </template>

                     <template #error>
                       Failed
                     </template>
                   </UseImage>
                 </Link>
                </div>
            </CardContent>
            <CardFooter class="relative flex-col align-center text-center">
              <h1 class="truncate w-[200px] xs:w-full">
                <Link :href="status ? route('company', {id: company.id}) : route('login')">{{company.name}}</Link></h1>
              <p class="truncate w-[200px] xs:w-full"><Link :href="status ? route('company', {id: company.id}) : route('login')">{{company.email}}</Link></p>
              <a class="truncate w-[200px] xs:w-full" :href="company.website">{{ company.website }}</a>
            </CardFooter>
        </Card>

    </div>
</template>

<style scoped>

</style>
