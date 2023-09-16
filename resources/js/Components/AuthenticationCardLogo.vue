<script setup>
import { Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Link :href="$page.props.logo">
        <img :src="$page.props.logo" class="w-16 h-16" style="border-radius: 50%">
    </Link>
</template>
