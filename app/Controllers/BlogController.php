<?php

namespace App\Controllers;

use App\Models\BlogModel;

class BlogController extends BaseController
{
    protected $blogModel;

    public function __construct()
    {
        $this->blogModel = new BlogModel();
        helper('url');
    }

    public function index()
    {
        $articles = $this->blogModel->getAllArticles();
        
        // Mengurutkan artikel dari yang terbaru (opsional tapi bagus)
        usort($articles, fn($a, $b) => $b['id'] <=> $a['id']);

        $data = [
            'articles' => $articles,
            'featured' => $articles[0] ?? null,
            'stats' => [
                'total_articles' => count($articles),
                'total_readers'  => '4.8K',
                'total_authors'  => 12
            ],
            'flash_success' => session()->getFlashdata('success')
        ];
        return view('blog/views_home', $data);
    }

    public function detail($id)
    {
        $article = $this->blogModel->getArticleById($id);
        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('blog/view_detail', ['article' => $article]);
    }

    public function create() 
    { 
        return view('blog/view_tambah'); 
    }

    public function about() 
    { 
        return view('blog/view_about'); 
    }

    public function store()
    {
        $coverName = null;
        $coverFile = $this->request->getFile('cover');
        if ($coverFile && $coverFile->isValid() && !$coverFile->hasMoved()) {
            // Validasi ukuran dan tipe file
            $maxSize = 2 * 1024 * 1024; // 2MB
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if ($coverFile->getSize() <= $maxSize && in_array($coverFile->getMimeType(), $allowedTypes)) {
                // Generate nama unik
                $coverName = uniqid('cover_') . '.' . $coverFile->getExtension();
                $tmpPath = $coverFile->getTempName();
                $targetPath = ROOTPATH . 'public/assets/covers/' . $coverName;

                // Resize otomatis (misal: max width 800px, max height 400px)
                list($origWidth, $origHeight) = getimagesize($tmpPath);
                $maxWidth = 800;
                $maxHeight = 400;
                $ratio = min($maxWidth / $origWidth, $maxHeight / $origHeight, 1);
                $newWidth = (int)($origWidth * $ratio);
                $newHeight = (int)($origHeight * $ratio);

                switch ($coverFile->getMimeType()) {
                    case 'image/jpeg':
                        $srcImg = imagecreatefromjpeg($tmpPath);
                        break;
                    case 'image/png':
                        $srcImg = imagecreatefrompng($tmpPath);
                        break;
                    case 'image/gif':
                        $srcImg = imagecreatefromgif($tmpPath);
                        break;
                    default:
                        $srcImg = null;
                }
                if ($srcImg) {
                    $dstImg = imagecreatetruecolor($newWidth, $newHeight);
                    // PNG transparan
                    if ($coverFile->getMimeType() === 'image/png') {
                        imagealphablending($dstImg, false);
                        imagesavealpha($dstImg, true);
                    }
                    imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
                    switch ($coverFile->getMimeType()) {
                        case 'image/jpeg':
                            imagejpeg($dstImg, $targetPath, 90);
                            break;
                        case 'image/png':
                            imagepng($dstImg, $targetPath, 6);
                            break;
                        case 'image/gif':
                            imagegif($dstImg, $targetPath);
                            break;
                    }
                    imagedestroy($srcImg);
                    imagedestroy($dstImg);
                } else {
                    // Fallback: simpan original jika gagal resize
                    $coverFile->move(ROOTPATH . 'public/assets/covers', $coverName);
                }
            }
        }

        $data = [
            'title'     => $this->request->getPost('title'),
            'tag'       => $this->request->getPost('category'),
            'read_time' => $this->request->getPost('read_time') ?: '5 menit',
            'excerpt'   => $this->request->getPost('excerpt'),
            'body'      => $this->request->getPost('body'), // HTML dari TipTap
            'author'    => $this->request->getPost('author'),
            'icon'      => '📄',
            'date'      => date('d M Y'),
            'cover'     => $coverName
        ];

        $this->blogModel->insertArticle($data);
        session()->setFlashdata('success', 'Artikel berhasil diterbitkan!');
        
        return redirect()->to('/');
    }
}