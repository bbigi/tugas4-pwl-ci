<?php
$active_page = 'home';
$page_title  = htmlspecialchars($article['title']) . ' — Artikulo';
include __DIR__ . '/../layout/navbar.php';
?>

<main class="nm-page">
  <div class="fade-in-up mb-16">
    <a href="<?= base_url('/') ?>" class="nm-btn nm-btn-sm">← Kembali</a>
  </div>

  <div class="detail-cover fade-in-up fade-in-up-delay-1">
    <?= $article['icon'] ?? '📄' ?>
  </div>

  <div class="nm-card mb-12 fade-in-up fade-in-up-delay-2">
    <span class="nm-tag mb-8" style="display:inline-block;"><?= htmlspecialchars($article['tag'] ?? 'Umum') ?></span>
    <h1 class="detail-title"><?= htmlspecialchars($article['title']) ?></h1>
    <div class="detail-meta">
      <span>✦ <?= htmlspecialchars($article['author']) ?></span>
      <span><?= htmlspecialchars($article['date']) ?></span>
      <span>⏱ <?= htmlspecialchars($article['read_time']) ?></span>
    </div>
  </div>

  <div class="nm-inset detail-body fade-in-up fade-in-up-delay-3">
    <div class="tiptap-content">
      <?= $article['body'] ?>
    </div>
  </div>
</main>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<style>
.detail-cover { background: linear-gradient(135deg, #e8eaff 0%, #f0e8ff 100%); border-radius: var(--nm-radius); box-shadow: var(--nm-raise); height: 140px; display: flex; align-items: center; justify-content: center; font-size: 48px; margin-bottom: 14px; }
.detail-title { font-size: 20px; font-weight: 700; color: var(--nm-text); margin-bottom: 10px; line-height: 1.35; }
.detail-meta { display: flex; flex-wrap: wrap; gap: 14px; font-size: 12px; color: var(--nm-text-muted); }
.detail-body { margin-bottom: 16px; padding: 20px; }
.tiptap-content { font-size: 14px; line-height: 1.8; color: var(--nm-text); }
.tiptap-content p { margin-bottom: 1.2rem; }
.tiptap-content h2 { font-size: 18px; margin: 1.5rem 0 0.5rem; }
.tiptap-content h3 { font-size: 16px; margin: 1.2rem 0 0.5rem; }
.tiptap-content img { max-width: 100%; height: auto; border-radius: 12px; margin: 20px 0; box-shadow: var(--nm-raise); display: block; }
.tiptap-content b, .tiptap-content strong { font-weight: 700; }
.tiptap-content i, .tiptap-content em { font-style: italic; }
</style>