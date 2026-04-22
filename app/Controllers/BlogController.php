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
        $data = [
            'title'     => $this->request->getPost('title'),
            'tag'       => $this->request->getPost('category'),
            'read_time' => $this->request->getPost('read_time') ?: '5 menit',
            'excerpt'   => $this->request->getPost('excerpt'),
            'body'      => $this->request->getPost('body'), // HTML dari TipTap
            'author'    => $this->request->getPost('author'),
            'icon'      => '📄',
            'date'      => date('d M Y')
        ];

        $this->blogModel->insertArticle($data);
        session()->setFlashdata('success', 'Artikel berhasil diterbitkan!');
        
        return redirect()->to('/');
    }
}