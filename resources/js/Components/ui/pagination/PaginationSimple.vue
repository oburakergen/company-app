<script setup lang="ts">
import {
    Pagination,
    PaginationEllipsis,
    PaginationFirst, PaginationLast,
    PaginationList,
    PaginationListItem,
    PaginationNext,
    PaginationPrev
} from "@/Components/ui/pagination/index";
import PaginationButton from "@/Components/ui/button/PaginationButton.vue";
import {CompanyPagination} from "@/types";
defineProps<{
    companies: CompanyPagination;
}>();
</script>

<template>
    <div class="flex justify-center my-6" v-if="companies.total > 15">
        <Pagination :total="companies.total" :sibling-count="1" :items-per-page="companies.per_page" show-edges :default-page="1">
            <PaginationList v-slot="{ items }" class="flex items-center gap-1">
                <PaginationFirst :href="companies.first_page_url" />
                <PaginationPrev :href="companies.prev_page_url || route('home')" />
                <template v-for="(item, index) in items">
                    <PaginationListItem v-if="item.type === 'page'" :key="index" :value="item.value" as-child>
                        <PaginationButton :href="route('home')+'?page='+item.value" class="w-10 h-10 p-0" :variant="item.value === companies.current_page ? 'default' : 'outline'">
                            {{ item.value }}
                        </PaginationButton>
                    </PaginationListItem>
                    <PaginationEllipsis v-else :key="item.type" :index="index" />
                </template>
                <PaginationNext :href="companies.next_page_url || '#'" />
                <PaginationLast :href="companies.last_page_url" />
            </PaginationList>
        </Pagination>
    </div>

</template>

<style scoped>

</style>
