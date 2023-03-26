<script setup>
    import { ref, reactive, watch } from 'vue'
    import axios from 'axios'

    let dokter = ref({})
    let pasien = ref([])

    const props = defineProps({
        emailDokter : String
    });

    const filterDate = ref('default')

    axios
        .post('http://localhost:8000/app/dokter/retrieve', {email: props.emailDokter})
        .then((rd) => {
            dokter.value = rd.data;

            axios
            .post('http://localhost:8000/app/pasien/list', {id: dokter.value.id, filterByDate: filterDate.value})
            .then(function (rf) {
                rf.data.forEach(function (val){
                    pasien.value.push(val);
                })
            })
        })

    watch(filterDate, (fDate) => {
        axios
        .post('http://localhost:8000/app/pasien/list', {id: dokter.value.id, filterByDate: filterDate.value})
        .then(function (rp) {
            pasien.value = []

            rp.data.forEach(function (val){
                pasien.value.push(val);
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
                <h4 style="color: #3766BC; margin: 0; padding-right: 15px;">{{ dokter.nama_dokter }}</h4>
                <img src="https://simplyilm.com/wp-content/uploads/2017/08/temporary-profile-placeholder-1.jpg" class="img-fluid" style="width: 40px; height: 40px; border-radius: 100%;">
            </div>
        </div>

        <div style="padding: 15px;">
            <h4 style="color: #3766BC">List Pasien</h4>
            <table style="border: 1px solid #ccc; width: 100%;">
                <tr align="center">
                    <th><h5 style="margin: 0; color: #3766bc;">Antrian</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Nama Pasien</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Waktu</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Status</h5></th>
                </tr>
                <tr align="center">
                    <td></td>
                    <td></td>
                    <td>
                        <select id="filterTgl" name="ftgl1" v-model="filterDate">
                            <option value="default">Default</option>
                            <option value="asc">Terdekat</option>
                            <option value="desc">Terjauh</option>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr align="center" v-for="item in pasien">
                    <td>{{ item.antrian }}</td>
                    <td>{{ item.nama_pasien }}</td>
                    <td>{{ item.waktu_appointment }}</td>
                    <td>{{ item.status_appointment }}</td>
                </tr>
            </table>
        </div>
    </div>
</template>