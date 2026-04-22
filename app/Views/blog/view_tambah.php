<?php
$active_page = 'add';
$page_title  = 'Tambah Artikel — Artikulo';
$errors      = $errors ?? [];
$categories  = ['Teknologi', 'Desain', 'Bisnis', 'Sains', 'Gaya Hidup', 'Lainnya'];

include __DIR__ . '/../layout/navbar.php';
?>

<main class="nm-page">
  <div class="fade-in-up mb-4">
    <h1 class="nm-page-title">Tulis Artikel Baru</h1>
    <p class="nm-page-sub">Isi semua kolom untuk mempublikasikan artikel.</p>
  </div>

  <form method="POST" action="<?= base_url('blog/store') ?>" id="article-form">
    <div class="nm-card mb-14 fade-in-up fade-in-up-delay-1">

      <div class="form-group">
        <label class="form-label">Judul Artikel *</label>
        <input class="nm-input" type="text" name="title" placeholder="Masukkan judul..." required>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Kategori *</label>
          <select class="nm-select" name="category" required>
            <option value="">Pilih kategori</option>
            <?php foreach ($categories as $cat): ?>
              <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Waktu Baca</label>
          <input class="nm-input" type="text" name="read_time" placeholder="cth: 5 menit">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Kutipan Singkat</label>
        <input class="nm-input" type="text" name="excerpt" placeholder="Ringkasan singkat (opsional)...">
      </div>

      <div class="form-group">
        <label class="form-label">Isi Artikel *</label>
        
        <input type="hidden" name="body" id="body-hidden" required>
        
        <input type="file" id="image-upload" accept="image/*" style="display: none;">

        <div class="nm-inset" style="padding: 0; overflow: hidden; border-radius: var(--nm-radius-sm);">
          
          <div id="editor-toolbar" style="padding: 10px; border-bottom: 1px solid var(--nm-shadow-dark); display: flex; gap: 8px; background: var(--nm-bg); align-items: center; flex-wrap: wrap;">
            <button type="button" id="btn-bold" class="nm-btn nm-btn-sm" title="Bold"><b>B</b></button>
            <button type="button" id="btn-italic" class="nm-btn nm-btn-sm" title="Italic"><i>I</i></button>
            <button type="button" id="btn-h2" class="nm-btn nm-btn-sm" title="Heading 2">H2</button>
            <button type="button" id="btn-h3" class="nm-btn nm-btn-sm" title="Heading 3">H3</button>
            <div style="width: 1px; height: 20px; background: var(--nm-shadow-dark); margin: 0 5px;"></div>
            <button type="button" id="btn-image" class="nm-btn nm-btn-sm nm-btn-accent" title="Sisipkan Gambar">🖼 Tambah Gambar</button>
          </div>

          <div id="tiptap-editor" style="min-height: 250px; padding: 15px; outline: none;"></div>
        </div>
      </div>

      <div class="form-group" style="margin-bottom:0;">
        <label class="form-label">Nama Penulis *</label>
        <input class="nm-input" type="text" name="author" placeholder="Nama lengkap..." required>
      </div>

    </div>

    <div class="d-flex gap-10 fade-in-up fade-in-up-delay-2">
      <a href="<?= base_url('/') ?>" class="nm-btn" style="flex:1; text-align:center;">Batal</a>
      <button type="submit" class="nm-btn nm-btn-accent" style="flex:2;" id="submit-btn">✦ Terbitkan Artikel</button>
    </div>
  </form>
</main>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<style>
/* CSS Tambahan Khusus Editor */
.mb-14 { margin-bottom: 14px; }
.gap-10 { gap: 10px; }

/* Styling area ketik TipTap */
.ProseMirror { min-height: 250px; outline: none; line-height: 1.7; font-size: 14px; color: var(--nm-text); }
.ProseMirror p { margin-top: 0; margin-bottom: 1em; }
.ProseMirror h2, .ProseMirror h3 { margin-top: 1.5em; margin-bottom: 0.5em; color: var(--nm-text); }

/* Styling untuk gambar yang dimasukkan ke dalam editor */
.ProseMirror img {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
  margin: 15px 0;
  box-shadow: var(--nm-raise);
  display: block;
}

.ProseMirror img.ProseMirror-selectednode {
  outline: 3px solid var(--nm-accent);
}

/* State aktif untuk tombol toolbar */
.nm-btn.is-active { background: var(--nm-accent); color: white; }
</style>

<script type="module">
  import { Editor } from 'https://esm.sh/@tiptap/core';
  import StarterKit from 'https://esm.sh/@tiptap/starter-kit';
  import Image from 'https://esm.sh/@tiptap/extension-image';

  // Inisialisasi TipTap
  const editor = new Editor({
    element: document.querySelector('#tiptap-editor'),
    extensions: [
      StarterKit,
      Image.configure({
        inline: true,
        allowBase64: true, // Izinkan format gambar Base64
      }),
    ],
    content: '<p>Tulis artikel kerenmu di sini, klik tombol gambar untuk menyisipkan ilustrasi...</p>',
    onUpdate: ({ editor }) => {
      // Update nilai input hidden tiap kali ada ketikan/perubahan gambar
      document.querySelector('#body-hidden').value = editor.getHTML();
      updateToolbar();
    },
    onSelectionUpdate: () => updateToolbar()
  });

  // Set nilai awal
  document.querySelector('#body-hidden').value = editor.getHTML();

  // Fungsionalitas Tombol Text
  document.querySelector('#btn-bold').addEventListener('click', () => editor.chain().focus().toggleBold().run());
  document.querySelector('#btn-italic').addEventListener('click', () => editor.chain().focus().toggleItalic().run());
  document.querySelector('#btn-h2').addEventListener('click', () => editor.chain().focus().toggleHeading({ level: 2 }).run());
  document.querySelector('#btn-h3').addEventListener('click', () => editor.chain().focus().toggleHeading({ level: 3 }).run());

  function updateToolbar() {
    document.querySelector('#btn-bold').classList.toggle('is-active', editor.isActive('bold'));
    document.querySelector('#btn-italic').classList.toggle('is-active', editor.isActive('italic'));
    document.querySelector('#btn-h2').classList.toggle('is-active', editor.isActive('heading', { level: 2 }));
    document.querySelector('#btn-h3').classList.toggle('is-active', editor.isActive('heading', { level: 3 }));
  }

  // --- LOGIK UPLOAD GAMBAR ---
  const btnImage = document.querySelector('#btn-image');
  const fileInput = document.querySelector('#image-upload');

  // Saat tombol gambar diklik, trigger klik pada input file tersembunyi
  btnImage.addEventListener('click', () => {
    fileInput.click();
  });

  // Saat gambar dipilih dari komputer
  fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        // Masukkan gambar (sebagai base64 string) ke dalam posisi kursor TipTap
        editor.chain().focus().setImage({ src: e.target.result }).run();
      };
      reader.readAsDataURL(file); // Konversi file jadi Base64
    }
    // Reset input agar bisa pilih gambar yang sama lagi jika perlu
    event.target.value = ''; 
  });

  // Validasi form manual
  document.getElementById('article-form').addEventListener('submit', function(e) {
    if (!document.getElementById('body-hidden').value || document.getElementById('body-hidden').value === '<p></p>') {
      e.preventDefault();
      alert('Isi artikel tidak boleh kosong!');
    }
  });
</script>