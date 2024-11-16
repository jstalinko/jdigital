<template>
  <nav class="p-4 bg-blue-200 border-4 border-black container mx-auto w-full" aria-label="Breadcrumb">
    <ol class="list-reset flex space-x-2">
      <li
        v-for="(crumb, index) in breadcrumbs"
        :key="index"
        class="flex items-center"
      >
        <Link
          v-if="index !== breadcrumbs.length - 1"
          :href="crumb.href"
          class="text-pink-600 hover:text-pink-800 font-bold border-b-4 border-black pb-1"
        >
          {{ crumb.label }}
        </Link>
        <span v-else class="text-gray-900 font-bold">
          {{ crumb.label }}
        </span>
        <span
          v-if="index !== breadcrumbs.length - 1"
          class="mx-2 text-black font-extrabold"
        >
          /
        </span>
      </li>
    </ol>
  </nav>
</template>

<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  breadcrumbs: {
    type: Array,
    required: true,
    default: () => [],
  },
});
</script>
