<script setup lang="ts">
import Edit from "@/Pages/Company/Edit.vue";
import { useForm } from 'vee-validate'
import { toTypedSchema } from '@vee-validate/zod'
import * as z from 'zod'
import { Form, Field as FormField } from 'vee-validate';
import { FormItem, FormLabel, FormControl, FormMessage } from '@/Components/ui/form';
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/Components/ui/select'
import { Input } from '@/Components/ui/input';
import { Button } from '@/Components/ui/button';
import {Card, CardContent} from "@/Components/ui/card";
import {useCompanyState} from "@/Stores/company";
import {useEmployeeState} from "@/Stores/employee";
import {onMounted} from "vue";
const { getCompanies, fetchCompanies } = useCompanyState();
const { createEmployee,fetchEmployee, getEmployee  } = useEmployeeState();

const props = defineProps<{
  title: string;
  employeeId: number;
}>();

onMounted(() => {
  fetchEmployee(props.employeeId).then(() => {
    form.setValues({
      firstName: getEmployee.value.firstName,
      lastName: getEmployee.value.lastName,
      email: getEmployee.value.email,
      phone: getEmployee.value.phone,
      company_id: (getEmployee.value.company_id || 0).toString(),
    });
  });
  fetchCompanies();
});

const formSchema = toTypedSchema(z.object({
  firstName: z.string().min(2).max(50),
  lastName: z.string().min(2).max(50),
  email: z.string().email().min(2).max(150),
  phone: z.string().min(2).max(50),
  company_id: z.string(),
}));

const form = useForm({
  validationSchema: formSchema,
});

const onSubmit = form.handleSubmit(async (values: any) => {
  return createEmployee(values).then(() => {
    // form.resetForm();
  });
})

</script>

<template>
  <Edit :title="title">
    <Card class="container mx-auto my-5">
      <CardContent>
        <form @submit="onSubmit">
          <FormField v-slot="{ componentField }" name="firstName" class="my-4">
            <FormItem>
              <FormLabel>first Name</FormLabel>
              <FormControl>
                <Input type="text" placeholder="firstName" v-bind="componentField" />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField v-slot="{ componentField }" name="lastName">
            <FormItem>
              <FormLabel>last Name</FormLabel>
              <FormControl>
                <Input type="text" placeholder="lastName" v-bind="componentField" />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField v-slot="{ componentField }" name="email">
            <FormItem>
              <FormLabel>email</FormLabel>
              <FormControl>
                <Input type="email" v-bind="componentField"/>
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField v-slot="{ componentField }" name="phone">
            <FormItem>
              <FormLabel>phone</FormLabel>
              <FormControl>
                <Input type="text" placeholder="phone" v-bind="componentField" />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField v-slot="{ componentField }" name="company_id">
            <FormItem>
              <FormLabel>Companies</FormLabel>
              <FormControl>
                <Select v-bind="componentField">
                  <FormControl>
                    <SelectTrigger>
                      <SelectValue placeholder="Select a company" />
                    </SelectTrigger>
                  </FormControl>
                  <SelectContent>
                    <SelectGroup>
                      <SelectItem :value="company.id.toString()" v-for="company in getCompanies" :key="company.id">
                        {{ company.name }}
                      </SelectItem>
                    </SelectGroup>
                  </SelectContent>
                </Select>
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>


          <Button type="submit">
            Submit
          </Button>
        </form>
      </CardContent>
    </Card>
  </Edit>
</template>

<style scoped>

</style>