<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import {Card, CardContent} from "@/Components/ui/card";
import {Button} from "@/Components/ui/button";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {onMounted} from "vue";
import {useCompanyState} from "@/Stores/company";
import {UseImage} from "@vueuse/components";
import ButtonLink from "@/Components/ui/button/ButtonLink.vue";
const { getCompanies, fetchCompanies, deleteCompany} = useCompanyState();

onMounted(() => fetchCompanies())
</script>

<template>
    <Head title="Company" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex flex-row items-center gap-4">
                <span>Companies</span>
            </h2>
        </template>

        <div class="container mx-auto py-6 bg-transparent">
           <div class="flex flex-wrap flex-col gap-3">
             <Card v-for="company in getCompanies">
               <CardContent class="pt-6 flex gap-4 items justify-between">
                 <UseImage class="rounded-2xl object-cover shadow shadow-gray-300 max-w-[50px]" :src="company.logo" >
                   <template #loading>
                     Loading..
                   </template>

                   <template #error>
                     Failed
                   </template>
                 </UseImage>
                 <div>
                   {{ company.name }}
                 </div>
                 <div>
                   {{ company.name }}
                 </div>
                 <div class="flex gap-2">
                   <ButtonLink :href="route('company.create')" variant="outline">Add</ButtonLink>
                   <ButtonLink :href="route('company.show', {'company': company.id})" variant="outline">Show</ButtonLink>
                   <ButtonLink :href="route('company.edit', {'company': company.id})" variant="outline">Edit</ButtonLink>
                   <Button variant="destructive" @click="deleteCompany(company.id)">Delete</Button>
                 </div>
               </CardContent>
             </Card>
           </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
