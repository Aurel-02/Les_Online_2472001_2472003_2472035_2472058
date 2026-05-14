<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mengerjakan Ujian - Pintar.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-oak:      #3D2B1F;
            --muted-sage:    #8E9680;
            --dusty-mauve:   #A37C76;
            --warm-amber:    #D9B382;
            --vintage-cream: #E6D8C1;
            --danger-red:    #E76F51;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        body { background: #F7F4F0; color: var(--dark-oak); overflow-x: hidden; height: 100vh; display: flex; flex-direction: column; }

        .topbar {
            background: rgba(230,216,193,.85); backdrop-filter: blur(20px);
            padding: 16px 48px; display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid rgba(255,255,255,.6); position: sticky; top: 0; z-index: 50;
        }
        .brand-info {
            display: flex; align-items: center; gap: 12px;
            text-decoration: none; cursor: pointer; transition: opacity .2s;
        }
        .brand-info:hover { opacity: .75; }
        .logo-text { font-size: 22px; font-weight: 800; color: var(--dark-oak); letter-spacing: -.5px; }

        .exam-info { text-align: center; font-weight: 700; }
        .exam-title-top { font-size: 18px; color: var(--dark-oak); }
        .exam-subtitle { font-size: 13px; color: rgba(61,43,31,.6); }

        .timer {
            display: flex; align-items: center; gap: 8px; background: rgba(255,255,255,.8);
            padding: 8px 16px; border-radius: 99px; font-size: 18px; font-weight: 800; color: var(--danger-red);
            border: 1px solid rgba(231, 111, 81, 0.2);
        }

        .exam-container {
            display: flex; flex: 1; overflow: hidden; padding: 24px 48px; gap: 32px;
        }

        .question-area {
            flex: 1; background: #fff; border-radius: 24px; padding: 40px; overflow-y: auto;
            box-shadow: 0 12px 32px rgba(61,43,31,.04); border: 1px solid rgba(61,43,31,.05);
        }
        .question-header {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;
            padding-bottom: 16px; border-bottom: 1px solid rgba(61,43,31,.1);
        }
        .question-number { font-size: 20px; font-weight: 800; color: var(--dark-oak); }
        .question-text { font-size: 18px; line-height: 1.6; color: var(--dark-oak); margin-bottom: 32px; font-weight: 500; }

        .options-list { display: flex; flex-direction: column; gap: 16px; }
        .option-item {
            display: flex; align-items: center; gap: 16px; padding: 16px 24px; border-radius: 16px;
            border: 2px solid rgba(61,43,31,.1); cursor: pointer; transition: all .2s;
        }
        .option-item:hover { background: rgba(61,43,31,.02); border-color: rgba(61,43,31,.2); }
        .option-item.selected { background: rgba(142,150,128,.1); border-color: var(--muted-sage); }
        .option-letter {
            width: 32px; height: 32px; border-radius: 8px; background: rgba(61,43,31,.1); flex-shrink: 0;
            display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 15px;
        }
        .option-item.selected .option-letter { background: var(--muted-sage); color: #fff; }
        .option-text { font-size: 16px; font-weight: 500; }

        .question-actions { display: flex; justify-content: space-between; margin-top: 48px; }
        .btn-nav {
            padding: 12px 24px; border-radius: 12px; font-weight: 700; font-size: 15px; cursor: pointer; border: none; transition: all .2s;
        }
        .btn-prev { background: rgba(61,43,31,.1); color: var(--dark-oak); }
        .btn-prev:hover { background: rgba(61,43,31,.15); }
        .btn-next { background: var(--dark-oak); color: #fff; }
        .btn-next:hover { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(61,43,31,.15); }

        .nav-sidebar {
            width: 300px; background: #fff; border-radius: 24px; padding: 32px;
            box-shadow: 0 12px 32px rgba(61,43,31,.04); border: 1px solid rgba(61,43,31,.05);
            display: flex; flex-direction: column; overflow-y: auto;
        }
        .nav-title { font-size: 16px; font-weight: 800; color: var(--dark-oak); margin-bottom: 20px; }
        .number-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; margin-bottom: 32px; }
        .number-box {
            aspect-ratio: 1; border-radius: 8px; border: 2px solid rgba(61,43,31,.1);
            display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px;
            cursor: pointer; transition: all .2s; color: rgba(61,43,31,.7);
        }
        .number-box:hover { border-color: rgba(61,43,31,.3); }
        .number-box.answered { background: var(--muted-sage); color: #fff; border-color: var(--muted-sage); }
        .number-box.current { border-color: var(--dark-oak); color: var(--dark-oak); border-width: 3px; }

        .btn-finish {
            margin-top: auto; width: 100%; padding: 16px; border-radius: 16px; font-size: 16px; font-weight: 700;
            background: var(--danger-red); color: #fff; border: none; cursor: pointer; transition: all .2s;
        }
        .btn-finish:hover { background: #d65c40; transform: translateY(-2px); box-shadow: 0 8px 16px rgba(231,111,81,.2); }

        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,.5);
            backdrop-filter: blur(4px); display: none; align-items: center; justify-content: center; z-index: 100;
        }
        .modal-card {
            background: #fff; padding: 40px; border-radius: 24px; text-align: center; max-width: 400px;
            box-shadow: 0 24px 48px rgba(0,0,0,.1); width: 90%;
        }
        .modal-title { font-size: 24px; font-weight: 800; color: var(--dark-oak); margin-bottom: 12px; }
        .modal-desc { font-size: 15px; color: rgba(61,43,31,.7); margin-bottom: 32px; line-height: 1.5; }
        .modal-actions { display: flex; gap: 16px; justify-content: center; }
        .btn-cancel  { padding: 12px 24px; border-radius: 12px; font-weight: 700; background: rgba(61,43,31,.1); border: none; cursor: pointer; font-size: 15px; }
        .btn-confirm { padding: 12px 24px; border-radius: 12px; font-weight: 700; background: var(--danger-red); color: #fff; border: none; cursor: pointer; font-size: 15px; }
    </style>
</head>
<body>

<header class="topbar">
    <a href="{{ route('siswa.home') }}" class="brand-info" title="Kembali ke Dashboard">
        <svg width="28" height="28" viewBox="0 0 24 24">
            <path d="M12 3L14.71 8.5L20.5 9.34L16.31 13.42L17.3 19.2L12 16.4L6.7 19.2L7.69 13.42L3.5 9.34L9.29 8.5L12 3Z"
                  fill="var(--muted-sage)" stroke="var(--muted-sage)" stroke-width="1.5" stroke-linejoin="round"/>
            <circle cx="12" cy="13" r="4" fill="var(--vintage-cream)"/>
        </svg>
        <span class="logo-text">Pintar.id</span>
    </a>
    <div class="exam-info">
        <div class="exam-title-top">{{ strtoupper($jenis) }}</div>
        <div class="exam-subtitle">{{ $mapel }}</div>
    </div>
    <div class="timer">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        <span id="time-display">30:00</span>
    </div>
</header>

@if(session('submit_error'))
<div style="background:#fdecea; border-left:4px solid #E76F51; padding:14px 24px; margin:12px 48px 0; border-radius:12px; font-size:15px; font-weight:600; color:#c0392b;">
    ⚠️ {{ session('submit_error') }}
</div>
@endif

<form id="exam-form" action="{{ route('siswa.ujian.submit') }}" method="POST" style="display:none;">
    @csrf
    <div id="hidden-answers"></div>
</form>

<div class="exam-container">
    <div class="question-area">
        <div class="question-header">
            <div class="question-number">Soal Nomor <span id="current-question-num">1</span>
                dari {{ count($questionsForView) }}</div>
        </div>

        <div id="questions-container">
            @foreach($questionsForView as $index => $q)
            <div class="question-block" id="question-{{ $index }}" style="display: {{ $index === 0 ? 'block' : 'none' }};">
                <div class="question-text">{{ $q['text'] }}</div>
                <div class="options-list">
                    @foreach($q['options'] as $letter => $optionText)
                    <label class="option-item" onclick="selectOption({{ $index }}, '{{ $letter }}', {{ $q['id'] }}, this)">
                        <input type="radio" name="answer_{{ $index }}" value="{{ $letter }}" style="display:none;">
                        <div class="option-letter">{{ $letter }}</div>
                        <div class="option-text">{{ $optionText }}</div>
                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <div class="question-actions">
            <button class="btn-nav btn-prev" onclick="prevQuestion()" id="btnPrev" style="visibility:hidden;">← Sebelumnya</button>
            <button class="btn-nav btn-next" onclick="nextQuestion()" id="btnNext">Selanjutnya →</button>
        </div>
    </div>

    <div class="nav-sidebar">
        <div class="nav-title">Navigasi Soal</div>
        <div class="number-grid">
            @foreach($questionsForView as $index => $q)
            <div class="number-box {{ $index === 0 ? 'current' : '' }}" id="nav-box-{{ $index }}" onclick="goToQuestion({{ $index }})">
                {{ $index + 1 }}
            </div>
            @endforeach
        </div>
        <button class="btn-finish" onclick="showFinishModal()">Akhiri Ujian</button>
    </div>
</div>

<div class="modal-overlay" id="finishModal">
    <div class="modal-card">
        <h3 class="modal-title">Akhiri Ujian?</h3>
        <p class="modal-desc">
            Soal yang <strong>belum dijawab</strong> akan dianggap salah dan bernilai 0.
            Pastikan kamu sudah siap. Ujian tidak bisa dilanjutkan setelah diakhiri.
        </p>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeFinishModal()">Batal</button>
            <button class="btn-confirm" onclick="submitExam()">Ya, Selesai</button>
        </div>
    </div>
</div>

<script>
    let currentIndex  = 0;
    const totalQuestions = {{ count($questionsForView) }};
    const answers = {};

    function selectOption(qIndex, letter, qId, element) {
        element.parentElement.querySelectorAll('.option-item').forEach(el => el.classList.remove('selected'));
        element.classList.add('selected');
        answers[qId] = letter;
        document.getElementById('nav-box-' + qIndex).classList.add('answered');
    }

    function updateUI() {
        document.querySelectorAll('.question-block').forEach(el => el.style.display = 'none');
        document.getElementById('question-' + currentIndex).style.display = 'block';
        document.getElementById('current-question-num').innerText = (currentIndex + 1);
        document.querySelectorAll('.number-box').forEach(el => el.classList.remove('current'));
        document.getElementById('nav-box-' + currentIndex).classList.add('current');
        document.getElementById('btnPrev').style.visibility = currentIndex === 0 ? 'hidden' : 'visible';
        document.getElementById('btnNext').style.display    = currentIndex === totalQuestions - 1 ? 'none' : 'inline-block';
    }

    function prevQuestion() { if (currentIndex > 0) { currentIndex--; updateUI(); } }
    function nextQuestion() { if (currentIndex < totalQuestions - 1) { currentIndex++; updateUI(); } }
    function goToQuestion(i) { currentIndex = i; updateUI(); }

    function showFinishModal() { document.getElementById('finishModal').style.display = 'flex'; }
    function closeFinishModal() { document.getElementById('finishModal').style.display = 'none'; }

    function submitExam() {
        const container = document.getElementById('hidden-answers');
        container.innerHTML = '';
        for (const [qId, letter] of Object.entries(answers)) {
            const inp = document.createElement('input');
            inp.type  = 'hidden';
            inp.name  = `answers[${qId}]`;
            inp.value = letter;
            container.appendChild(inp);
        }
        document.getElementById('exam-form').submit();
    }

    let timeRemaining = 30 * 60;
    const timeDisplay = document.getElementById('time-display');
    const interval = setInterval(() => {
        if (timeRemaining <= 0) { clearInterval(interval); submitExam(); return; }
        timeRemaining--;
        const mins = Math.floor(timeRemaining / 60);
        const secs = timeRemaining % 60;
        timeDisplay.innerText = `${String(mins).padStart(2,'0')}:${String(secs).padStart(2,'0')}`;
        if (timeRemaining <= 300) timeDisplay.style.color = '#c0392b';
    }, 1000);
</script>
</body>
</html>
