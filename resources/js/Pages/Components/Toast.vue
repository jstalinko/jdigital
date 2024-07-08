<template>
    <div v-if="isVisible" :class="`fixed bottom-10 right-10 bg-white p-4 rounded-md shadow-md border ${typeClassMap[type]} min-w-60`">
      <div class="flex items-center justify-between">
        <div class="text-sm font-medium">{{ message }}</div>
        <button @click="dismiss" class="ml-2">
          <svg class="w-4 h-4 text-gray-500 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, watch } from 'vue';
  
  const props = defineProps({
    show: Boolean,
    message: String,
    type: String,
  });
  
  const isVisible = ref(props.show);
  
  const typeClassMap = {
    success: 'border-green-500 text-green-600',
    error: 'border-red-500 text-red-600',
    info: 'border-blue-500 text-blue-600',
  };
  
  const dismiss = () => {
    isVisible.value = false; // Update local state to hide the toast
  };
  
  watch(() => props.show, (newValue) => {
    isVisible.value = newValue; // Synchronize prop changes to local state
  });
  </script>
  