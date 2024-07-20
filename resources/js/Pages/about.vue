<template>
    <div>
        <Title :title="'Tentang Kami'"/>
        <Navbar/>
        <About/>
        <Footer/>
    </div>
</template>

<script setup>
import Title from './Components/Section/Title.vue';
import Navbar from './Components/Navbar.vue';
import About from './Components/Section/About.vue';
import Footer from './Components/Footer.vue';
</script>