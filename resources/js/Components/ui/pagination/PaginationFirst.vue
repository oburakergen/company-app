<script setup lang="ts">
import { type HTMLAttributes, computed } from 'vue'
import { PaginationFirst, type PaginationFirstProps } from 'radix-vue'
import { DoubleArrowLeftIcon } from '@radix-icons/vue'
import {
  Button,
} from '@/Components/ui/button'
import { cn } from '@/Lib/utils'
import PaginationButton from "@/Components/ui/button/PaginationButton.vue";

const props = withDefaults(defineProps<PaginationFirstProps & { class?: HTMLAttributes['class'] }>(), {
  asChild: true,
})

const delegatedProps = computed(() => {
  const { class: _, ...delegated } = props

  return delegated
})
</script>

<template>
  <PaginationFirst v-bind="delegatedProps">
    <PaginationButton :class="cn('w-9 h-9 p-0', props.class)" variant="outline">
      <slot>
        <DoubleArrowLeftIcon />
      </slot>
    </PaginationButton>
  </PaginationFirst>
</template>
