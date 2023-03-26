<script setup>
    import { ref, reactive } from 'vue'
    
    import FormDokter from '../components/FormDokter.vue'
    import FormFarmasi from '../components/FormFarmasi.vue'
    import FormPasien from '../components/FormPasien.vue'

    const jns = ref('')
    const form1 = ref(true)
    const formjenis = reactive({dokter: false, pasien: false, farmasi: false})

    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    const route = document.querySelector('meta[name="r"]').getAttribute('content')

    function ubahJenis(x){
        jns.value = x
    }

    function nextStep(){
        if(jns.value == 'dokter'){
            formjenis.dokter = true
            formjenis.pasien = false
            formjenis.farmasi = false
        }
        else if(jns.value == 'pasien'){
            formjenis.pasien = true
            formjenis.dokter = false
            formjenis.farmasi = false
        }
        else if(jns.value == 'farmasi'){
            formjenis.farmasi = true
            formjenis.pasien = false
            formjenis.dokter = false
        }

        form1.value = false;
    }
</script>
<template>
    <div class="container-fluid">
      <div class="row d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-lg-4"></div>
        <div class="col-lg-4" style="padding-top: 30px; padding-bottom: 30px;">
          <div id="form-white" style="background-color: white; border-radius: 6px; padding: 40px 25px;" align="center">
            <h4 style="color: #3766BC; font-weight: 500; margin-bottom: 10px;">Selamat datang di OnDoct!</h4>
            <div class="form-group" style="width: 100%;">
                <form :action="route" enctype="multipart/form-data" method="POST" >
                    <div id="idForm1" v-if="form1">
                        <h6 style="margin-bottom: 20px;">Tentukan jenis akun anda</h6>
                        <div style="padding: 30px 0; display: flex; align-items: center; justify-content: space-evenly">
                            <label>
                            <input type="radio" name="jenis_akun_c" class="choose" value="dokter" @click="ubahJenis('dokter')">
                            <div style="background-color: #0197ca;">
                                <i class="fa fa-fw fa-user-md" aria-hidden="true" style="color: white"></i>
                            </div>
                            <p style="margin: 0;">Dokter</p>
                            </label>
                            <label>
                            <input type="radio" name="jenis_akun_c" class="choose" value="pasien" @click="ubahJenis('pasien')">
                            <div style="background-color: #5cd44e;">
                                <i class="fa fa-fw fa-user" aria-hidden="true" style="color: white"></i>
                            </div>
                            <p style="margin: 0;">Pasien</p>
                            </label>
                            <label>
                            <input type="radio" name="jenis_akun_c" class="choose" value="farmasi" @click="ubahJenis('farmasi')">
                            <div style="background-color: #d44e4e">
                                <i class="fa fa-fw fa-medkit" aria-hidden="true" style="color: white"></i>
                            </div>
                            <p style="margin: 0;">Farmasi</p>
                            </label>
                        </div>
                        <button type="button" class="btn text-white" style="background-color: #3766BC; width: 100%; margin-top: 15px;" @click="nextStep()" id="lanjutUser">Lanjut</button>
                    </div>
                    <input type="hidden" name="jenis_akun" id="jenis_akun" v-bind:value="jns">
                    <input type="hidden" name="_token" :value="csrf">

                    <FormPasien v-if="formjenis.pasien" />
                    <FormFarmasi v-if="formjenis.farmasi" />
                    <FormDokter v-if="formjenis.dokter" />
                </form>
            </div>
            <div style="width: 80%; padding-top: 20px;" align="center">
              <p style="color: #3443a3; font-weight: 500; font-size: 17px; margin-top: 8px;"><a href="register.html">Sudah punya akun? Masuk.</a></p>
            </div>
          </div>
        </div>
        <div class="col-lg-4"></div>
      </div>
    </div>
    
</template>