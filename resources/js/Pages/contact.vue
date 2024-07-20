<template>
    <div>
        <Title :title="'Hubungi Kami'"/>
        <Navbar/>

        <ContactUs/>
        <Footer/>
    </div>
</template>

<script setup>
import Title from './Components/Section/Title.vue';
import Navbar from './Components/Navbar.vue';
import ContactUs from './Components/Section/ContactUs.vue';
import Footer from './Components/Footer.vue';
</script>