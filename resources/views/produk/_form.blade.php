@if (!empty($produk->foto))
    <div class="mb-2">
        <label>Foto Saat Ini</label><br>
        <img src="{{ asset('storage/' . $produk->foto) }}" width="150" class="img-thumbnail">
    </div>
@endif

<div class="row">
    <div class="col">
        <div>
            <label>Gambar</label>
            <input type="file" name="foto" onchange="processAndPreviewImage(this)" accept="image/*"
                class="form-control @error('foto') is-invalid @enderror">

            @error('foto')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col">
        <div class="mb-2">
            <label>Preview Foto</label><br>
            <img id="preview" class="img-thumbnail mt-2" style="display:none" width="150">
            <small id="fileInfo" class="text-muted d-block mt-1"></small>
        </div>
    </div>
</div>

<div>
    <label>Nama Produk</label><br>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $produk->nama ?? '') }}">
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
<div>
   <label>Nama Jenis</label><br>
    <select name="nama_jenis" class="form-select @error('nama_jenis') is-invalid @enderror">
        <option value="">-- Pilih Jenis --</option>
        @foreach ($jenisList as $jenis)
            <option value="{{ $jenis->id }}" @selected(old('nama_jenis', $produk->jenis_id ?? '') == $jenis->id)>
                {{ ucfirst($jenis->nama_jenis) }}
            </option>
        @endforeach
    </select>
        @error('nama_jenis')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
</div>

<div>
    <label>Harga Pokok</label><br>
    <input type="number" name="purchase_price" class="form-control @error('purchase_price') is-invalid @enderror"
        value="{{ old('purchase_price', $produk->harga_beli ?? '') }}">
    @error('purchase_price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div>
    <label>Harga Jual</label><br>
    <input type="number" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror"
        value="{{ old('selling_price', $produk->harga_jual ?? '') }}">
    @error('selling_price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div>
    <label>Stok</label><br>
    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
        value="{{ old('stock', $produk->stok ?? '') }}">
    @error('stock')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<button class="btn btn-success mt-3" type="submit">Simpan</button>
<a href="{{ route('produk.index') }}" class="btn btn-secondary mt-3">Kembali</a>

<script>
    async function processAndPreviewImage(input) {
        const preview = document.getElementById('preview');
        const fileInfo = document.getElementById('fileInfo');
        const originalFile = input.files[0];

        if (!originalFile) return;

        // Tampilkan status sedang memproses
        fileInfo.innerText = "Mengompres gambar...";

        try {
            // 1. Kompresi gambar ke target resolusi max 800px & kualitas 60% (.webp)
            const compressedBlob = await compressImage(originalFile, 800, 0.6);

            // 2. Buat File Object baru dari Blob
            const compressedFileName = originalFile.name.replace(/\.[^/.]+$/, "") + ".webp";
            const compressedFile = new File([compressedBlob], compressedFileName, {
                type: 'image/webp',
                lastModified: Date.now()
            });

            // 3. Timpa file pada input element menggunakan DataTransfer API
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(compressedFile);
            input.files = dataTransfer.files;

            // 4. Update Tampilan Preview & Informasi Ukuran File
            preview.src = URL.createObjectURL(compressedFile);
            preview.style.display = 'block';

            const originalSizeKB = (originalFile.size / 1024).toFixed(1);
            const compressedSizeKB = (compressedFile.size / 1024).toFixed(1);

            fileInfo.innerHTML = ``;
        } catch (error) {
            console.error('Gagal memproses gambar:', error);
            fileInfo.innerText = "Gagal mengompres gambar.";
        }
    }

    // Fungsi Utama Kompresi Gambar (Canvas)
    function compressImage(file, maxWidth = 800, quality = 0.6) {
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

                    // Turunkan skala jika lebar gambar lebih dari maxWidth (misal 800px)
                    if (width > maxWidth) {
                        height = Math.round((height * maxWidth) / width);
                        width = maxWidth;
                    }

                    canvas.width = width;
                    canvas.height = height;

                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);

                    // Convert gambar ke Blob WebP
                    canvas.toBlob((blob) => {
                        if (blob) {
                            resolve(blob);
                        } else {
                            reject(new Error('Canvas to Blob failed'));
                        }
                    }, 'image/webp', quality);
                };
                img.onerror = (err) => reject(err);
            };
            reader.onerror = (err) => reject(err);
        });
    }
</script>