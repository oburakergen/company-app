<script setup lang="ts">
import Edit from "@/Pages/Company/Edit.vue";
import { useForm } from 'vee-validate'
import { toTypedSchema } from '@vee-validate/zod'
import * as z from 'zod'
import { Form, Field as FormField } from 'vee-validate';
import { FormItem, FormLabel, FormControl, FormMessage } from '@/Components/ui/form';
import { Input } from '@/Components/ui/input';
import { Button } from '@/Components/ui/button';
import {Card, CardContent} from "@/Components/ui/card";
import {useCompanyState} from "@/Stores/company";
import {onMounted} from "vue";
const { updateCompany, fetchCompany, getCompany } = useCompanyState();

const props = defineProps<{
  title: string;
  companyId: number;
}>();

onMounted(() => {
  fetchCompany(props.companyId).then(() => {
    form.setValues({
      name: getCompany.value.name,
      email: getCompany.value.email,
      website: getCompany.value.website,
      logo: getCompany.value.logo,
    });
  });
});

const MAX_FILE_SIZE = 5000000;
const ACCEPTED_IMAGE_TYPES = ["image/jpeg", "image/jpg", "image/png", "image/webp"];

const formSchema = toTypedSchema(z.object({
  name: z.string().min(2).max(100),
  email: z.string().min(2).max(100),
  website: z.string().min(2).max(154),
  logo: z.any()
}));

const form = useForm({
  validationSchema: formSchema,
});

const onSubmit = form.handleSubmit(async (values: any) => {
  return updateCompany(props.companyId, values).then(() => {
    // form.resetForm();
  });
})

</script>

<template>
  <Edit :title="title">
    <Card class="container mx-auto my-5">
      <CardContent>
        <form @submit="onSubmit" enctype="multipart/form-data">
          <FormField v-slot="{ componentField }" name="name" class="my-4">
            <FormItem>
              <FormLabel>name</FormLabel>
              <FormControl>
                <Input type="text" placeholder="name" v-bind="componentField" />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField v-slot="{ componentField }" name="email">
            <FormItem>
              <FormLabel>email</FormLabel>
              <FormControl>
                <Input type="email" placeholder="email" v-bind="componentField" />
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField v-slot="{ componentField }" name="logo">
            <FormItem>
              <FormLabel>Logo</FormLabel>
              <FormControl>
                <input type="file" id="logo" v-bind="componentField" :accept="ACCEPTED_IMAGE_TYPES.join(',')"/>
              </FormControl>
              <FormMessage />
            </FormItem>
          </FormField>

          <FormField v-slot="{ componentField }" name="website">
            <FormItem>
              <FormLabel>website</FormLabel>
              <FormControl>
                <Input type="text" placeholder="website" v-bind="componentField" />
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