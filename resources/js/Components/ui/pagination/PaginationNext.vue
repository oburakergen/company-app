<script setup lang="ts">
import { type HTMLAttributes, computed } from 'vue'
import { PaginationNext, type PaginationNextProps } from 'radix-vue'
import { ChevronRightIcon } from '@radix-icons/vue'
import {
  Button,
} from '@/Components/ui/button'
import { cn } from '@/Lib/utils'
import PaginationButton from "@/Components/ui/button/PaginationButton.vue";

const props = withDefaults(defineProps<PaginationNextProps & { class?: HTMLAttributes['class'] }>(), {
  asChild: true,
})

const delegatedProps = computed(() => {
  const { class: _, ...delegated } = props

  return delegated
})
</script>

<template>
  <PaginationNext v-bind="delegatedProps">
    <PaginationButton :class="cn('w-9 h-9 p-0', props.class)" variant="outline">
      <slot>
        <ChevronRightIcon />
      </slot>
    </PaginationButton>
  </PaginationNext>
</template>
