<template>
    <div id="idForm_farmasi">
        <h6 style="margin-bottom: 20px;">Masukkan data diri anda</h6>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text i-mod-pre">
                    <i class="fa fa-fw fa-user" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                </div>
            </div>
            <input type="text" name="nama" id="nama_farmasi" class="form-control i-mod-in" placeholder="Nama Farmasi anda" aria-describedby="helpId">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text i-mod-pre">
                    <i class="fa fa-fw fa-envelope" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                </div>
            </div>
            <input type="email" name="email" id="email_farmasi" class="form-control i-mod-in" placeholder="Email Farmasi anda" aria-describedby="helpId">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text i-mod-pre">
                    <i class="fa fa-fw fa-lock" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                </div>
            </div>
            <input type="password" name="password" id="pass_farmasi" class="form-control i-mod-in" placeholder="Password anda" aria-describedby="helpId">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text i-mod-pre">
                    <i class="fa fa-fw fa-phone" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                </div>
            </div>
            <input type="tel" name="no_telp" id="no_telp_farmasi" class="form-control i-mod-in" placeholder="Nomor telepon Farmasi anda" aria-describedby="helpId">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text i-mod-pre">
                    <i class="fa fa-fw fa-hospital-o" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                </div>
            </div>
            <input type="text" name="alamat" id="alamat_farmasi" class="form-control i-mod-in" placeholder="Alamat Farmasi" aria-describedby="helpId">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text i-mod-pre">
                    <i class="fa fa-fw fa-file-text-o" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                </div>
            </div>
            <div class="custom-file i-mod-in">
                <input type="file" name="foto_izin" id="foto_izin" class="custom-file-input" placeholder="Jenis Spesialis" aria-describedby="helpId">
                <label class="custom-file-label" id="nama_foto_farmasi" for="customFile">Foto Surat Izin Farmasi anda</label>
            </div>
        </div>
        <input type="submit" class="btn text-white" style="background-color: #3766BC; width: 100%; margin-top: 15px;" value="Lanjut">
    </div>
</template>