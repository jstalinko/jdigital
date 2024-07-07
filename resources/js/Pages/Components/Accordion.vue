<template>
    <div class="accordion">
      <div
        v-for="(item, index) in items"
        :key="index"
        class="accordion-item"
      >
        <div
          class="accordion-header"
          @click="toggleAccordion(index)"
          :class="{ 'active': activeIndex === index }"
        >
          {{ item.title }}
          <span class="accordion-icon">
            <i :class="activeIndex === index ? 'fa fa-chevron-up' : 'fa fa-chevron-down'"></i>
          </span>
        </div>
        <div v-if="activeIndex === index" class="accordion-content">
          <ol class="list-decimal p-6">
            <li v-for="(s,i) in item.steps" :key="i">
                <div v-html="s"></div>
            </li>
        </ol>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  defineProps({items: Object});
  const activeIndex = ref(null);
  

  
  const toggleAccordion = (index) => {
    activeIndex.value = activeIndex.value === index ? null : index;
  };
  </script>
  
  <style scoped>
  .accordion {
    width: 100%;
  }
  
  .accordion-item {
    border-bottom: 1px solid #ddd;
  }
  
  .accordion-header {
    cursor: pointer;
    padding: 10px;
    background-color: #f9f9f9;
    border-bottom: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .accordion-header.active {
    background-color: #e9e9e9;
  }
  
  .accordion-content {
    padding: 10px;
  }
  
  .accordion-icon {
    font-size: 16px;
  }
  </style>
  