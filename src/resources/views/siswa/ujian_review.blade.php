<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Ujian - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-oak:      #3D2B1F;
            --muted-sage:    #8E9680;
            --dusty-mauve:   #A37C76;
            --warm-amber:    #D9B382;
            --vintage-cream: #E6D8C1;
            --sidebar-width: 260px;
            --green:  #27ae60;
            --red:    #e74c3c;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background: #F7F4F0; color: var(--dark-oak); display: flex; min-height: 100vh; }

        .sidebar {
            width: var(--sidebar-width); background: rgba(230,216,193,.85);
            backdrop-filter: blur(20px); border-right: 1px solid rgba(255,255,255,.6);
            min-height: 100vh; padding: 32px 24px; display: flex; flex-direction: column;
            position: fixed; left: 0; top: 0; z-index: 50;
        }
        .logo-container { display: flex; align-items: center; gap: 12px; text-decoration: none; margin-bottom: 60px; }
        .logo-text { font-size: 26px; font-weight: 800; color: var(--dark-oak); letter-spacing: -.5px; }
        .sidebar-menu { flex: 1; display: flex; flex-direction: column; gap: 8px; }
        .sidebar-item {
            display: flex; align-items: center; gap: 14px; padding: 14px 18px;
            border-radius: 16px; text-decoration: none; color: rgba(61,43,31,.7);
            font-weight: 600; font-size: 15px; transition: all .3s ease;
        }
        .sidebar-item:hover, .sidebar-item.active { background: rgba(255,255,255,.5); color: var(--dark-oak); }
        .sidebar-item-icon { font-size: 20px; }
        .btn-logout {
            width: 100%; padding: 14px; border-radius: 16px; font-size: 15px; font-weight: 600;
            color: var(--dusty-mauve); background: rgba(163,124,118,.1); border: none;
            cursor: pointer; transition: all .3s ease;
            display: flex; align-items: center; justify-content: center; gap: 10px; margin-top: auto;
        }
        .btn-logout:hover { background: rgba(163,124,118,.2); }

        .main-wrapper { flex: 1; margin-left: var(--sidebar-width); padding: 40px 48px 80px; max-width: calc(960px + var(--sidebar-width)); }

        .score-banner {
            background: linear-gradient(135deg, #4A6741, #6B8F5E); border-radius: 32px;
            padding: 40px 52px; display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 40px; color: #fff; box-shadow: 0 16px 40px rgba(74,103,65,.25);
        }
        .score-banner.low { background: linear-gradient(135deg, #c0392b, #e74c3c); box-shadow: 0 16px 40px rgba(231,76,60,.25); }
        .score-banner.medium { background: linear-gradient(135deg, #d39e00, #f39c12); box-shadow: 0 16px 40px rgba(243,156,18,.25); }
        .score-info h1 { font-size: 28px; font-weight: 800; margin-bottom: 8px; }
        .score-info p { font-size: 16px; opacity: .8; }
        .score-circle {
            width: 100px; height: 100px; border-radius: 50%;
            border: 4px solid rgba(255,255,255,.4); background: rgba(255,255,255,.15);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
        }
        .score-circle .num { font-size: 32px; font-weight: 800; line-height: 1; }
        .score-circle .lbl { font-size: 12px; font-weight: 600; opacity: .8; }

        .btn-back-dashboard {
            display: inline-flex; align-items: center; gap: 8px; text-decoration: none;
            background: rgba(255,255,255,.7); border: 1px solid rgba(255,255,255,.9);
            padding: 12px 20px; border-radius: 12px; font-weight: 700; font-size: 15px;
            color: var(--dark-oak); margin-bottom: 32px; transition: all .2s; backdrop-filter: blur(8px);
        }
        .btn-back-dashboard:hover { background: #fff; transform: translateY(-2px); box-shadow: 0 6px 16px rgba(61,43,31,.08); }

        .review-title { font-size: 22px; font-weight: 800; margin-bottom: 24px; }
        .question-card {
            background: #fff; border-radius: 24px; padding: 32px; margin-bottom: 24px;
            border: 1px solid rgba(61,43,31,.06); box-shadow: 0 8px 24px rgba(61,43,31,.04);
        }
        .question-num { font-size: 13px; font-weight: 700; color: rgba(61,43,31,.5); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
        .question-text { font-size: 17px; font-weight: 600; line-height: 1.6; margin-bottom: 20px; }
        .options-review { display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px; }

        .opt-item {
            display: flex; align-items: center; gap: 14px; padding: 12px 18px; border-radius: 12px;
            border: 2px solid rgba(61,43,31,.1); font-size: 15px; font-weight: 500; transition: all .2s;
        }
        .opt-item.correct-answer {
            border-color: var(--green); background: rgba(39,174,96,.08); color: #1a7a44;
        }
        .opt-item.wrong-chosen {
            border-color: var(--red); background: rgba(231,76,60,.08); color: #c0392b;
        }
        .opt-letter {
            width: 30px; height: 30px; border-radius: 8px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px;
            background: rgba(61,43,31,.08);
        }
        .opt-item.correct-answer .opt-letter { background: var(--green); color: #fff; }
        .opt-item.wrong-chosen .opt-letter { background: var(--red); color: #fff; }
        .opt-tag {
            margin-left: auto; font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 99px;
        }
        .opt-tag.tag-correct { background: rgba(39,174,96,.15); color: #1a7a44; }
        .opt-tag.tag-wrong   { background: rgba(231,76,60,.15); color: #c0392b; }

        .explanation-box {
            background: rgba(142,150,128,.1); border-left: 4px solid var(--muted-sage);
            padding: 16px 20px; border-radius: 0 12px 12px 0; font-size: 14px; line-height: 1.6;
            color: rgba(61,43,31,.8);
        }
        .explanation-box strong { color: var(--dark-oak); font-size: 13px; text-transform: uppercase; letter-spacing: .5px; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <a href="{{ route('siswa.home') }}" class="logo-container">
            <svg width="36" height="36" viewBox="0 0 24 24"><path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z" fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/><circle cx="12" cy="13" r="4" fill="var(--vintage-cream)"/></svg>
            <div class="logo-text">Pintar.id</div>
        </a>
        <div class="sidebar-menu">
            <a href="{{ route('siswa.home') }}" class="sidebar-item">
                <span class="sidebar-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></span>
                Dashboard
            </a>
            <a href="{{ route('siswa.ujian') }}" class="sidebar-item active">
                <span class="sidebar-item-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></span>
                Ujian
            </a>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                Logout
            </button>
        </form>
    </aside>

    <div class="main-wrapper">
        @php
            $isUtbk     = $examScore->jenis === 'tryout';
            $bannerClass = $examScore->score >= 75 ? '' : ($examScore->score >= 50 ? 'medium' : 'low');
            $jenisLabel  = match($examScore->jenis) { 'uts' => 'UTS', 'uas' => 'UAS', 'tryout' => 'Try Out UTBK/SNBT', default => strtoupper($examScore->jenis) };
            $wrong       = $isUtbk ? ($examScore->total - $examScore->correct - (collect($examScore->student_answers ?? [])->count() - $examScore->correct)) : 0;
            // Hitung unanswered untuk UTBK: total - jawaban yang masuk
            $answered    = $isUtbk ? count($examScore->student_answers ?? []) : 0;
            $unanswered  = $isUtbk ? ($examScore->total - $answered) : 0;
            $wrongCount  = $isUtbk ? ($answered - $examScore->correct) : 0;
            $maxRaw      = $examScore->total * 4;
        @endphp

        <div class="score-banner {{ $bannerClass }}">
            <div class="score-info">
                <h1>Review Ujian — {{ $jenisLabel }}</h1>
                @if($isUtbk)
                    <p>
                        {{ $examScore->mapel !== 'Try Out UTBK' ? $examScore->mapel . ' · ' : '' }}
                        Benar: {{ $examScore->correct }} (+{{ $examScore->correct * 4 }} poin) &middot;
                        Salah: {{ $wrongCount }} (−{{ $wrongCount }} poin) &middot;
                        Kosong: {{ $unanswered }} (0 poin)
                    </p>
                @else
                    <p>{{ $examScore->mapel }} &middot; {{ $examScore->correct }} dari {{ $examScore->total }} soal benar &middot; {{ $examScore->created_at->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}</p>
                @endif
            </div>
            <div class="score-circle">
                @if($isUtbk)
                    <span class="num" style="font-size:22px;">{{ $examScore->utbk_raw_score ?? 0 }}</span>
                    <span class="lbl">/ {{ $maxRaw }} PTS</span>
                @else
                    <span class="num">{{ $examScore->score }}</span>
                    <span class="lbl">NILAI</span>
                @endif
            </div>
        </div>

        <a href="{{ route('siswa.ujian') }}" class="btn-back-dashboard">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Kembali ke Riwayat Ujian
        </a>

        <h2 class="review-title">📝 Detail Jawaban</h2>

        @php
            $questions      = is_string($examScore->questions_snapshot) ? json_decode($examScore->questions_snapshot, true) : $examScore->questions_snapshot;
            $studentAnswers = is_string($examScore->student_answers) ? json_decode($examScore->student_answers, true) : $examScore->student_answers;
            
            // Fallback to empty array if decoding fails or still null
            $questions      = $questions ?: [];
            $studentAnswers = $studentAnswers ?: [];
        @endphp

        @foreach($questions as $q)
        @php
            $qid       = $q['id'];
            $chosen    = $studentAnswers[$qid] ?? null;
            $correct   = $q['correct'];
            $isCorrect = $chosen === $correct;
            $isWrong   = $chosen !== null && $chosen !== $correct;
            // Badge poin UTBK per soal
            $pointBadge = '';
            if ($isUtbk) {
                if ($isCorrect)     $pointBadge = '<span style="margin-left:auto;background:rgba(39,174,96,.15);color:#1a7a44;font-size:12px;font-weight:800;padding:3px 10px;border-radius:99px;">+4 poin</span>';
                elseif ($isWrong)   $pointBadge = '<span style="margin-left:auto;background:rgba(231,76,60,.15);color:#c0392b;font-size:12px;font-weight:800;padding:3px 10px;border-radius:99px;">−1 poin</span>';
                else                $pointBadge = '<span style="margin-left:auto;background:rgba(61,43,31,.08);color:rgba(61,43,31,.5);font-size:12px;font-weight:800;padding:3px 10px;border-radius:99px;">0 poin</span>';
            }
        @endphp
        <div class="question-card">
            <div class="question-num">Soal {{ $loop->iteration }} {!! $pointBadge !!}</div>
            <div class="question-text">{{ $q['text'] }}</div>

            <div class="options-review">
                @foreach($q['options'] as $letter => $optText)
                @php
                    $class  = '';
                    $tag    = '';
                    if ($letter === $correct && $letter === $chosen) {
                        $class = 'correct-answer'; $tag = '<span class="opt-tag tag-correct">✓ Jawabanmu</span>';
                    } elseif ($letter === $correct) {
                        $class = 'correct-answer'; $tag = '<span class="opt-tag tag-correct">✓ Jawaban Benar</span>';
                    } elseif ($letter === $chosen) {
                        $class = 'wrong-chosen'; $tag = '<span class="opt-tag tag-wrong">✗ Jawabanmu</span>';
                    }
                @endphp
                <div class="opt-item {{ $class }}">
                    <div class="opt-letter">{{ $letter }}</div>
                    <span>{{ $optText }}</span>
                    {!! $tag !!}
                </div>
                @endforeach
            </div>

            @if(!empty($q['explanation']))
            <div class="explanation-box">
                <strong>💡 Penjelasan</strong><br>
                {{ $q['explanation'] }}
            </div>
            @endif
        </div>
        @endforeach
    </div>
</body>
</html>
