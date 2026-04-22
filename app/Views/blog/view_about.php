<?php
$active_page = 'about';
$page_title  = 'Tentang — Artikulo';
include __DIR__ . '/../layout/navbar.php';
?>

<main class="nm-page">
  <div class="fade-in-up mb-14">
    <h1 class="nm-page-title">Tentang Proyek</h1>
    <p class="nm-page-sub">Tugas Pertemuan 4 Pemrograman Web Lanjut.</p>
  </div>

  <div class="nm-card fade-in-up fade-in-up-delay-1" style="line-height: 1.8;">
    <p>Aplikasi ini dibuat untuk mengimplementasikan pola <b>MVC (Model-View-Controller)</b> pada framework CodeIgniter 4.</p>
    <p>Fitur yang disertakan:</p>
    <ul style="padding-left: 20px; margin-bottom: 20px;">
        <li>Sistem routing dan Controller yang terstruktur.</li>
        <li>Model simulasi menggunakan Session.</li>
        <li>Integrasi UI Neumorphic.</li>
        <li>Implementasi TipTap Rich Text Editor (termasuk upload gambar Base64).</li>
    </ul>
  </div>
</main>

<?php include __DIR__ . '/../layout/footer.php'; ?>