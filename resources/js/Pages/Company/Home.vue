<script setup lang="ts">
import {Company} from "@/types";
import {Head} from "@inertiajs/vue3";
import {Card, CardContent} from "@/Components/ui/card";
import { useEmployeeState } from "@/Stores/employee";
import {onMounted} from "vue";
import {Button} from "@/Components/ui/button";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps<{
    company: Company;
    status: Boolean;
}>();

const { getEmployees, fetchEmployees, deleteEmployee } = useEmployeeState();

onMounted(() => {
    fetchEmployees(props.company.id);
});

</script>

<template>
    <Head :title="`Company - ${company.name}`" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex flex-row items-center gap-4">
                <span><img :src="company.logo" :alt="company.name" class="max-w-[40px]" /></span>
                <span>{{ company.name }} Employees</span>
            </h2>
        </template>

        <div class="container mx-auto py-6 bg-transparent">
           <div class="flex flex-wrap flex-col gap-3">
             <Card v-for="employee in getEmployees">
               <CardContent class="pt-6 flex gap-4 items justify-between">
                 <div>
                   {{ employee.firstName }} {{ employee.lastName }}
                 </div>
                 <div>
                   {{ company.name }}
                 </div>
                 <div class="flex gap-2">
                   <Button variant="outline">Edit</Button>
                   <Button variant="destructive" @click="deleteEmployee(employee.id)">Delete</Button>
                 </div>
               </CardContent>
             </Card>
           </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
