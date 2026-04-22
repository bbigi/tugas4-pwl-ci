<?php

$active_page   = 'home';
$active_filter = $_GET['filter'] ?? 'Semua';
$categories    = ['Semua', 'Teknologi', 'Desain', 'Bisnis', 'Sains'];

/* Filter semua artikel berdasarkan kategori */
$filtered = ($active_filter === 'Semua')
  ? $articles
  : array_filter($articles, fn($a) => $a['tag'] === $active_filter);

include __DIR__ . '/../layout/navbar.php';
?>

<main class="nm-page">

  <!-- ════════════════════════════════════════════
       1. HERO BANNER
  ════════════════════════════════════════════ -->
  <div class="home-hero fade-in-up mb-14">
    <div class="home-hero-decor"></div>
    <div class="home-hero-decor2"></div>
    <div class="home-hero-label">✦ Selamat Datang</div>
    <h1 class="home-hero-title">Temukan Artikel<br>Terbaik Hari Ini</h1>
    <p class="home-hero-sub">
      Kumpulan tulisan pilihan tentang teknologi, desain, bisnis, dan sains
      dari para penulis terpilih.
    </p>
    <a href="<?= base_url('blog/tambah') ?>"
       class="nm-btn nm-btn-accent nm-btn-sm">
      Mulai Membaca →
    </a>
  </div>

  <!-- ════════════════════════════════════════════
       2. STATISTIK
  ════════════════════════════════════════════ -->
  <div class="home-stats fade-in-up fade-in-up-delay-1 mb-14">
    <div class="home-stat nm-inset">
      <div class="home-stat-num"><?= htmlspecialchars($stats['total_articles']) ?></div>
      <div class="home-stat-lbl">Artikel</div>
    </div>
    <div class="home-stat nm-inset">
      <div class="home-stat-num"><?= htmlspecialchars($stats['total_readers']) ?></div>
      <div class="home-stat-lbl">Pembaca</div>
    </div>
    <div class="home-stat nm-inset">
      <div class="home-stat-num"><?= htmlspecialchars($stats['total_authors']) ?></div>
      <div class="home-stat-lbl">Penulis</div>
    </div>
  </div>

  <!-- ════════════════════════════════════════════
       3. FLASH MESSAGE
  ════════════════════════════════════════════ -->
  <?php if (!empty($flash_success)): ?>
    <div class="nm-toast fade-in-up mb-14">
      ✓ <?= htmlspecialchars($flash_success) ?>
    </div>
  <?php endif; ?>

  <!-- ════════════════════════════════════════════
       4. FILTER + DAFTAR ARTIKEL
  ════════════════════════════════════════════ -->
  <div class="fade-in-up fade-in-up-delay-2 mb-14">
    <div class="home-section-header mb-10">
      <span class="home-section-title">📚 Semua Artikel</span>
      <span class="nm-text-muted nm-text-xs"><?= count($filtered) ?> artikel</span>
    </div>

    <!-- Filter Chips -->
    <div class="d-flex gap-8 mb-12" style="flex-wrap:wrap;">
      <?php foreach ($categories as $cat): ?>
        <a href="?filter=<?= urlencode($cat) ?>"
           class="filter-chip <?= $active_filter === $cat ? 'active' : '' ?>">
          <?= htmlspecialchars($cat) ?>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Daftar Artikel -->
    <div style="display:grid; gap:10px;">
      <?php if (empty($filtered)): ?>
        <div class="nm-card" style="text-align:center; color:var(--nm-text-muted); padding:2rem;">
          Tidak ada artikel untuk kategori ini.
        </div>
      <?php else: ?>
        <?php $delay = 1; foreach ($filtered as $a): ?>
          <a href="<?= base_url('blog/detail/' . (int)$a['id']) ?>"
             class="nm-article-card fade-in-up fade-in-up-delay-<?= min($delay++, 4) ?>"
             style="text-decoration:none; display:block;">
            <div class="nm-tag mb-8"><?= htmlspecialchars($a['tag']) ?></div>
            <h2 class="nm-article-title"><?= htmlspecialchars($a['title']) ?></h2>
            <p class="nm-article-excerpt"><?= htmlspecialchars($a['excerpt']) ?></p>
            <div class="nm-article-meta">
              <span><span class="meta-dot"></span><?= htmlspecialchars($a['author']) ?></span>
              <span><?= htmlspecialchars($a['date']) ?> · <?= htmlspecialchars($a['read_time']) ?></span>
            </div>
          </a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <!-- ════════════════════════════════════════════
       5. CTA BANNER — Ajakan menulis
  ════════════════════════════════════════════ -->
  <div class="home-cta fade-in-up fade-in-up-delay-3">
    <div class="home-cta-title">Punya cerita untuk diceritakan?</div>
    <div class="home-cta-sub">
      Mulai tulis artikel pertamamu dan jangkau ribuan pembaca.
    </div>
    <a href="<?= base_url('blog/tambah') ?>"
       class="home-cta-btn">
      ✦ Tulis Sekarang
    </a>
  </div>

</main>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<style>
/* ════════════════════════════════════════════
   Home-scoped styles
   ════════════════════════════════════════════ */

/* ── Hero ──────────────────────────────────── */
.home-hero {
  background: linear-gradient(135deg, #e8eaff 0%, #f0e8ff 60%, #ffe8f5 100%);
  border-radius: var(--nm-radius);
  box-shadow: var(--nm-raise-lg);
  padding: 1.5rem 1.4rem 1.3rem;
  position: relative;
  overflow: hidden;
}

.home-hero-decor {
  position: absolute;
  right: -20px; top: -20px;
  width: 110px; height: 110px;
  border-radius: 50%;
  background: linear-gradient(135deg, #c4c8ff35, #e0c8ff35);
  pointer-events: none;
}

.home-hero-decor2 {
  position: absolute;
  right: 36px; bottom: -26px;
  width: 76px; height: 76px;
  border-radius: 50%;
  background: linear-gradient(135deg, #ffc8e835, #c8d0ff28);
  pointer-events: none;
}

.home-hero-label {
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: var(--nm-accent);
  margin-bottom: 7px;
}

.home-hero-title {
  font-size: 22px;
  font-weight: 700;
  color: var(--nm-text);
  line-height: 1.3;
  margin-bottom: 8px;
}

.home-hero-sub {
  font-size: 12px;
  color: var(--nm-text-muted);
  line-height: 1.65;
  margin-bottom: 14px;
  max-width: 85%;
}

/* ── Stats ─────────────────────────────────── */
.home-stats {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
}

.home-stat {
  text-align: center;
  padding: 12px 6px;
}

.home-stat-num {
  font-size: 20px;
  font-weight: 700;
  color: var(--nm-accent);
}

.home-stat-lbl {
  font-size: 10px;
  color: var(--nm-text-muted);
  margin-top: 3px;
}

/* ── Section headers ───────────────────────── */
.home-section-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.home-section-title {
  font-size: 14px;
  font-weight: 700;
  color: var(--nm-text);
}

.home-see-all {
  font-size: 11px;
  color: var(--nm-accent);
  font-weight: 600;
  text-decoration: none;
}

.home-see-all:hover { text-decoration: underline; }

/* ── Article Cards ──────────────────────── */
.nm-article-card {
  background: var(--nm-bg);
  border-radius: var(--nm-radius);
  box-shadow: var(--nm-raise);
  padding: 0.9rem 1rem;
  cursor: pointer;
  transition: box-shadow 0.18s ease, transform 0.15s ease;
  color: inherit;
}

.nm-article-card:hover {
  box-shadow: var(--nm-raise-lg);
  transform: translateY(-2px);
  text-decoration: none;
  color: inherit;
}

.nm-article-card:active {
  box-shadow: var(--nm-press);
  transform: scale(0.98);
}

.nm-article-title {
  font-size: 13px;
  font-weight: 600;
  color: var(--nm-text);
  margin-bottom: 4px;
  line-height: 1.45;
}

.nm-article-excerpt {
  font-size: 11px;
  color: var(--nm-text-muted);
  line-height: 1.55;
  margin-bottom: 8px;
}

.nm-article-meta {
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 10px;
  color: var(--nm-text-muted);
}

.meta-dot {
  display: inline-block;
  width: 5px; height: 5px;
  border-radius: 50%;
  background: #a78bfa;
  margin-right: 4px;
  vertical-align: middle;
}

/* ── CTA Banner ────────────────────────────── */
.home-cta {
  background: linear-gradient(135deg, #7c8cff, #a78bfa);
  border-radius: var(--nm-radius);
  box-shadow: 4px 4px 16px #b8beff55, -4px -4px 12px #ffffff70;
  padding: 1.4rem;
  text-align: center;
}

.home-cta-title {
  font-size: 15px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 5px;
}

.home-cta-sub {
  font-size: 12px;
  color: rgba(255,255,255,0.8);
  margin-bottom: 12px;
  line-height: 1.6;
}

.home-cta-btn {
  display: inline-block;
  background: #fff;
  border-radius: var(--nm-radius-sm);
  color: var(--nm-accent);
  font-size: 13px;
  font-weight: 700;
  padding: 8px 20px;
  text-decoration: none;
  box-shadow: 2px 2px 8px #7c8cff40;
  transition: box-shadow 0.15s ease, transform 0.1s ease;
}

.home-cta-btn:hover {
  box-shadow: 4px 4px 12px #7c8cff60;
  transform: translateY(-1px);
  text-decoration: none;
  color: var(--nm-accent);
}

/* ── Spacing utilities ─────────────────────── */
.mb-10 { margin-bottom: 10px; }
.mb-12 { margin-bottom: 12px; }
.mb-14 { margin-bottom: 14px; }
</style>