<script setup>
    import { ref, reactive, watch } from 'vue'
    import axios from 'axios'

    let pasien = ref({})
    let dokter = ref([])

    const filterName = ref(0)
    const filterDate = ref(0)
    const dokterData = ref(1)
    const nomorAntrian = ref('Loading')

    const dataTgl = ref('');
    const dataWaktu = ref('');

    const props = defineProps({
        emailPasien : String
    });

    axios
    .post('http://localhost:8000/app/pasien/retrieve', {email: props.emailPasien})
    .then(function (rp) {
        pasien.value = rp.data;

        axios
        .post('http://localhost:8000/app/dokter/list', {filterByName: filterName.value})
        .then(function (rd) {
            dokter.value = []

            rd.data.forEach(function (val){
                dokter.value.push(val);
            })
        })

        axios
        .post('http://localhost:8000/app/appointment/queue/get', {idDokter: dokterData.value, idPasien: pasien.value})
        .then(function (rna) {
            console.log(rna)
            nomorAntrian.value = rna.data
        })
    })

    watch(dokterData, (x) => {
        axios
        .post('http://localhost:8000/app/appointment/queue/get', {idDokter: x, idPasien: pasien.value})
        .then(function (rd) {
            nomorAntrian.value = rd.data
        })
    })

    function bookingJadwal(){
        if(dataTgl.value != '' && dataWaktu.value != ''){
            let data = {
                antrian : nomorAntrian.value,
                idDokter: dokterData.value,
                idPasien: pasien.value.id,
                waktu : dataTgl.value + " " + dataWaktu.value,
            }

            axios
            .post('http://localhost:8000/app/appointment/queue/add', data)
            .then(function (rba) {
                if(rba.data == 'success'){
                    alert('Booking berhasil!')
                    location.href = 'http://localhost:8000/app'
                }
            })
        }
        else{
            alert('Mohon masukkan tanggal dan waktu!')
        }
    }

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
        <div style="padding: 15px; padding-bottom: 0;">
            <h4 style="color: #3766BC">Booking Appointment</h4>
        </div>
        <div class="row" style="padding: 15px;">
            <div class="col-lg-3">
                <div style="background-color: #3766BC; padding: 30px; color: white; border-radius: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.2)">
                    <h5>No Antrian anda : </h5>
                    <h2 style="margin: 0;" id="data_antrian">{{ nomorAntrian }}</h2>
                </div>
            </div>
            <div class="col-lg-3">
                <a href="booking/list">
                    <div style="height: 100%; background-color: #FFF; padding: 30px; border-radius: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.2)" class="d-flex align-items-center justify-content-center">
                        <h5 style="text-decoration: none; color: black">Cek Appointment anda</h5>
                        <!-- <h2 style="margin: 0;" id="data_antrian">Loading</h2> -->
                    </div>
                </a>
            </div>
        </div>
        <div style="padding: 15px;">
            <div class="row">
                <div class="col-lg-6">
                    <h4 style="color: #3766BC">
                        <i class="fas fa-fw fa-briefcase-medical"></i>
                        Pilih dokter
                    </h4>
                    <select class="form-control i-mod-in" name="dokter" id="dokter" v-model="dokterData">
                        <option v-for="item in dokter" :value="item.id">{{ item.nama_dokter }}</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <h4 style="color: #3766BC">
                        <i class="fas fa-fw fa-clock"></i>
                        Pilih Waktu Appointment
                    </h4>

                    <div class="d-flex align-items-center justify-content-between">   
                        <input class="form-control" id="tanggal" name="tanggal" type="date" style="margin-right: 4px" required v-model="dataTgl">
                        <input class="form-control" id="waktu" name="waktu" type="time" required v-model="dataWaktu">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="margin-top: 20px;" align="right">
                    <a href="http://localhost:8000/app" class="btn" style="color: #3766BC; background-color: #FFF; box-shadow: 0 4px 6px rgba(0,0,0,0.2); margin-right: 5px;">Kembali</a>
                    <input type="button" class="btn" style="color: #FFF; background-color: #3766BC; box-shadow: 0 4px 6px rgba(0,0,0,0.2);" value="Booking" @click="bookingJadwal()">
                </div>
            </div>
        </div>
    </div>
</template>