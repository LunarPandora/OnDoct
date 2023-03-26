<script setup>
    import { ref, reactive, watch } from 'vue'
    import axios from 'axios'

    let pasien = ref({})
    let history = ref([])

    const filterName = ref(0)
    const filterDate = ref(0)

    const props = defineProps({
        emailPasien : String
    });

    axios
        .post('http://localhost:8000/app/pasien/retrieve', {email: props.emailPasien})
        .then(function (rp) {
            pasien.value = rp.data;

            axios
            .post('http://localhost:8000/app/pasien/history', {id: pasien.value.id})
            .then(function (rha) {
                rha.data.forEach(function (val){
                    history.value.push(val);
                })
            })
        })

    watch([filterName, filterDate], ([fName, fDate]) => {
        if(fName != '0'){
            filterDate.value = '0'
        }
        if(fDate != '0'){
            filterName.value = '0'
        }

        axios
        .post('http://localhost:8000/app/pasien/retrieve', {email: props.emailPasien})
        .then(function (rp) {
            pasien.value = rp.data;

            axios
            .post('http://localhost:8000/app/pasien/history', {id: pasien.value.id, filterByName: filterName.value, filterByDate: filterDate.value})
            .then(function (rha) {
                history.value = []

                rha.data.forEach(function (val){
                    history.value.push(val);
                })
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
        <div class="row" style="padding: 15px;">
            <div class="col-lg-6">
                <div style="background-color: #3766BC; padding: 30px; color: white; border-radius: 25px;">
                    <h4>{{ pasien.nama_pasien }}</h4>
                    <h6 style="margin: 0;">{{ emailPasien }}</h6>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">   
                    <div class="col-lg-6">
                        <a href="app/pasien/data/dokter">
                            <div style="background-color: #17A2B8; padding: 12.5px 15px; color: white; border-radius: 15px;" align="center">
                                <h5 style="margin: 0;">List Dokter</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a href="app/pasien/data/farmasi">
                            <div style="background-color: #17A2B8; padding: 12.5px 15px; color: white; border-radius: 15px;" align="center">
                                <h5 style="margin: 0;">List Farmasi</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12">
                        <a href="app/pasien/data/booking">
                            <div style="background-color: #007BFF; margin-top: 17.5px; padding: 12.5px 15px; color: white; border-radius: 15px;" align="center">
                                <h5 style="margin: 0;">Booking Appointment</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding: 15px;">
            <h4 style="color: #3766BC">Histori</h4>
            <table style="border: 1px solid #ccc; width: 100%;">
                <thead>
                    <tr align="center">
                        <th><h5 style="margin: 0; color: #3766bc;">No</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">Nama Dokter</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">Riwayat</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">Waktu</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">Resep</h5></th>
                    </tr>
                    <tr align="center">
                        <td>
                        </td>
                        <td>
                            <select id="filterNama" v-model="filterName">
                                <option value="0">Default</option>
                                <option value="up">A-Z</option>
                                <option value="dw">Z-A</option>
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select id="filterTgl" v-model="filterDate">
                                <option value="0">Default</option>
                                <option value="up">Terdekat</option>
                                <option value="dw">Terlama</option>
                            </select>
                        </td>
                        <td></td>
                    </tr>
                </thead>
                <tbody id="showPasien" :class="filter">
                    <tr align="center" v-for="(item, index) in history">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.nama_dokter }}</td>
                        <td>{{ item.riwayat }}</td>
                        <td>{{ item.waktu }}</td>
                        <td>
                            <button class="btn button_alt_file" data-toggle="modal" :data-target="'#model' + index">Foto</button>
                            
                            <!-- Modal -->
                            <div class="modal fade" :id="'model' + index" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Foto resep</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img class="img-fluid" :src="'/storage/foto_resep/' + item.foto_resep">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- <button @click="logout()">logout</button> -->
    </div>
</template>