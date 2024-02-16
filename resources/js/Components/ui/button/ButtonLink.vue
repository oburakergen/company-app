<script setup lang="ts">
import type { HTMLAttributes } from 'vue'
import { Primitive, type PrimitiveProps } from 'radix-vue'
import { type ButtonVariants, buttonVariants } from '.'
import { cn } from '@/Lib/utils'
import { Link } from "@inertiajs/vue3";

interface Props extends PrimitiveProps {
  variant?: ButtonVariants['variant']
  size?: ButtonVariants['size']
  as?: string
  class?: HTMLAttributes['class']
}

const props = withDefaults(defineProps<Props>(), {
  as: 'a',
  href: String,
})
</script>

<template>
  <Link
      :as="as"
      :as-child="asChild"
      :class="cn(buttonVariants({ variant, size }), props.class)"
      :href="props.href"
  >
    <slot />
  </Link>
</template>
