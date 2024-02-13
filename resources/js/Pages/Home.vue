<script setup lang="ts">
import {Button} from "@/Components/ui/button";
import { Head } from '@inertiajs/vue3';
import {Card, CardContent, CardFooter} from "@/Components/ui/card";
import {CompanyPagination} from "@/types";
import {
  Pagination,
  PaginationEllipsis,
  PaginationFirst,
  PaginationLast,
  PaginationList,
  PaginationListItem,
  PaginationNext,
  PaginationPrev,
} from '@/Components/ui/pagination'
import { Link } from '@inertiajs/vue3'
import GuestLayout from "@/Layouts/GuestLayout.vue";

const props = defineProps<{
    companies: CompanyPagination;
}>();

console.log(props.companies);
</script>

<template>
  <Head title="Home" />
  <GuestLayout>
    <div class="container mx-auto my-6 bg-transparent">
      <div class="flex flex-row flex-wrap gap-4 justify-center">
        <Card  v-for="company in companies.data" :key="company.id">
          <CardContent class="p-6 flex justify-center">
            <div class="w-[200px]">
              <img class="rounded-2xl object-cover shadow shadow-gray-300" :src="company.logo" :alt="company.name" />
            </div>
          </CardContent>
          <CardFooter class="relative flex-col align-center text-center">
            <h1 class="truncate w-[200px] xs:w-full">{{company.name}}</h1>
            <p class="truncate w-[200px] xs:w-full">{{company.email}}</p>
            <a class="truncate w-[200px] xs:w-full" :href="company.website">{{ company.website }}</a>
          </CardFooter>
        </Card>

      </div>
      <div class="flex justify-center my-6" v-if="companies.total > 15">
        <Pagination v-slot="{ page }" :total="companies.total - 1" :sibling-count="1" show-edges :default-page="1">
          <PaginationList v-slot="{ items }" class="flex items-center gap-1">
            <PaginationFirst />
            <PaginationPrev />

            <template v-for="(item, index) in items">
              <PaginationListItem v-if="item.type === 'page'" :key="index" :value="item.value" as-child>
                <Link :href="route('home')+'?page='+item.value" class="w-10 h-10 p-0" :variant="item.value === page ? 'default' : 'outline'">
                  {{ item.value }}
                </Link>
              </PaginationListItem>
              <PaginationEllipsis v-else :key="item.type" :index="index" />
            </template>

            <PaginationNext />
            <PaginationLast />
          </PaginationList>
        </Pagination>
      </div>
    </div>
  </GuestLayout>
</template>

<style scoped>

</style>
