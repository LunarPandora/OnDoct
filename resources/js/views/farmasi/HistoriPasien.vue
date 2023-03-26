<script setup>
    import { ref, reactive, watch } from 'vue'
    import axios from 'axios'

    let farmasi = ref({})
    let antrian = ref([])

    const filterDate = ref('default')

    const props = defineProps({
        emailFarmasi : String
    });

    axios
        .post('http://localhost:8000/app/farmasi/retrieve', {email: props.emailFarmasi})
        .then(function (rf) {
            farmasi.value = rf.data;

            // Ambil list pasien yang sudah mengambil obat
            axios
            .post('http://localhost:8000/app/resep/get', {id: farmasi.value.id, filterByDate: filterDate.value, status: 'done'})
            .then(function (rha) {
                rha.data.forEach(function (val){
                    antrian.value.push(val);
                })
            })
        })

    watch(filterDate, (fDate) => {
        axios
            .post('http://localhost:8000/app/resep/get', {id: farmasi.value.id, filterByDate: filterDate.value, status: 'done'})
            .then(function (rha) {
                antrian.value = []

                rha.data.forEach(function (val){
                    antrian.value.push(val);
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
                <h4 style="color: #3766BC; margin: 0; padding-right: 15px;">{{ farmasi.nama_farmasi }}</h4>
                <img src="https://simplyilm.com/wp-content/uploads/2017/08/temporary-profile-placeholder-1.jpg" class="img-fluid" style="width: 40px; height: 40px; border-radius: 100%;">
            </div>
        </div>
        <div style="padding: 15px;" id="farmasi">
            <h4 style="color: #3766BC">Histori Resep</h4>
            <table style="border: 1px solid #ccc; width: 100%;">
                <tr align="center">
                    <th><h5 style="margin: 0; color: #3766bc;">No</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Nama Pasien</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Nama Dokter</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Resep</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Waktu</h5></th>
                </tr>
                <tr align="center">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <select id="filterTgl" name="ftgl1" v-model="filterDate">
                            <option value="default">Default</option>
                            <option value="asc">Terdekat</option>
                            <option value="desc">Terjauh</option>
                        </select>
                    </td>
                </tr>
                <tr align="center" v-for="(item, index) in antrian">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.nama_pasien }}</td>
                    <td>{{ item.nama_dokter }}</td>
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
                    <td>{{ item.waktu }}</td>
                </tr>
            </table>
        </div>
    </div>
</template>