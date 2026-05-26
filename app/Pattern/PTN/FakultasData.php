<?php

namespace App\Pattern\PTN;

class FakultasData
{
    public static function get(): array
    {
        return [
            "Kedokteran" => [
                "icon" => "⚕️", "gelar" => "S.Ked / dr.", "durasi" => "5.5 - 6 Tahun", "akreditasi" => "Unggul",
                "desc" => "Jurusan Kedokteran mempelajari ilmu tentang kesehatan manusia, diagnosis penyakit, dan penanganan medis. Mahasiswa menjalani pendidikan preklinik dan klinik intensif.",
                "prodi" => [
                    ["n" => "Pendidikan Dokter", "d" => "Menjadi dokter umum profesional", "utbk" => "780-820", "i" => "🩺", "c" => "bg-mauve"],
                    ["n" => "Kedokteran Gigi", "d" => "Spesialisasi kesehatan gigi dan mulut", "utbk" => "720-760", "i" => "🦷", "c" => "bg-blue"],
                    ["n" => "Ilmu Keperawatan", "d" => "Tenaga perawat profesional", "utbk" => "640-680", "i" => "💉", "c" => "bg-sage"],
                    ["n" => "Ilmu Gizi", "d" => "Ahli nutrisi dan dietetika", "utbk" => "620-660", "i" => "🍎", "c" => "bg-green"]
                ],
                "prospek" => ["Dokter Umum", "Dokter Spesialis", "Peneliti Medis", "Dosen Kedokteran", "Konsultan Kesehatan", "Tenaga Medis RS"]
            ],
            "Teknik" => [
                "icon" => "⚙️", "gelar" => "S.T.", "durasi" => "4 Tahun", "akreditasi" => "Unggul",
                "desc" => "Fakultas Teknik mempelajari penerapan ilmu sains dan matematika untuk merancang, membangun, dan mengoptimalkan sistem, struktur, dan proses industri.",
                "prodi" => [
                    ["n" => "Teknik Informatika", "d" => "Pengembangan software, AI, dan data", "utbk" => "720-790", "i" => "💻", "c" => "bg-blue"],
                    ["n" => "Teknik Sipil", "d" => "Konstruksi dan infrastruktur", "utbk" => "640-710", "i" => "🏗️", "c" => "bg-amber"],
                    ["n" => "Teknik Mesin", "d" => "Desain mesin dan manufaktur", "utbk" => "640-700", "i" => "⚙️", "c" => "bg-sage"],
                    ["n" => "Teknik Elektro", "d" => "Sistem kelistrikan dan elektronika", "utbk" => "650-720", "i" => "⚡", "c" => "bg-mauve"],
                    ["n" => "Teknik Kimia", "d" => "Proses kimia industri", "utbk" => "640-700", "i" => "🧪", "c" => "bg-green"]
                ],
                "prospek" => ["Software Engineer", "Data Scientist", "Insinyur Sipil", "Insinyur Mesin", "Project Manager", "Konsultan IT"]
            ],
            "Hukum" => [
                "icon" => "⚖️", "gelar" => "S.H.", "durasi" => "4 Tahun", "akreditasi" => "Unggul",
                "desc" => "Jurusan Hukum mempelajari sistem hukum, peraturan perundang-undangan, dan keadilan. Mencakup hukum pidana, perdata, tata negara, dan hukum internasional.",
                "prodi" => [
                    ["n" => "Ilmu Hukum", "d" => "Hukum pidana, perdata, dan tata negara", "utbk" => "620-720", "i" => "⚖️", "c" => "bg-amber"],
                    ["n" => "Hukum Bisnis", "d" => "Regulasi dan kontrak bisnis", "utbk" => "630-700", "i" => "💼", "c" => "bg-blue"],
                    ["n" => "Hukum Internasional", "d" => "Hukum antar negara dan diplomasi", "utbk" => "640-700", "i" => "🌍", "c" => "bg-sage"]
                ],
                "prospek" => ["Advokat", "Jaksa", "Hakim", "Notaris", "Legal Counsel", "Diplomat"]
            ],
            "Ekonomi & Bisnis" => [
                "icon" => "💰", "gelar" => "S.E.", "durasi" => "4 Tahun", "akreditasi" => "Unggul",
                "desc" => "Fakultas Ekonomi dan Bisnis mempelajari teori ekonomi, manajemen bisnis, akuntansi, dan keuangan. Mempersiapkan mahasiswa untuk berkarir di dunia bisnis global.",
                "prodi" => [
                    ["n" => "Manajemen", "d" => "Pengelolaan organisasi dan strategi bisnis", "utbk" => "640-730", "i" => "📊", "c" => "bg-amber"],
                    ["n" => "Akuntansi", "d" => "Pencatatan dan audit keuangan", "utbk" => "640-720", "i" => "📒", "c" => "bg-sage"],
                    ["n" => "Ilmu Ekonomi", "d" => "Analisis ekonomi makro dan mikro", "utbk" => "630-710", "i" => "💹", "c" => "bg-blue"],
                    ["n" => "Bisnis Digital", "d" => "E-commerce dan manajemen startup", "utbk" => "620-680", "i" => "📱", "c" => "bg-mauve"]
                ],
                "prospek" => ["Akuntan", "Financial Analyst", "Manajer", "Entrepreneur", "Konsultan Bisnis", "Banker"]
            ],
            "MIPA" => [
                "icon" => "🔬", "gelar" => "S.Si.", "durasi" => "4 Tahun", "akreditasi" => "Unggul",
                "desc" => "Fakultas MIPA mempelajari ilmu dasar: Matematika, Fisika, Kimia, dan Biologi. Menjadi fondasi perkembangan teknologi dan riset ilmiah masa depan.",
                "prodi" => [
                    ["n" => "Matematika", "d" => "Aljabar, analisis, dan matematika terapan", "utbk" => "640-720", "i" => "📐", "c" => "bg-blue"],
                    ["n" => "Fisika", "d" => "Hukum alam dan fenomena fisik", "utbk" => "640-710", "i" => "🌌", "c" => "bg-mauve"],
                    ["n" => "Kimia", "d" => "Reaksi kimia dan material", "utbk" => "630-700", "i" => "🧪", "c" => "bg-amber"],
                    ["n" => "Biologi", "d" => "Makhluk hidup dan ekosistem", "utbk" => "620-690", "i" => "🧬", "c" => "bg-green"]
                ],
                "prospek" => ["Peneliti", "Data Analyst", "Dosen", "Ahli Forensik", "Quality Control", "Lab Analyst"]
            ],
            "FISIP" => [
                "icon" => "🏛️", "gelar" => "S.Sos. / S.IP.", "durasi" => "4 Tahun", "akreditasi" => "Unggul",
                "desc" => "Fakultas Ilmu Sosial dan Ilmu Politik mempelajari dinamika masyarakat, kebijakan publik, komunikasi, dan hubungan internasional.",
                "prodi" => [
                    ["n" => "Ilmu Komunikasi", "d" => "Media, jurnalistik, dan PR", "utbk" => "600-680", "i" => "📢", "c" => "bg-amber"],
                    ["n" => "Hubungan Internasional", "d" => "Diplomasi dan politik global", "utbk" => "620-700", "i" => "🌍", "c" => "bg-blue"],
                    ["n" => "Ilmu Politik", "d" => "Sistem politik dan pemerintahan", "utbk" => "600-670", "i" => "🏛️", "c" => "bg-mauve"],
                    ["n" => "Sosiologi", "d" => "Struktur dan dinamika masyarakat", "utbk" => "580-650", "i" => "👥", "c" => "bg-sage"]
                ],
                "prospek" => ["Jurnalis", "Diplomat", "PNS", "Public Relations", "Analis Politik", "Peneliti Sosial"]
            ],
            "Ilmu Komputer" => [
                "icon" => "💻", "gelar" => "S.Kom.", "durasi" => "4 Tahun", "akreditasi" => "Unggul",
                "desc" => "Jurusan Ilmu Komputer fokus pada teori komputasi, pemrograman, kecerdasan buatan, dan sistem informasi. Salah satu jurusan paling diminati di era digital.",
                "prodi" => [
                    ["n" => "Ilmu Komputer", "d" => "Algoritma, AI, dan machine learning", "utbk" => "680-760", "i" => "🤖", "c" => "bg-blue"],
                    ["n" => "Sistem Informasi", "d" => "Manajemen data dan sistem enterprise", "utbk" => "640-720", "i" => "🖥️", "c" => "bg-amber"],
                    ["n" => "Teknik Komputer", "d" => "Hardware dan embedded systems", "utbk" => "650-720", "i" => "📓", "c" => "bg-sage"]
                ],
                "prospek" => ["Software Engineer", "Data Scientist", "UI/UX Designer", "DevOps Engineer", "AI Researcher", "CTO Startup"]
            ],
            "Pertanian" => [
                "icon" => "🌾", "gelar" => "S.P.", "durasi" => "4 Tahun", "akreditasi" => "Unggul",
                "desc" => "Fakultas Pertanian mempelajari budidaya tanaman, ilmu tanah, agribisnis, dan teknologi pertanian modern untuk ketahanan pangan nasional.",
                "prodi" => [
                    ["n" => "Agroteknologi", "d" => "Budidaya dan teknologi tanaman", "utbk" => "560-630", "i" => "🌱", "c" => "bg-green"],
                    ["n" => "Agribisnis", "d" => "Bisnis dan manajemen pertanian", "utbk" => "560-630", "i" => "📈", "c" => "bg-amber"],
                    ["n" => "Ilmu Tanah", "d" => "Kesuburan dan konservasi tanah", "utbk" => "540-610", "i" => "🌍", "c" => "bg-sage"]
                ],
                "prospek" => ["Agronomis", "Konsultan Pertanian", "Peneliti", "Manajer Perkebunan", "Wirausaha Agritech"]
            ],
            "Farmasi" => [
                "icon" => "💊", "gelar" => "S.Farm.", "durasi" => "4 Tahun", "akreditasi" => "Unggul",
                "desc" => "Jurusan Farmasi mempelajari ilmu obat-obatan, formulasi sediaan farmasi, farmakologi, dan pelayanan kefarmasian kepada masyarakat.",
                "prodi" => [
                    ["n" => "Farmasi", "d" => "Formulasi obat dan farmakologi", "utbk" => "660-740", "i" => "💊", "c" => "bg-pink"],
                    ["n" => "Farmasi Klinis", "d" => "Pelayanan farmasi di rumah sakit", "utbk" => "650-720", "i" => "🏥", "c" => "bg-mauve"]
                ],
                "prospek" => ["Apoteker", "Peneliti Farmasi", "Quality Assurance", "Medical Representative", "Industri Kosmetik"]
            ],
            "Ekonomika & Bisnis" => [
                "icon" => "💰", "gelar" => "S.E.", "durasi" => "4 Tahun", "akreditasi" => "Unggul",
                "desc" => "Mempelajari teori ekonomi, manajemen bisnis, dan akuntansi dengan pendekatan riset yang kuat.",
                "prodi" => [
                    ["n" => "Manajemen", "d" => "Pengelolaan organisasi dan strategi", "utbk" => "640-730", "i" => "📊", "c" => "bg-amber"],
                    ["n" => "Akuntansi", "d" => "Pencatatan dan audit keuangan", "utbk" => "640-720", "i" => "📒", "c" => "bg-sage"],
                    ["n" => "Ilmu Ekonomi", "d" => "Analisis ekonomi makro dan mikro", "utbk" => "630-710", "i" => "💹", "c" => "bg-blue"]
                ],
                "prospek" => ["Akuntan", "Financial Analyst", "Manajer", "Konsultan Bisnis"]
            ],
            "Sekolah Teknik Elektro & Informatika" => [
                "icon" => "💻", "gelar" => "S.T.", "durasi" => "4 Tahun", "akreditasi" => "Unggul",
                "desc" => "Program teknik paling kompetitif di ITB, menggabungkan ilmu informatika, elektronika, dan sistem informasi kelas dunia.",
                "prodi" => [
                    ["n" => "Teknik Informatika", "d" => "Algoritma, AI, dan software engineering", "utbk" => "750-790", "i" => "💻", "c" => "bg-blue"],
                    ["n" => "Sistem & Teknologi Informasi", "d" => "Enterprise systems dan manajemen data", "utbk" => "720-760", "i" => "🖥️", "c" => "bg-sage"],
                    ["n" => "Teknik Elektro", "d" => "Sistem tenaga dan elektronika", "utbk" => "700-750", "i" => "⚡", "c" => "bg-amber"]
                ],
                "prospek" => ["Software Engineer", "AI Researcher", "System Analyst", "CTO", "IoT Engineer"]
            ],
            "Teknologi Kelautan" => [
                "icon" => "🚢", "gelar" => "S.T.", "durasi" => "4 Tahun", "akreditasi" => "Unggul",
                "desc" => "Mempelajari rekayasa kapal laut, sistem transportasi laut, dan teknologi kelautan.",
                "prodi" => [
                    ["n" => "Teknik Perkapalan", "d" => "Desain dan konstruksi kapal", "utbk" => "630-680", "i" => "🚢", "c" => "bg-blue"],
                    ["n" => "Teknik Kelautan", "d" => "Struktur offshore dan pelabuhan", "utbk" => "620-670", "i" => "🌊", "c" => "bg-sage"]
                ],
                "prospek" => ["Naval Architect", "Marine Engineer", "Manajer Pelabuhan", "Konsultan Maritim"]
            ],
            "Desain Kreatif & Digital" => [
                "icon" => "🎨", "gelar" => "S.Ds.", "durasi" => "4 Tahun", "akreditasi" => "A",
                "desc" => "Menggabungkan kreativitas dan teknologi digital untuk menghasilkan desainer kelas dunia.",
                "prodi" => [
                    ["n" => "Desain Produk", "d" => "Desain industri dan inovasi produk", "utbk" => "600-660", "i" => "📱", "c" => "bg-amber"],
                    ["n" => "Desain Interior", "d" => "Perancangan ruang dan estetika", "utbk" => "580-640", "i" => "🏠", "c" => "bg-sage"],
                    ["n" => "Desain Komunikasi Visual", "d" => "Branding, ilustrasi, dan tipografi", "utbk" => "590-650", "i" => "🎨", "c" => "bg-blue"]
                ],
                "prospek" => ["UI/UX Designer", "Product Designer", "Creative Director", "Brand Consultant"]
            ],
            "Seni Rupa & Desain" => [
                "icon" => "🎨", "gelar" => "S.Ds.", "durasi" => "4 Tahun", "akreditasi" => "Unggul",
                "desc" => "Program seni dan desain bergengsi di ITB yang menghasilkan seniman dan desainer kelas dunia.",
                "prodi" => [
                    ["n" => "Desain Produk", "d" => "Desain industri dan inovasi", "utbk" => "630-680", "i" => "📱", "c" => "bg-amber"],
                    ["n" => "Desain Komunikasi Visual", "d" => "Branding dan ilustrasi", "utbk" => "620-670", "i" => "🎨", "c" => "bg-blue"],
                    ["n" => "Kriya", "d" => "Seni tradisi dan kontemporer", "utbk" => "590-640", "i" => "🧵", "c" => "bg-sage"]
                ],
                "prospek" => ["UI/UX Designer", "Creative Director", "Brand Consultant", "Seniman"]
            ],
            "Semua Fakultas" => [
                "icon" => "🏫", "gelar" => "S1", "durasi" => "4 Tahun", "akreditasi" => "Baik Sekali",
                "desc" => "Informasi spesifik tentang fakultas ini belum dilengkapi. PTN menawarkan program studi berkualitas di berbagai disiplin ilmu.",
                "prodi" => [
                    ["n" => "Program Studi Pilihan", "d" => "Pendidikan dan pengembangan karir sesuai minat", "utbk" => "550-650", "i" => "🎓", "c" => "bg-sage"]
                ],
                "prospek" => ["Profesional", "Peneliti", "Pegawai Negeri Sipil", "Wirausahawan"]
            ],
            "Keguruan & Ilmu Pendidikan" => [
                "icon" => "📚", "gelar" => "S.Pd.", "durasi" => "4 Tahun", "akreditasi" => "Unggul",
                "desc" => "Fakultas Keguruan dan Ilmu Pendidikan mencetak tenaga pendidik profesional yang kompeten, inovatif, dan berdedikasi untuk memajukan pendidikan Indonesia.",
                "prodi" => [
                    ["n" => "Pendidikan Matematika", "d" => "Guru matematika sekolah menengah", "utbk" => "580-660", "i" => "📐", "c" => "bg-blue"],
                    ["n" => "Pendidikan Bahasa Indonesia", "d" => "Guru bahasa dan sastra Indonesia", "utbk" => "560-640", "i" => "📖", "c" => "bg-amber"],
                    ["n" => "Pendidikan Biologi", "d" => "Guru biologi dan ilmu alam", "utbk" => "560-630", "i" => "🧬", "c" => "bg-green"],
                    ["n" => "Pendidikan Bahasa Inggris", "d" => "Guru bahasa Inggris profesional", "utbk" => "570-650", "i" => "🌐", "c" => "bg-sage"],
                    ["n" => "Bimbingan dan Konseling", "d" => "Konselor pendidikan dan psikologi sekolah", "utbk" => "540-610", "i" => "🤝", "c" => "bg-mauve"]
                ],
                "prospek" => ["Guru Profesional", "Kepala Sekolah", "Dosen", "Trainer Pendidikan", "Konselor", "Pengembang Kurikulum"]
            ],
            "Ilmu Keolahragaan" => [
                "icon" => "⚽", "gelar" => "S.Or.", "durasi" => "4 Tahun", "akreditasi" => "Unggul",
                "desc" => "Mempelajari ilmu olahraga, kesehatan fisik, kepelatihan, dan manajemen olahraga untuk mencetak tenaga profesional di bidang olahraga Indonesia.",
                "prodi" => [
                    ["n" => "Pendidikan Jasmani", "d" => "Guru olahraga sekolah dan kampus", "utbk" => "550-620", "i" => "⚽", "c" => "bg-green"],
                    ["n" => "Kepelatihan Olahraga", "d" => "Pelatih atlet profesional", "utbk" => "540-610", "i" => "🏆", "c" => "bg-amber"],
                    ["n" => "Ilmu Keolahragaan", "d" => "Sains olahraga dan kesehatan", "utbk" => "540-600", "i" => "💪", "c" => "bg-blue"]
                ],
                "prospek" => ["Guru Olahraga", "Pelatih Atlet", "Manajer Olahraga", "Fisioterapis", "Instruktur Kebugaran"]
            ],
            "Kehutanan" => [
                "icon" => "🌲", "gelar" => "S.Hut.", "durasi" => "4 Tahun", "akreditasi" => "A",
                "desc" => "Mempelajari pengelolaan hutan tropis, konservasi sumber daya alam, dan pemanfaatan hasil hutan secara berkelanjutan untuk menjaga ekosistem Indonesia.",
                "prodi" => [
                    ["n" => "Kehutanan", "d" => "Pengelolaan hutan dan konservasi alam", "utbk" => "530-590", "i" => "🌲", "c" => "bg-green"],
                    ["n" => "Manajemen Hutan", "d" => "Bisnis dan pengelolaan kawasan hutan", "utbk" => "520-580", "i" => "🌿", "c" => "bg-sage"]
                ],
                "prospek" => ["Manajer Kehutanan", "Peneliti Konservasi", "Konsultan Lingkungan", "PNS Kementerian LHK", "Wirausaha Agroforestri"]
            ],
            "Pariwisata" => [
                "icon" => "✈️", "gelar" => "S.Par.", "durasi" => "4 Tahun", "akreditasi" => "A",
                "desc" => "Mempelajari industri pariwisata, perhotelan, dan manajemen destinasi wisata. Sangat relevan bagi Indonesia sebagai salah satu destinasi wisata terbesar dunia.",
                "prodi" => [
                    ["n" => "Industri Perjalanan", "d" => "Manajemen agen perjalanan dan tour", "utbk" => "560-620", "i" => "✈️", "c" => "bg-blue"],
                    ["n" => "Perhotelan", "d" => "Manajemen hotel dan hospitality", "utbk" => "550-610", "i" => "🏨", "c" => "bg-amber"],
                    ["n" => "Destinasi Pariwisata", "d" => "Pengembangan kawasan wisata", "utbk" => "540-600", "i" => "🗺️", "c" => "bg-sage"]
                ],
                "prospek" => ["Manajer Hotel", "Tour Guide Profesional", "Event Organizer", "Konsultan Pariwisata", "Pengembang Destinasi"]
            ]
        ];
    }
}
