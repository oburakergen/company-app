<script setup lang="ts">
import Checkbox from '@/Components/ui/input/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/ui/input/InputError.vue';
import InputLabel from '@/Components/ui/input/InputLabel.vue';
import TextInput from '@/Components/ui/input/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {Button} from "@/Components/ui/button";
import {Card, CardContent} from "@/Components/ui/card";

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm({
    email: 'admin@admin.com',
    password: 'password',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <Head title="Log in" />

    <GuestLayout>
       <div class="relative overflow-hidden container mx-auto">
           <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
               {{ status }}
           </div>

           <Card>
               <CardContent class="mt-6 px-6 py-4 ">
                   <form @submit.prevent="submit">
                       <div>
                           <InputLabel for="email" value="Email" />

                           <TextInput
                               id="email"
                               type="email"
                               class="mt-1 block w-full"
                               v-model="form.email"
                               required
                               autofocus
                               autocomplete="username"
                           />

                           <InputError class="mt-2" :message="form.errors.email" />
                       </div>

                       <div class="mt-4">
                           <InputLabel for="password" value="Password" />

                           <TextInput
                               id="password"
                               type="password"
                               class="mt-1 block w-full"
                               v-model="form.password"
                               required
                               autocomplete="current-password"
                           />

                           <InputError class="mt-2" :message="form.errors.password" />
                       </div>

                       <div class="block mt-4">
                           <label class="flex items-center">
                               <Checkbox name="remember" v-model:checked="form.remember" />
                               <span class="ms-2 text-sm text-gray-600">Remember me</span>
                           </label>
                       </div>

                       <div class="flex items-center justify-end mt-4">
                           <Button variant="default" class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                               Log in
                           </Button>
                       </div>
                   </form>
               </CardContent>
           </Card>
       </div>
    </GuestLayout>
</template>
