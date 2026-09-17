<div class="form-group">
  <label class="form-label">Kode Penyakit <span style="color:var(--danger)">*</span></label>
  <input type="text" name="id_penyakit" id="f_id" class="form-control" placeholder="Contoh: PK13" {{ $isEdit ? 'disabled' : '' }} required>
  @error('id_penyakit')<div class="err">{{ $message }}</div>@enderror
</div>
<div class="form-group">
  <label class="form-label">Nama Penyakit <span style="color:var(--danger)">*</span></label>
  <input type="text" name="nama_penyakit" id="f_nama" class="form-control" required>
  @error('nama_penyakit')<div class="err">{{ $message }}</div>@enderror
</div>
<div class="form-group">
  <label class="form-label">Penyebab</label>
  <textarea name="penyebab" id="f_penyebab" class="form-control" rows="2" placeholder="Sebab / faktor pemicu"></textarea>
</div>
<div class="form-group">
  <label class="form-label">Ciri-Ciri / Gejala</label>
  <textarea name="ciri_ciri" id="f_ciri" class="form-control" rows="2" placeholder="Tanda dan gejala"></textarea>
</div>
<div class="form-group">
  <label class="form-label">Pengobatan / Treatment</label>
  <textarea name="treatment" id="f_treatment" class="form-control" rows="2" placeholder="Langkah penanganan"></textarea>
</div>
<div class="form-group">
  <label class="form-label">Obat</label>
  <textarea name="obat" id="f_obat" class="form-control" rows="2" placeholder="Jenis obat yang digunakan"></textarea>
</div>
<div class="form-group">
  <label class="form-label">Gambar Penyakit</label>
  <input type="file" name="gambar" id="f_gambar" class="form-control" accept="image/*" onchange="previewImage(this)">
  <span style="font-size:11px;color:var(--text-sec)">JPG, PNG, WebP, maks 2MB</span>
  @if($isEdit && old('gambar'))<img id="f_gambar_preview" src="" style="display:none;margin-top:8px;width:100px;height:100px;object-fit:cover;border-radius:6px">@endif
  @error('gambar')<div class="err">{{ $message }}</div>@enderror
</div>
