<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        
        {{-- Section Upload & Preview Foto --}}
        <div class="row g-3 mb-4">
            @if (!empty($produk->foto))
                <div class="col-md-4 text-center border-end pe-md-3">
                    <label class="form-label fw-semibold text-secondary">Foto Saat Ini</label>
                    <div class="d-flex justify-content-center align-items-center bg-light rounded p-2 border" style="min-height: 140px;">
                        <img src="{{ asset('storage/' . $produk->foto) }}" class="rounded img-fluid" style="max-height: 130px; object-fit: cover;">
                    </div>
                </div>
            @endif

            <div class="{{ !empty($produk->foto) ? 'col-md-4' : 'col-md-6' }}">
                <label class="form-label fw-semibold">Upload Gambar Produk</label>
                <input type="file" name="foto" onchange="processAndPreviewImage(this)" accept="image/*"
                    class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="{{ !empty($produk->foto) ? 'col-md-4' : 'col-md-6' }}">
                <label class="form-label fw-semibold">Preview Baru</label>
                <div class="p-2 border rounded bg-light text-center" style="min-height: 140px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <img id="preview" class="rounded img-fluid" style="display:none; max-height: 120px; object-fit: cover;">
                    <small id="fileInfo" class="text-muted d-block mt-1"></small>
                </div>
            </div>
        </div>

        <hr class="text-muted opacity-25 my-4">

    {{-- Section Input Data Produk --}}
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Nama Produk</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                placeholder="Masukkan nama produk" value="{{ old('nama', $produk->nama ?? '') }}">
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold">Jenis / Kategori Produk</label>
            <select name="jenis_id" class="form-select @error('jenis_id') is-invalid @enderror">
                <option value="">-- Pilih Jenis --</option>
                @foreach ($jenisList as $jenis)
                    <option value="{{ $jenis->id }}" @selected(old('jenis_id', $produk->jenis_id ?? '') == $jenis->id)>
                        {{ ucfirst($jenis->nama_jenis) }}
                    </option>
                @endforeach
            </select>
            @error('jenis_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Harga Beli Satuan --}}
        <div class="col-md-3">
            <label class="form-label fw-semibold">Harga Pokok Satuan (Beli)</label>
            <div class="input-group">
                <span class="input-group-text bg-light">Rp</span>
                <input type="number" name="harga_beli_satuan" class="form-control @error('harga_beli_satuan') is-invalid @enderror"
                    placeholder="0" value="{{ old('harga_beli_satuan', $produk->harga_beli_satuan ?? '') }}">
            </div>
            @error('harga_beli_satuan')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Harga Beli Pack --}}
        <div class="col-md-3">
            <label class="form-label fw-semibold">Harga Pokok Pack (Beli)</label>
            <div class="input-group">
                <span class="input-group-text bg-light">Rp</span>
                <input type="number" name="harga_beli_pack" class="form-control @error('harga_beli_pack') is-invalid @enderror"
                    placeholder="0" value="{{ old('harga_beli_pack', $produk->harga_beli_pack ?? '') }}">
            </div>
            @error('harga_beli_pack')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- Harga Jual Satuan --}}
        <div class="col-md-3">
            <label class="form-label fw-semibold">Harga Jual Satuan</label>
            <div class="input-group">
                <span class="input-group-text bg-light">Rp</span>
                <input type="number" name="harga_jual_satuan" class="form-control @error('harga_jual_satuan') is-invalid @enderror"
                    placeholder="0" value="{{ old('harga_jual_satuan', $produk->harga_jual_satuan ?? '') }}">
            </div>
            @error('harga_jual_satuan')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

    {{-- Harga Jual Pack --}}
    <div class="col-md-3">
        <label class="form-label fw-semibold">Harga Jual Pack</label>
        <div class="input-group">
            <span class="input-group-text bg-light">Rp</span>
            <input type="number" name="harga_jual_pack" class="form-control @error('harga_jual_pack') is-invalid @enderror"
                placeholder="0" value="{{ old('harga_jual_pack', $produk->harga_jual_pack ?? '') }}">
        </div>
        @error('harga_jual_pack')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    {{-- Stok --}}
    <div class="col-md-12">
        <label class="form-label fw-semibold">Stok Produk</label>
        <input type="number" name="stok" class="form-control @error('stok') is-invalid @enderror"
            placeholder="0" value="{{ old('stok', $produk->stok ?? '') }}">
        @error('stok')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

      {{-- Action Buttons --}}
        <div class="d-flex justify-content-end gap-2 mt-4 pt-2 border-top">
            <a href="{{ route('produk.index') }}" class="btn btn-light border px-4 fw-medium">Kembali</a>
            <button class="btn btn-primary px-4 fw-semibold" type="submit">
                <i class="bi bi-save me-1"></i> Simpan
            </button>
        </div>
</div>

    </div>
</div>

<script>
    async function processAndPreviewImage(input) {
    const preview = document.getElementById('preview');
    const fileInfo = document.getElementById('fileInfo');
    const originalFile = input.files[0];

    if (!originalFile) return;

    fileInfo.innerText = "Mengompres gambar...";

    try {
        // 1. Kompresi gambar dengan output format JPEG
        const compressedBlob = await compressImage(originalFile, 800, 0.7);

        // 2. Buat File Object baru ber-ekstensi .jpg
        const compressedFileName = originalFile.name.replace(/\.[^/.]+$/, "") + ".jpg";
        const compressedFile = new File([compressedBlob], compressedFileName, {
            type: 'image/jpeg',
            lastModified: Date.now()
        });

        // 3. Timpa file pada input element
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(compressedFile);
        input.files = dataTransfer.files;

        // 4. Update Preview
        preview.src = URL.createObjectURL(compressedFile);
        preview.style.display = 'block';

        const originalSizeKB = (originalFile.size / 1024).toFixed(1);
        const compressedSizeKB = (compressedFile.size / 1024).toFixed(1);

        fileInfo.innerHTML = `<span class="text-success fw-medium">${compressedSizeKB} KB</span> <span class="text-muted">(dari ${originalSizeKB} KB)</span>`;
    } catch (error) {
        console.error('Gagal memproses gambar:', error);
        fileInfo.innerText = "Gagal mengompres gambar.";
    }
}

function compressImage(file, maxWidth = 800, quality = 0.7) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = (e) => {
            const img = new Image();
            img.src = e.target.result;
            img.onload = () => {
                const canvas = document.createElement('canvas');
                let width = img.width;
                let height = img.height;

                if (width > maxWidth) {
                    height = Math.round((height * maxWidth) / width);
                    width = maxWidth;
                }

                canvas.width = width;
                canvas.height = height;

                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, width, height);

                // Ubah output canvas menjadi 'image/jpeg'
                canvas.toBlob((blob) => {
                    if (blob) {
                        resolve(blob);
                    } else {
                        reject(new Error('Canvas to Blob failed'));
                    }
                }, 'image/jpeg', quality);
            };
            img.onerror = (err) => reject(err);
        };
        reader.onerror = (err) => reject(err);
    });
}
</script>

