<template>
    <nav class="bg-gray-100 p-3 rounded-md w-full" aria-label="Breadcrumb">
      <ol class="list-reset flex">
        <li v-for="(crumb, index) in breadcrumbs" :key="index" class="flex items-center">
          <router-link
            v-if="index !== breadcrumbs.length - 1"
            :to="crumb.href"
            class="text-blue-600 hover:text-blue-700"
          >
            {{ crumb.label }}
          </router-link>
          <span v-else class="text-gray-500">
            {{ crumb.label }}
          </span>
          <span v-if="index !== breadcrumbs.length - 1" class="mx-2 text-gray-500">/</span>
        </li>
      </ol>
    </nav>
  </template>
  
  <script setup>
  import { defineProps } from 'vue';
  
  const props = defineProps({
    breadcrumbs: {
      type: Array,
      required: true,
      default: () => [],
    },
  });
  </script>
  