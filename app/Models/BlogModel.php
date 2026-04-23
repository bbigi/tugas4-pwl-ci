<?php

namespace App\Models;

class BlogModel
{
    private $defaultArticles = [
        [
            'id' => 1,
            'tag' => 'Teknologi',
            'icon' => '🤖',
            'title' => 'Mengenal MVC pada CodeIgniter 4',
            'excerpt' => 'Memahami bagaimana Model, View, dan Controller saling berinteraksi.',
            'author' => 'Anggota Kelompok',
            'date' => '22 Apr 2026',
            'read_time' => '5 menit',
            'body' => '<p>MVC (Model-View-Controller) adalah pola arsitektur yang memisahkan logika bisnis, presentasi, dan alur kontrol.</p>',
            'cover' => null
        ]
    ];

    public function __construct()
    {
        $session = session();
        if (!$session->has('articles')) {
            $session->set('articles', $this->defaultArticles);
        }
    }

    public function getAllArticles() 
    { 
        return session()->get('articles'); 
    }

    public function getArticleById($id)
    {
        $articles = session()->get('articles');
        $article = array_filter($articles, fn($a) => $a['id'] == $id);
        return reset($article);
    }

    public function insertArticle($data)
    {
        $session = session();
        $articles = $session->get('articles');
        
        // Auto-increment ID
        $lastId = end($articles)['id'] ?? 0;
        $data['id'] = $lastId + 1;
        
        $articles[] = $data;
        $session->set('articles', $articles);
    }
}