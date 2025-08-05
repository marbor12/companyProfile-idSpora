<?php

namespace Database\Seeders;

use App\Models\KatalogPelatihan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KatalogPelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelatihans = [
            // Pelatihan Berbayar
            [
                'nama_pelatihan' => 'Laravel Web Development',
                'deskripsi' => 'Belajar membuat aplikasi web modern menggunakan framework Laravel',
                'tipe_pelatihan' => 'berbayar',
                'kategori_materi' => 'IT & Programming',
                'harga' => 1500000,
                'instructor' => 'John Doe',
                'tanggal_pelatihan' => '2025-09-15',
                'materi' => 'MVC Pattern, Eloquent ORM, Authentication, API Development, Testing',
                'is_active' => true,
            ],
            [
                'nama_pelatihan' => 'Digital Marketing Strategy',
                'deskripsi' => 'Strategi pemasaran digital yang efektif untuk bisnis modern',
                'tipe_pelatihan' => 'berbayar',
                'kategori_materi' => 'Digital Marketing',
                'harga' => 800000,
                'instructor' => 'Jane Smith',
                'tanggal_pelatihan' => '2025-09-20',
                'materi' => 'SEO, Social Media Marketing, Content Marketing, Google Ads',
                'is_active' => true,
            ],
            [
                'nama_pelatihan' => 'Advanced PHP Programming',
                'deskripsi' => 'Teknik programming PHP lanjutan untuk developer berpengalaman',
                'tipe_pelatihan' => 'berbayar',
                'kategori_materi' => 'IT & Programming',
                'harga' => 2000000,
                'instructor' => 'Sarah Wilson',
                'tanggal_pelatihan' => '2025-10-01',
                'materi' => 'OOP Advanced, Design Patterns, Performance Optimization, Security',
                'is_active' => true,
            ],
            
            // Pelatihan Free
            [
                'nama_pelatihan' => 'Introduction to Web Development',
                'deskripsi' => 'Pengenalan dasar web development untuk pemula',
                'tipe_pelatihan' => 'free',
                'kategori_materi' => 'IT & Programming',
                'harga' => null,
                'instructor' => 'Mike Johnson',
                'tanggal_pelatihan' => '2025-08-25',
                'materi' => 'HTML, CSS, JavaScript Basics, Git Version Control',
                'is_active' => true,
            ],
            [
                'nama_pelatihan' => 'Basic Digital Literacy',
                'deskripsi' => 'Literasi digital dasar untuk era modern',
                'tipe_pelatihan' => 'free',
                'kategori_materi' => 'Digital Literacy',
                'harga' => null,
                'instructor' => 'Lisa Brown',
                'tanggal_pelatihan' => '2025-09-05',
                'materi' => 'Computer Basics, Internet Safety, Online Tools, Cloud Storage',
                'is_active' => true,
            ],
            
            // Pelatihan Khusus (Custom untuk client)
            [
                'nama_pelatihan' => 'Custom ERP Training untuk PT. ABC',
                'deskripsi' => 'Pelatihan khusus sistem ERP sesuai kebutuhan PT. ABC',
                'tipe_pelatihan' => 'khusus',
                'kategori_materi' => 'Enterprise Systems',
                'harga' => 5000000,
                'instructor' => 'David Wilson',
                'tanggal_pelatihan' => '2025-10-15',
                'materi' => 'ERP Module Training, Custom Workflow, Data Migration, User Management',
                'is_active' => true,
            ],
            [
                'nama_pelatihan' => 'Corporate Social Media Management',
                'deskripsi' => 'Pelatihan manajemen media sosial khusus untuk perusahaan tertentu',
                'tipe_pelatihan' => 'khusus',
                'kategori_materi' => 'Digital Marketing',
                'harga' => 3000000,
                'instructor' => 'Emma Davis',
                'tanggal_pelatihan' => '2025-11-01',
                'materi' => 'Brand Guidelines, Content Strategy, Crisis Management, Analytics',
                'is_active' => true,
            ],
        ];

        foreach ($pelatihans as $pelatihan) {
            KatalogPelatihan::create($pelatihan);
        }
    }
}
