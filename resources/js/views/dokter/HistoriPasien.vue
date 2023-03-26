<script setup>
    import { ref, reactive, watch } from 'vue'
    import axios from 'axios'

    let dokter = ref({})
    let pasien_obat = ref([])
    let pasien_selesai = ref([])

    const props = defineProps({
        emailDokter : String
    });

    const filterDate_po = ref('default') // Filter waktu pasien yang belum mengambil obat
    const filterDate_ps = ref('default') // Filter waktu pasien yang sudah mengambil obat

    watch([filterDate_po, filterDate_ps], ([filterDate_po_new, filterDate_ps_new]) => {
        getData()
    })

    // Ambil data dokter
    function getData(){
        axios
        .post('http://localhost:8000/app/dokter/retrieve', {email: props.emailDokter})
        .then((rd) => {
            dokter.value = rd.data;

            // Ambil data pasien yang belum mengambil obat
            axios
            .post('http://localhost:8000/app/appointment/queue/history', {id: dokter.value.id, status: 'waiting', filterByDate: filterDate_po.value})
            .then((rha) => {
                pasien_obat.value = []

                rha.data.forEach(function (val){
                    pasien_obat.value.push(val);
                })
            })

            // Ambil data appointment yang sudah mengambil obat
            axios
            .post('http://localhost:8000/app/appointment/queue/history', {id: dokter.value.id, status: 'done', filterByDate: filterDate_ps.value})
            .then((rha) => {
                pasien_selesai.value = []

                rha.data.forEach(function (val){
                    pasien_selesai.value.push(val);
                })
            })
        })
    }

    getData()
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
            <h4 style="color: #3766BC">List Pasien (Dalam pengambilan obat)</h4>
            <table style="border: 1px solid #ccc; width: 100%;">
                <tr align="center">
                    <th><h5 style="margin: 0; color: #3766bc;">No</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Nama Pasien</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Nama Farmasi</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Waktu</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Foto resep</h5></th>
                </tr>
                <tr align="center">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <select id="filterTgl" name="ftgl1" v-model="filterDate_po">
                            <option value="default">Default</option>
                            <option value="asc">Terdekat</option>
                            <option value="desc">Terjauh</option>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr align="center" v-for="(item, index) in pasien_obat">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.nama_pasien }}</td>
                    <td>{{ item.nama_farmasi }}</td>
                    <td>{{ item.waktu }}</td>
                    <td>
                        <button class="btn button_alt_file" data-toggle="modal" :data-target="'#modelPO' + index">Foto</button>
                        
                        <!-- Modal -->
                        <div class="modal fade" :id="'modelPO' + index" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
            </table>
        </div>
        <div style="padding: 15px;">
            <h4 style="color: #3766BC">List Pasien (Selesai)</h4>
            <table style="border: 1px solid #ccc; width: 100%;">
                <tr align="center">
                    <th><h5 style="margin: 0; color: #3766bc;">No</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Nama Pasien</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Nama Farmasi</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Waktu</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Foto resep</h5></th>
                </tr>
                <tr align="center">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <select id="filterTgl" name="ftgl1" v-model="filterDate_ps">
                            <option value="default">Default</option>
                            <option value="asc">Terdekat</option>
                            <option value="desc">Terjauh</option>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr align="center" v-for="(item, index) in pasien_selesai">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.nama_pasien }}</td>
                    <td>{{ item.nama_farmasi }}</td>
                    <td>{{ item.waktu }}</td>
                    <td>
                        <button class="btn button_alt_file" data-toggle="modal" :data-target="'#modelPS' + index">Foto</button>
                        
                        <!-- Modal -->
                        <div class="modal fade" :id="'modelPS' + index" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
            </table>
        </div>
    </div>
</template>