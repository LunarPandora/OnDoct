<script setup>
    import { ref, reactive, watch } from 'vue'
    import axios from 'axios'

    let pasien = ref({})
    let appointment = ref([])
    
    const filterTgl = ref('default')

    const props = defineProps({
        emailPasien : String
    });

    axios
    .post('http://localhost:8000/app/pasien/retrieve', {email: props.emailPasien})
    .then(function (rp) {
        pasien.value = rp.data;

        axios
        .post('http://localhost:8000/app/appointment/list', {id: pasien.value.id, filterByTgl: filterTgl.value, target: 'pasien'})
        .then(function (ra) {
            appointment.value = []

            ra.data.forEach(function (val){
                appointment.value.push(val);
            })
        })
    })

    watch(filterTgl, (x) => {
        axios
        .post('http://localhost:8000/app/appointment/list', {id: pasien.value.id, filterByTgl: x, target: 'pasien'})
        .then(function (ra) {
            appointment.value = []

            ra.data.forEach(function (val){
                appointment.value.push(val);
            })
        })
    })

</script>
<template>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center" style="padding: 25px 15px;">
            <div>
                <h4 style="font-weight: 600; color: #3766BC; margin: 0;">OnDoct</h4>
            </div>
            <div class="d-flex flex-row align-items-center justify-content-center">
                <h4 style="color: #3766BC; margin: 0; padding-right: 15px;">{{ pasien.nama_pasien }}</h4>
                <img src="https://simplyilm.com/wp-content/uploads/2017/08/temporary-profile-placeholder-1.jpg" class="img-fluid" style="width: 40px; height: 40px; border-radius: 100%;">
            </div>
        </div>
        <div style="padding: 15px;">
            <h4 style="color: #3766BC">Cek Appointment</h4>
            
            <table style="border: 1px solid #ccc; width: 100%;">
                <thead>
                    <tr align="center">
                        <th><h5 style="margin: 0; color: #3766bc;">No Antrian</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">Nama Dokter</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">Waktu Appointment</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">Status</h5></th>
                    </tr>
                    <tr align="center">
                        <td></td>
                        <td>
                        </td>
                        <td>
                            <select id="filterTgl" name="ftgl" v-model="filterTgl">
                                <option value="default">Default</option>
                                <option value="asc">Terdekat</option>
                                <option value="desc">Terjauh</option>
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr align="center" v-for="(item, index) in appointment">
                        <td>{{ item.antrian }}</td>
                        <td>{{ item.nama_dokter }}</td>
                        <td>{{ item.waktu_appointment }}</td>
                        <td>{{ item.status_appointment }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>