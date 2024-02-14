<script setup lang="ts">
import {Company} from "@/types";
import {Head} from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {Card, CardContent} from "@/Components/ui/card";
import { useEmployeeState } from "@/Stores/employee";
import {onMounted} from "vue";

const props = defineProps<{
    company: Company;
    status: Boolean;
}>();

const { getEmployees, fetchEmployees } = useEmployeeState();

onMounted(() => {
    fetchEmployees(props.company.id);
});


console.log(getEmployees);

</script>

<template>
    <Head title="Home" />
    <GuestLayout>
        <div class="container mx-auto my-6 bg-transparent">
            <Card v-for="employee in getEmployees">
               <CardContent>
                   <div class="flex items">
                       <div>
                           {{ employee.firstName }} {{ employee.lastName }}
                       </div>
                       <div>
                           {{ employee.firstName }}
                       </div>
                   </div>
               </CardContent>
            </Card>
        </div>
    </GuestLayout>
</template>

<style scoped>

</style>
