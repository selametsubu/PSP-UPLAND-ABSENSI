<div class="row mb-5">
    <div class="col-lg-6 fv-row">
        <x-app-label class="required">Pengaturan</x-app-label>
        <x-app-input-text name="display_name" id="display_name"></x-app-input-text>
    </div>
    <div class="col-lg-6 fv-row">
        <x-app-label class="required">Varname</x-app-label>
        <x-app-input-text name="varname" id="varname"></x-app-input-text>
        <span class="text-muted">Jangan diubah, keperluan sistem, harap diisi tanpa spasi</span>
    </div>
</div>

<div class="row mb-5">
    <div class="col-lg-6">
        <div class="fv-row">
            <x-app-label class="required">Deskripsi</x-app-label>
            <x-app-textarea name="vardesc" id="vardesc" rows="5"></x-app-textarea>
        </div>

        <div class="mt-5 fv-row">
            <x-app-label>Panduan</x-app-label>
            <x-app-textarea name="guide" id="guide" rows="5"></x-app-textarea>
        </div>


    </div>
    <div class="col-lg-6 fv-row">
        <x-app-label class="required">Nilai</x-app-label>
        <x-app-textarea name="val" id="val" rows="13"></x-app-textarea>
    </div>
</div>
