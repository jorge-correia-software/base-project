<?php

namespace Database\Seeders;

use App\Models\Highlight;
use Illuminate\Database\Seeder;

class HighlightSeeder extends Seeder
{
    private $authorAvatars = [
        'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=1920&auto=format&fit=crop', // 0: Female
        'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=1920&auto=format&fit=crop', // 1: Male - David Anderson
        'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=1920&auto=format&fit=crop', // 2: Female - Emma Thompson
        'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=1920&auto=format&fit=crop', // 3: Male
        'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=1920&auto=format&fit=crop', // 4: Female
        'https://images.unsplash.com/photo-1568602471122-7832951cc4c5?q=80&w=1920&auto=format&fit=crop', // 5: Lewis Steen (Male with beard)
    ];

    private $newsImages = [
        'https://images.unsplash.com/photo-1661956602116-aa6865609028?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1434626881859-194d67b2b86f?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1573164574572-cb89e39749b4?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1557804506-669a67965ba0?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1560179707-f14e90ef3623?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1664575602554-2087b04935a5?q=80&w=1920&auto=format&fit=crop',
        'https://images.unsplash.com/photo-1606857521015-7f9fcf423740?q=80&w=1920&auto=format&fit=crop',
    ];

    private function getAvatar($index)
    {
        return $this->authorAvatars[$index % count($this->authorAvatars)];
    }

    private function getImage($index)
    {
        return $this->newsImages[$index % count($this->newsImages)];
    }

    public function run(): void
    {
        $highlights = [
            [
                'title' => 'New Partnership: EC & BRT',
                'description' => 'Edinburgh College has entered into a groundbreaking partnership with Bright Red Triangle (BRT).',
                'date' => '2025-03-16',
                'category' => 'Highlights',
                'image_url' => '/img/news/news_1_image.png',
                'author_name' => 'Lewis Steen',
                'author_avatar' => $this->getAvatar(5),
            ],
            [
                'title' => 'Sustainable Business Workshop Series',
                'description' => 'Join our upcoming workshop series focused on implementing sustainable practices in your business operations.',
                'date' => '2025-03-10',
                'category' => 'Events',
                'image_url' => $this->getImage(1),
                'author_name' => 'David Anderson',
                'author_avatar' => $this->getAvatar(1),
            ],
            [
                'title' => 'Success Story: Claire Williams',
                'description' => 'How Claire launched her business with support from Edinburgh College\'s BASE programme.',
                'date' => '2025-03-05',
                'category' => 'Success Stories',
                'image_url' => '/img/news/news_3_image.png',
                'author_name' => 'Emma Thompson',
                'author_avatar' => $this->getAvatar(2),
            ],
        ];

        foreach ($highlights as $highlight) {
            Highlight::create($highlight);
        }
    }
}
