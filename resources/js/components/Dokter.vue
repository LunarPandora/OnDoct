<script setup>
    import { ref, reactive, watch } from 'vue'
    import axios from 'axios'

    let dokter = ref({})
    let farmasi = ref([])

    let appointment_berlangsung = ref([])
    let appointment_mengantri = ref([])
    let appointment_menunggu = ref([])

    const farmasiData = ref(1)
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

    const filterDate_ab = ref('default') // Filter waktu appointment berlangsung
    const filterDate_at = ref('default') // Filter waktu appointment mengantri
    const filterDate_mn = ref('default') // Filter waktu appointment menunggu

    watch([filterDate_ab, filterDate_at, filterDate_mn], ([filterDate_ab_new, filterDate_at_new, filterDate_mn_new]) => {
        getData()
    })

    const props = defineProps({
        emailDokter : String
    });

    // Ambil data dokter
    function getData(){
        axios
        .post('http://localhost:8000/app/dokter/retrieve', {email: props.emailDokter})
        .then((rd) => {
            dokter.value = rd.data;

            // Ambil data appointment yang sedang berlangsung
            axios
            .post('http://localhost:8000/app/appointment/list', {id: dokter.value.id, target: 'dokter', status: 'berlangsung', filterByTgl : filterDate_ab.value})
            .then((rba) => {
                appointment_berlangsung.value = []

                rba.data.forEach(function (val){
                    appointment_berlangsung.value.push(val);
                })
            })

            // Ambil data appointment yang sedang mengantri
            axios
            .post('http://localhost:8000/app/appointment/list', {id: dokter.value.id, target: 'dokter', status: 'mengantri', filterByTgl : filterDate_at.value})
            .then((rba) => {
                appointment_mengantri.value = []

                rba.data.forEach(function (val){
                    appointment_mengantri.value.push(val);
                })
            })

            // Ambil data appointment yang sedang menunggu approval dari dokter
            axios
            .post('http://localhost:8000/app/appointment/list', {id: dokter.value.id, target: 'dokter', status: 'menunggu', filterByTgl : filterDate_mn.value})
            .then((rba) => {
                appointment_menunggu.value = []

                rba.data.forEach(function (val){
                    appointment_menunggu.value.push(val);
                })
            })

            // Ambil data farmasi
            axios
            .post('http://localhost:8000/app/farmasi/list')
            .then((rf) => {
                farmasi.value = []

                rf.data.forEach(function (val){
                    farmasi.value.push(val);    
                })
            })
        })
    }

    function requestAcceptQueue(id_request, status){
        let confirmation = false;

        if(status == 'mengantri'){
            confirmation = confirm('Apakah anda yakin ingin menerima appointment ini?')
        }
        else if(status == 'berlangsung'){
            confirmation = confirm('Apakah anda yakin ingin segera memulai appointment ini?')
        }
        else if(status == 'selesai'){
            confirmation = confirm('Apakah anda yakin ingin segera mengakhiri appointment ini?')

            if(confirmation){
                return true;
            }
            else{
                return false;
            }
        }

        if(confirmation){
            axios
            .post('http://localhost:8000/app/appointment/queue/update', {id: id_request, status: status})
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

    function requestRejectQueue(id_request, status){
        if(confirm("Apakah anda yakin ingin menolak appointment ini?") == true){
            axios
            .post('http://localhost:8000/app/appointment/queue/delete', {id: id_request})
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
        <div class="row" style="padding: 15px;">
            <div class="col-lg-6">
                <div style="background-color: #3766BC; padding: 30px; color: white; border-radius: 25px;">
                    <h4>{{ dokter.nama_dokter }}</h4>
                    <h6 style="margin: 0;">{{ emailDokter }}</h6>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6">
                        <a href="app/dokter/data/pasien" style="text-decoration: none; color: white;">
                            <div style="background-color: #17A2B8; padding: 12.5px 15px; color: white; border-radius: 15px;" align="center">
                                <h5 style="margin: 0;">Histori</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a href="app/dokter/data/farmasi" style="text-decoration: none; color: white;">
                            <div style="background-color: #17A2B8; padding: 12.5px 15px; color: white; border-radius: 15px;" align="center">
                                <h5 style="margin: 0;">List Farmasi</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-12">
                        <a href="app/dokter/data/appointment" style="text-decoration: none; color: white;">
                            <div style="background-color: #007BFF; margin-top: 17.5px; padding: 12.5px 15px; color: white; border-radius: 15px;" align="center">
                                <h5 style="margin: 0;">List Pasien</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="antrian">
            <div style="padding: 15px;">
                <h4 style="color: #3766BC">Appointment yang sedang berlangsung</h4>
                <table style="border: 1px solid #ccc; width: 100%;">
                    <thead>
                        <tr align="center">
                            <th><h5 style="margin: 0; color: #3766bc;">ID Pasien</h5></th>
                            <th><h5 style="margin: 0; color: #3766bc;">Nama Pasien</h5></th>
                            <th><h5 style="margin: 0; color: #3766bc;">Waktu</h5></th>
                            <th><h5 style="margin: 0; color: #3766bc;">Aksi</h5></th>
                        </tr>
                        <tr align="center">
                            <td></td>
                            <td></td>
                            <td>
                                <select id="filterTgl" name="ftgl1" v-model="filterDate_ab">
                                    <option value="default">Default</option>
                                    <option value="asc">Terdekat</option>
                                    <option value="desc">Terjauh</option>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center" v-for="(item, index) in appointment_berlangsung">
                            <td>{{ "PN-" + item.id_pasien }}</td>
                            <td>{{ item.nama_pasien }}</td>
                            <td>{{ item.waktu_appointment }}</td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" :data-target="'#model' + index">Beri resep</button>
                                
                                <!-- Modal -->
                                <div class="modal fade" :id="'model' + index" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form style="text-align: left" action="http://localhost:8000/app/resep/request" enctype="multipart/form-data" method="POST">
                                                <div class="modal-body">
                                                    <input type="hidden" name="_token" :value="csrf">
                                                    <input type="hidden" name="id_pasien" :value="item.id_pasien">
                                                    <input type="hidden" name="id_dokter" :value="item.id_dokter">
                                                    <input type="hidden" name="waktu" :value="item.waktu_appointment">
                                                    <input type="hidden" name="id_appointment" :value="item.id_appointment">

                                                    <label for="nama_pasien">Nama Pasien</label>
                                                    <input type="text" class="form-control" name="nama_pasien" id="nama_pasien" :value="item.nama_pasien" readonly style="margin-bottom: 8px;">

                                                    <label for="riwayat">Riwayat & Detail Penyakit</label>
                                                    <input type="text" class="form-control" name="riwayat" id="riwayat" style="margin-bottom: 8px;" placeholder="Riwayat">

                                                    <label for="farmasi">Pilih farmasi</label>
                                                    <select class="form-control i-mod-in" style="margin-bottom: 8px;" name="id_farmasi" id="farmasi" v-model="farmasiData">
                                                        <option v-for="f in farmasi" :value="f.id">{{ f.nama_farmasi }}</option>
                                                    </select>

                                                    <div class="custom-file i-mod-in">
                                                        <input type="file" name="foto_resep" id="foto_resep" class="custom-file-input" placeholder="Foto resep" aria-describedby="helpId">
                                                        <label class="custom-file-label" id="nama_foto_resep" for="customFile">Foto resep</label>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit" class="btn btn-primary" @click="requestAcceptQueue(item.id_appointment, 'selesai')" value="Tandai selesai" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="padding: 15px;">
                <h4 style="color: #3766BC">Antrian</h4>
                <table style="border: 1px solid #ccc; width: 100%;">
                    <tr align="center">
                        <th><h5 style="margin: 0; color: #3766bc;">Antrian</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">ID Pasien</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">Nama Pasien</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">Waktu</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">Aksi</h5></th>
                    </tr>
                    <tr align="center">
                        <td></td>
                        <td></td>
                        <td>
                        </td>
                        <td>
                            <select id="filterTgl" name="ftgl1" v-model="filterDate_at">
                                <option value="default">Default</option>
                                <option value="asc">Terdekat</option>
                                <option value="desc">Terjauh</option>
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr align="center" v-for="item in appointment_mengantri">
                        <td>{{ item.antrian }}</td>
                        <td>{{ "PN-" + item.id_pasien }}</td>
                        <td>{{ item.nama_pasien }}</td>
                        <td>{{ item.waktu_appointment }}</td>
                        <td>
                            <button type="button" class="btn btn-success" @click="requestAcceptQueue(item.id_appointment, 'berlangsung')">Mulai</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div style="padding: 15px;">
                <h4 style="color: #3766BC">Appointment yang tersedia</h4>
                <table style="border: 1px solid #ccc; width: 100%;">
                    <tr align="center">
                        <th>
                            <h5 style="margin: 0; color: #3766bc;">No</h5>
                        </th>
                        <th>
                            <h5 style="margin: 0; color: #3766bc;">ID Pasien</h5>
                        </th>
                        <th>
                            <h5 style="margin: 0; color: #3766bc;">Nama Pasien</h5>
                        </th>
                        <th>
                            <h5 style="margin: 0; color: #3766bc;">Waktu</h5>
                        </th>
                        <th>
                            <h5 style="margin: 0; color: #3766bc;">Aksi</h5>
                        </th>
                    </tr>
                    <tr align="center">
                        <td></td>
                        <td></td>
                        <td>
                        </td>
                        <td>
                            <select id="filterTgl" name="ftgl3" form="form3" v-model="filterDate_mn">
                                <option value="default">Default</option>
                                <option value="asc">Terbaru</option>
                                <option value="desc">Terlama</option>
                            </select>
                        </td>
                        <td></td>
                    </tr>
                    <tr align="center" v-for="(item, index) in appointment_menunggu">
                        <td>{{ item.antrian }}</td>
                        <td>{{ "PN-" + item.id_pasien }}</td>
                        <td>{{ item.nama_pasien }}</td>
                        <td>{{ item.waktu_appointment }}</td>
                        <td>
                            <button type="button" class="btn btn-success" @click="requestAcceptQueue(item.id_appointment, 'mengantri')">Terima</button>
                            <button type="button" class="btn btn-danger" @click='requestRejectQueue(item.id_appointment)'>Tolak</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>