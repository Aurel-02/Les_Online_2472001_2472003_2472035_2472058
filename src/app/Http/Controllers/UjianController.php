<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserSession;
use App\Models\ExamScore;

class UjianController extends Controller
{
    public function index(Request $request)
    {
        $session      = UserSession::getInstance();
        $user         = $session->getUser();
        $userName     = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $jenjangId    = $user ? $user->id_jenjang : 3;
        $jenjangName  = match ((int)$jenjangId) {
            1 => 'SD', 2 => 'SMP', 3 => 'SMA', default => 'SMA',
        };
        $defaultKelas = match ((int)$jenjangId) {
            1 => 6, 2 => 9, 3 => 12, default => 12,
        };
        $kelas = session('selected_kelas', $defaultKelas);
        $jurusan = session('selected_jurusan', 'ipa');

        // Ambil riwayat dari DB — gunakan getKey() agar primary key berapapun benar
        $histories = $user
            ? ExamScore::where('user_id', $user->getKey())
                       ->orderBy('created_at', 'desc')
                       ->take(20)
                       ->get()
            : collect();

        return view('siswa.ujian', compact(
            'userName', 'photoProfile', 'jenjangId', 'jenjangName', 'kelas', 'jurusan', 'histories'
        ));
    }

    public function pilihMapel(Request $request, $jenis)
    {
        $session      = UserSession::getInstance();
        $user         = $session->getUser();
        $userName     = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        $jenjangId    = $user ? $user->id_jenjang : 3;

        $jenjangName = match ((int)$jenjangId) {
            1 => 'SD', 2 => 'SMP', 3 => 'SMA', default => 'SMA',
        };
        $defaultKelas = match ((int)$jenjangId) { 1 => 6, 2 => 9, 3 => 12, default => 12 };
        $kelas        = session('selected_kelas', $defaultKelas);
        $jurusan      = session('selected_jurusan', 'ipa');

        $mapelList = [];
        if ($jenjangId == 1) {
            $mapelList = [
                ['title' => 'Matematika',       'subtitle' => 'Dasar Berhitung',      'icon' => '📐', 'color' => 'bg-amber'],
                ['title' => 'Bahasa Indonesia',  'subtitle' => 'Membaca & Menulis',   'icon' => '📖', 'color' => 'bg-sage'],
                ['title' => 'IPA Dasar',         'subtitle' => 'Alam Sekitar',         'icon' => '🌿', 'color' => 'bg-mauve'],
            ];
        } elseif ($jenjangId == 2) {
            $mapelList = [
                ['title' => 'Matematika',       'subtitle' => 'Aljabar & Geometri',          'icon' => '📐', 'color' => 'bg-amber'],
                ['title' => 'Bahasa Inggris',   'subtitle' => 'Grammar & Vocabulary',        'icon' => '🔤', 'color' => 'bg-blue'],
                ['title' => 'IPA Terpadu',      'subtitle' => 'Fisika & Biologi Dasar',      'icon' => '🔬', 'color' => 'bg-sage'],
                ['title' => 'IPS Terpadu',      'subtitle' => 'Sejarah & Geografi',          'icon' => '🌍', 'color' => 'bg-mauve'],
            ];
        } else {
            if ($jurusan === 'ips') {
                $mapelList = [
                    ['title' => 'Matematika Wajib',  'subtitle' => 'Aljabar Lanjut',              'icon' => '📐', 'color' => 'bg-amber'],
                    ['title' => 'Ekonomi',           'subtitle' => 'Akuntansi & Makro',           'icon' => '💰', 'color' => 'bg-sage'],
                    ['title' => 'Geografi',          'subtitle' => 'Pemetaan & Bumi',             'icon' => '🗺️', 'color' => 'bg-blue'],
                    ['title' => 'Sosiologi',         'subtitle' => 'Masyarakat & Interaksi',      'icon' => '👥', 'color' => 'bg-mauve'],
                ];
            } else {
                $mapelList = [
                    ['title' => 'Matematika Peminatan','subtitle' => 'Kalkulus & Trigonometri', 'icon' => '📐', 'color' => 'bg-amber'],
                    ['title' => 'Fisika',            'subtitle' => 'Mekanika & Termodinamika',    'icon' => '⚡', 'color' => 'bg-blue'],
                    ['title' => 'Kimia',             'subtitle' => 'Reaksi & Unsur',              'icon' => '🧪', 'color' => 'bg-sage'],
                    ['title' => 'Biologi',           'subtitle' => 'Genetika & Ekosistem',        'icon' => '🧬', 'color' => 'bg-mauve'],
                ];
            }
        }

        return view('siswa.ujian_mapel', compact(
            'userName', 'photoProfile', 'jenis', 'mapelList', 'jenjangName'
        ));
    }

    public function persiapan(Request $request, $jenis, $mapel)
    {
        $session      = UserSession::getInstance();
        $userName     = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        return view('siswa.ujian_persiapan', compact(
            'userName', 'photoProfile', 'jenis', 'mapel'
        ));
    }

    public function soal(Request $request, $jenis, $mapel)
    {
        $session      = UserSession::getInstance();
        $user         = $session->getUser();
        $userName     = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        $jenjangId    = $user ? $user->id_jenjang : 3;

        // Factory Pattern — buat set soal sesuai jenjang
        $soalProvider = \App\Pattern\Ujian\SoalUjianFactory::createSoalUjian($jenjangId);
        $questions    = $soalProvider->getQuestions($jenis, $mapel);

        // Simpan ke session: kunci jawaban + snapshot penuh (dengan explanation)
        $answerKey = [];
        foreach ($questions as $q) {
            $answerKey[$q['id']] = $q['correct'];
        }
        session([
            'exam_answer_key'          => $answerKey,
            'exam_questions_snapshot'  => $questions,   // snapshot penuh termasuk explanation
            'exam_jenis'               => $jenis,
            'exam_mapel'               => $mapel,
        ]);

        // Hapus 'correct' dan 'explanation' dari data view (anti-cheat)
        $questionsForView = array_map(function ($q) {
            unset($q['correct'], $q['explanation']);
            return $q;
        }, $questions);

        return view('siswa.ujian_soal', compact(
            'userName', 'photoProfile', 'jenis', 'mapel', 'questionsForView'
        ));
    }

    public function submit(Request $request)
    {
        $session = UserSession::getInstance();
        $user    = $session->getUser();

        if (!$user) {
            return redirect()->route('login');
        }

        $answerKey         = session('exam_answer_key', []);
        $questionsSnapshot = session('exam_questions_snapshot', []);
        $jenis             = session('exam_jenis', '');
        $mapel             = session('exam_mapel', '');
        $studentAnswers    = $request->input('answers', []);

        // Hitung skor
        $correct = 0;
        $wrong   = 0;
        $total   = count($answerKey);

        foreach ($answerKey as $qid => $rightAnswer) {
            if (!isset($studentAnswers[$qid]) || $studentAnswers[$qid] === '') {
                // tidak dijawab — 0
            } elseif ($studentAnswers[$qid] === $rightAnswer) {
                $correct++;
            } else {
                $wrong++;
            }
        }

        // Penilaian UTBK khusus Try Out: +4 benar, -1 salah, 0 kosong
        $utbkRawScore = null;
        if ($jenis === 'tryout') {
            $utbkRawScore = ($correct * 4) - ($wrong * 1);
            $utbkRawScore = max(0, $utbkRawScore); // tidak boleh negatif
            // Normalisasi ke 0-100 untuk progress bar history
            $maxPossible = $total * 4;
            $score = $maxPossible > 0 ? round(($utbkRawScore / $maxPossible) * 100) : 0;
        } else {
            $score = $total > 0 ? round(($correct / $total) * 100) : 0;
        }

        // Simpan ke exam_scores
        $examScore = ExamScore::create([
            'user_id'            => $user->getKey(),
            'jenis'              => $jenis,
            'mapel'              => $mapel,
            'score'              => $score,
            'correct'            => $correct,
            'total'              => $total,
            'questions_snapshot' => $questionsSnapshot,
            'student_answers'    => $studentAnswers,
            'utbk_raw_score'     => $utbkRawScore,  // null untuk UTS/UAS
        ]);

        $scoreDesc = $jenis === 'tryout'
            ? "Menyelesaikan Try Out UTBK/SNBT dengan skor raw {$utbkRawScore} (nilai {$score})"
            : "Menyelesaikan ujian " . strtoupper($jenis) . " " . $mapel . " dengan nilai " . $score;

        \App\Models\Activity::create([
            'user_id'     => $user->getKey(),
            'type'        => 'ujian',
            'description' => $scoreDesc,
        ]);

        // Hapus session exam
        session()->forget(['exam_answer_key', 'exam_questions_snapshot', 'exam_jenis', 'exam_mapel']);

        // Redirect ke halaman review
        return redirect()->route('siswa.ujian.review', ['id' => $examScore->id]);
    }

    public function review(Request $request, $id)
    {
        $session      = UserSession::getInstance();
        $user         = $session->getUser();
        $userName     = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $examScore = ExamScore::findOrFail($id);

        // Pastikan hanya pemilik yang bisa lihat
        if ($user && $examScore->user_id !== $user->getKey()) {
            abort(403, 'Akses ditolak.');
        }

        return view('siswa.ujian_review', compact(
            'userName', 'photoProfile', 'examScore'
        ));
    }
}
