<script setup lang="ts">
import type { HTMLAttributes } from 'vue'
import { type ButtonVariants, buttonVariants } from '.'
import { cn } from '@/Lib/utils'
import { Link } from '@inertiajs/vue3'
interface Props {
    variant?: ButtonVariants['variant']
    size?: ButtonVariants['size']
    as?: string
    class?: HTMLAttributes['class']
}

const props = withDefaults(defineProps<Props>(), {
    as: 'button',
    href: '',
})
</script>

<template>
    <Link
        :href="props.href"
        :class="cn(buttonVariants({ variant, size }), props.class)"
    >
        <slot />
    </Link>
</template>

<style scoped>

</style>
