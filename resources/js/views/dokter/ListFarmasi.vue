<script setup>
    import { ref, reactive, watch } from 'vue'
    import axios from 'axios'

    let dokter = ref({})
    let farmasi = ref([])

    const props = defineProps({
        emailDokter : String
    });

    const filterName = ref('default')

    axios
        .post('http://localhost:8000/app/dokter/retrieve', {email: props.emailDokter})
        .then((rd) => {
            dokter.value = rd.data;

            axios
            .post('http://localhost:8000/app/farmasi/list')
            .then(function (rf) {
                rf.data.forEach(function (val){
                    farmasi.value.push(val);
                })
            })
        })

    watch(filterName, (fName) => {
        axios
        .post('http://localhost:8000/app/farmasi/list', {filterByName: filterName.value})
        .then(function (rf) {
            farmasi.value = []

            rf.data.forEach(function (val){
                farmasi.value.push(val);
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
        <div style="padding: 15px;" id="farmasi">
            <h4 style="color: #3766BC">List Farmasi</h4>
            <table style="border: 1px solid #ccc; width: 100%;">
                <thead>
                    <tr align="center">
                        <th><h5 style="margin: 0; color: #3766bc;">No</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">Nama Farmasi</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">No Telp</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">Email</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">Alamat</h5></th>
                        <th><h5 style="margin: 0; color: #3766bc;">Foto Izin</h5></th>
                        <!-- <th><h5 style="margin: 0; color: #3766bc;">Aksi</h5></th> -->
                    </tr>
                    <tr align="center">
                        <td></td>
                        <td>
                            <select id="filterName" v-model="filterName">
                                <option value="default">Default</option>
                                <option value="asc">A-Z</option>
                                <option value="desc">Z-A</option>
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
               
                <tbody>
                    <tr align="center" v-for="(item, index) in farmasi">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.nama_farmasi }}</td>
                        <td>{{ item.no_telp_farmasi }}</td>
                        <td>{{ item.email_farmasi }}</td>
                        <td>{{ item.alamat_farmasi }}</td>
                        <td>
                            <button class="btn button_alt_file" data-toggle="modal" :data-target="'#model' + index">Foto</button>
                            
                            <!-- Modal -->
                            <div class="modal fade" :id="'model' + index" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Foto surat izin</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img class="img-fluid" :src="'/storage/foto_izin/' + item.foto_izin">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>                    
                </tbody>
            </table>
        </div>
    </div>
</template>