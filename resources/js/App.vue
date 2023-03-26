<script setup>
    import { ref, reactive } from 'vue'
    import axios from 'axios'

    import Register from './views/Register.vue'

    import Pasien from './components/Pasien.vue'
    import Dokter from './components/Dokter.vue'
    import Farmasi from './components/Farmasi.vue'

    import ListDokter from './views/pasien/ListDokter.vue'
    import ListFarmasiPasien from './views/pasien/ListFarmasi.vue'
    import BookingAppointment from './views/pasien/BookingAppointment.vue'
    import CheckAppointment from './views/pasien/CheckAppointment.vue'

    import ListPasien from './views/dokter/ListPasien.vue'
    import DokterHistoriPasien from './views/dokter/HistoriPasien.vue'
    import ListFarmasiDokter from './views/dokter/ListFarmasi.vue'

    import FarmasiHistoriPasien from './views/farmasi/HistoriPasien.vue'

    const currentRoute = ref(window.location.pathname)
    const userData = reactive({status: '', email: ''})

    if(currentRoute.value != '/register'){
        axios
            .post('http://localhost:8000/app/retrieve')
            .then(function (r) {
                userData.status = r.data.status
                userData.email = r.data.email
            });
    }
</script>
<template>
    <Register v-if="currentRoute == '/register'"></Register>
    
    <Pasien v-if="userData.status == 'pasien' && currentRoute == '/app'" :email-pasien="userData.email"></Pasien>
    <ListDokter v-if="userData.status == 'pasien' && currentRoute == '/app/pasien/data/dokter'" :email-pasien="userData.email"></ListDokter>
    <ListFarmasiPasien v-if="userData.status == 'pasien' && currentRoute == '/app/pasien/data/farmasi'" :email-pasien="userData.email"></ListFarmasiPasien>
    <BookingAppointment v-if="userData.status == 'pasien' && currentRoute == '/app/pasien/data/booking'" :email-pasien="userData.email"></BookingAppointment>
    <CheckAppointment v-if="userData.status == 'pasien' && currentRoute == '/app/pasien/data/booking/list'" :email-pasien="userData.email"></CheckAppointment>

    <Dokter v-if="userData.status == 'dokter'  && currentRoute == '/app'" :email-dokter="userData.email"></Dokter>
    <ListPasien v-if="userData.status == 'dokter'  && currentRoute == '/app/dokter/data/appointment'" :email-dokter="userData.email"></ListPasien>
    <DokterHistoriPasien v-if="userData.status == 'dokter' && currentRoute == '/app/dokter/data/pasien'" :email-dokter="userData.email"></DokterHistoriPasien>
    <ListFarmasiDokter v-if="userData.status == 'dokter' && currentRoute == '/app/dokter/data/farmasi'" :email-dokter="userData.email"></ListFarmasiDokter>

    <Farmasi v-if="userData.status == 'farmasi' && currentRoute == '/app'" :email-farmasi="userData.email"></Farmasi>
    <FarmasiHistoriPasien v-if="userData.status == 'farmasi' && currentRoute == '/app/farmasi/data/history'" :email-farmasi="userData.email"></FarmasiHistoriPasien>
</template>