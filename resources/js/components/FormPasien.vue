<template>
    <div id="idForm_pasien">
        <h6 style="margin-bottom: 20px;">Masukkan data diri anda</h6>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text i-mod-pre">
                    <i class="fa fa-fw fa-user" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                </div>
            </div>
            <input type="text" name="nama" id="nama_pasien" class="form-control i-mod-in" placeholder="Nama anda" aria-describedby="helpId">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text i-mod-pre">
                    <i class="fa fa-fw fa-envelope" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                </div>
            </div>
            <input type="email" name="email" id="email_pasien" class="form-control i-mod-in" placeholder="Email anda" aria-describedby="helpId">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text i-mod-pre">
                    <i class="fa fa-fw fa-lock" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                </div>
            </div>
            <input type="password" name="password" id="pass_pasien" class="form-control i-mod-in" placeholder="Password anda" aria-describedby="helpId">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text i-mod-pre">
                    <i class="fa fa-fw fa-phone" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                </div>
            </div>
            <input type="tel" name="no_telp" id="no_telp_pasien" class="form-control i-mod-in" placeholder="Nomor telepon anda" aria-describedby="helpId">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text i-mod-pre">
                    <i class="fas fa-allergies fa-fw" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                </div>
            </div>
            <input type="text" name="alergi" id="alergi" class="form-control i-mod-in" placeholder="Alergi yang anda miliki" aria-describedby="helpId">
        </div>
        <div class="form-group" style="margin: 0;">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text i-mod-pre">
                        <i class="fas fa-pray fa-fw" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                    </div>
                </div>
                <select class="form-control i-mod-in" name="agama" id="agama">
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Kong Hu Cu">Kong Hu Cu</option>
                </select>
            </div>
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text i-mod-pre">
                    <i class="fa fa-fw fa-home" style="font-size: 22px; color: #3766BC;" aria-hidden="true"></i>
                </div>
            </div>
            <input type="text" name="alamat" id="alamat_pasien" class="form-control i-mod-in" placeholder="Alamat Rumah" aria-describedby="helpId">
        </div>
        
        <h6 style="margin: 0; margin-top: 20px;">Jenis kelamin anda</h6>
        <div style="padding: 15px 0 0 0; display: flex; align-items: center; justify-content: space-evenly">
            <label>
                <input type="radio" name="gender" class="choose" value="l">
                <div style="background-color: #0197ca;">
                    <i class="fa fa-fw fa-male" aria-hidden="true" style="color: white"></i>
                </div>
                <p style="margin: 0;">Pria</p>
            </label>
            <label>
                <input type="radio" name="gender" class="choose" value="p">
                <div style="background-color: #d44e4e;">
                    <i class="fa fa-fw fa-female" aria-hidden="true" style="color: white"></i>
                </div>
                <p style="margin: 0;">Wanita</p>
            </label>
        </div>
        <input type="submit" class="btn text-white" style="background-color: #3766BC; width: 100%; margin-top: 15px;" value="Lanjut">
    </div>
</template>