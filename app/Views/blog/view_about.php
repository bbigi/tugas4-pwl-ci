<?php
$active_page = 'about';
$page_title  = 'Tentang — Artikulo';
include __DIR__ . '/../layout/navbar.php';
?>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<main class="nm-page">

  <!-- HEADER -->
  <div class="fade-in-up mb-4">
    <h1 class="nm-page-title">Tentang Proyek</h1>
    <p class="nm-page-sub">Tugas Pertemuan 4 Pemrograman Web Lanjut.</p>
  </div>

  <!-- CARD UTAMA -->
  <div class="nm-card p-4 fade-in-up fade-in-up-delay-1">

    <!-- DESKRIPSI -->
    <p class="text-muted mb-3">
      Aplikasi ini dibuat untuk mengimplementasikan pola 
      <b>MVC (Model-View-Controller)</b> pada framework CodeIgniter 4.
    </p>

    <!-- FITUR -->
    <p class="fw-semibold mb-2">Fitur yang disertakan:</p>

    <ul class="custom-list mb-4">
      <li>Sistem routing dan Controller yang terstruktur.</li>
      <li>Model simulasi menggunakan Session.</li>
      <li>Integrasi UI Neumorphic.</li>
      <li>Implementasi TipTap Rich Text Editor (upload Base64).</li>
    </ul>

    <hr class="my-4">

    <!-- TIM -->
    <h2 class="mb-3">Tim Pengembang</h2>

    <div class="team-grid">

      <div class="team-item">
        <i class="bi bi-person-circle"></i>
        <span>Moh Ramdan Saputra</span>
      </div>

      <div class="team-item">
        <i class="bi bi-person-circle"></i>
        <span>Yusran Rusydi</span>
      </div>

      <div class="team-item">
        <i class="bi bi-person-circle"></i>
        <span>Pawarna</span>
      </div>

      <div class="team-item">
        <i class="bi bi-person-circle"></i>
        <span>Yudis Setiawan</span>
      </div>

    </div>

  </div>

</main>

<!-- STYLE FIX -->
<style>

/* LIST FITUR */
.custom-list {
  list-style: none;
  padding-left: 0;
}

.custom-list li {
  padding: 6px 0;
  position: relative;
  padding-left: 20px;
}

.custom-list li::before {
  content: "•";
  position: absolute;
  left: 0;
  color: #6c8cff;
  font-weight: bold;
}

/* GRID TIM */
.team-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 15px;
}

/* ITEM TIM */
.team-item {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 14px 16px;
  border-radius: 14px;
  background: #e6e9ef;
  box-shadow: 6px 6px 12px #cfd3da, -6px -6px 12px #ffffff;
  transition: 0.3s;
}

.team-item i {
  font-size: 22px;
  color: #6c8cff;
}

/* HOVER EFFECT */
.team-item:hover {
  transform: translateY(-3px);
}

/* RESPONSIVE */
@media (max-width: 768px) {
  .team-grid {
    grid-template-columns: 1fr;
  }
}

</style>

<?php include __DIR__ . '/../layout/footer.php'; ?>