<script setup>
    import { ref, reactive, watch } from 'vue'
    import axios from 'axios'

    let farmasi = ref({})
    let antrian = ref([])
    let panjangAntrian = ref(0)

    const filterDate = ref('default')

    const props = defineProps({
        emailFarmasi : String
    });

    function getData(){
        axios
        .post('http://localhost:8000/app/farmasi/retrieve', {email: props.emailFarmasi})
        .then(function (rf) {
            farmasi.value = rf.data;

            // Ambil list antrian resep obat
            axios
            .post('http://localhost:8000/app/resep/get', {id: farmasi.value.id, filterByDate: filterDate.value, status: 'waiting'})
            .then(function (rha) {
                antrian.value = []

                rha.data.forEach(function (val){
                    antrian.value.push(val);
                })
            })

            // Ambil jumlah antrian
            axios
            .post('http://localhost:8000/app/resep/queue', {id: farmasi.value.id})
            .then(function (rha) {
                panjangAntrian.value = rha.data
            })
        })
    }
    
    function requestAcceptQueue(id_request){
        let confirmation = confirm('Apakah anda yakin untuk mengkonfirmasi pesanan ini?')
        if(confirmation){
            axios
            .post('http://localhost:8000/app/resep/update', {id: id_request})
            .then((rq) => {
                if(rq.data == 'success'){
                    getData()
                }
                else{
                    alert('Gagal menjalankan request!')
                }
            })
        }
    }

    watch(filterDate, (fDate) => {
        axios
            .post('http://localhost:8000/app/resep/get', {id: farmasi.value.id, filterByDate: filterDate.value, status: 'waiting'})
            .then(function (rha) {
                antrian.value = []

                rha.data.forEach(function (val){
                    antrian.value.push(val);
                })
            })
    })

    getData()
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
        <div class="row" style="padding: 15px;">
            <div class="col-lg-6">
                <div style="background-color: #3766BC; padding: 30px; color: white; border-radius: 25px;">
                    <h4>{{ farmasi.nama_farmasi }}</h4>
                    <h6 style="margin: 0;">{{ emailFarmasi }}</h6>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="app/farmasi/data/history">
                            <div style="background-color: #17A2B8; padding: 12.5px 15px; color: white; border-radius: 15px;" align="center">
                                <h5 style="margin: 0;">Histori</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12">
                        <div style="background-color: #007BFF; margin-top: 17.5px; padding: 12.5px 15px; color: white; border-radius: 15px;" align="center">
                            <h5 style="margin: 0;">Jumlah antrian saat ini : {{ panjangAntrian }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding: 15px;" id="farmasi">
            <h4 style="color: #3766BC">Antrian Resep</h4>
            <table style="border: 1px solid #ccc; width: 100%;">
                <tr align="center">
                    <th><h5 style="margin: 0; color: #3766bc;">No</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Nama Pasien</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Nama Dokter</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Resep</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Waktu</h5></th>
                    <th><h5 style="margin: 0; color: #3766bc;">Aksi</h5></th>
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
                    <td></td>
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
                    <td>
                        <button type="button" class="btn btn-success" @click="requestAcceptQueue(item.id_appointment)">Konfirmasi</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>