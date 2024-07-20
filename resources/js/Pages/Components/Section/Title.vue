<template>

    <Head>
        <title v-if="title === undefined">JavaraDigital - Solusi digital untuk bisnis anda.</title>
        <title v-if="title !== undefined">{{ title }} - JavaraDigital</title>

        <meta name="title" content="JavaraDigital">
        <meta name="description" content="Solusi Digital Untuk Bisnis Anda">
        <meta name="keywords"
            content="javaradigital, toko software, software company, script website, jual script web, jasa freelance, jasa buat web, buat web gratis, cara buat web, cara buat aplikasi, teknologi, konsultasi IT, pengembangan web, layanan IT, pengembangan aplikasi, freelancer web, pembuatan situs web, jasa IT, konsultasi teknologi, jasa pembuatan aplikasi, solusi IT, pengembangan software, software custom, web design, web development, web hosting, e-commerce solutions, mobile app development, IT support, digital marketing, SEO services, UI/UX design, cloud services, data analytics, cybersecurity, DevOps, maintenance website, integrasi sistem, jasa pembuatan website profesional, platform digital, layanan digital, aplikasi web, aplikasi mobile, manajemen proyek IT, transformasi digital, layanan IT outsource, penyedia layanan IT, solusi IT bisnis, jasa pengembangan software, layanan cloud, optimisasi SEO, desain antarmuka pengguna, pengalaman pengguna, keamanan siber">
        <meta name="robots" content="index, follow">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="Indonesia,English">
        <meta name="revisit-after" content="1 days">
        <meta name="author" content="javaradigital">

    </Head>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({ title: String });
</script>