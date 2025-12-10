<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Tim ICC 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #f0f4f8 100%);
            padding: 40px 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(233, 30, 140, 0.08);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #E91E8C 0%, #D946A6 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.95;
            font-weight: 500;
        }

        .content {
            padding: 40px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        h3 {
            font-size: 18px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #E91E8C;
            display: inline-block;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        select:focus {
            outline: none;
            border-color: #E91E8C;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(233, 30, 140, 0.1);
        }

        .error {
            color: #E91E8C;
            font-size: 12px;
            margin-top: 6px;
            display: block;
            font-weight: 500;
        }

        .note {
            font-size: 13px;
            color: #666;
            margin-bottom: 16px;
            font-style: italic;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 40px;
        }

        button {
            flex: 1;
            background: linear-gradient(135deg, #E91E8C 0%, #D946A6 100%);
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(233, 30, 140, 0.3);
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(233, 30, 140, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        @media (max-width: 600px) {
            .container {
                border-radius: 8px;
            }

            .content {
                padding: 24px;
            }

            .header h1 {
                font-size: 24px;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Registrasi Tim ICC 2026</h1>
            <p>Formulir pendaftaran kompetisi informatika</p>
        </div>

        <div class="content">
            @if (session('success'))
                <div class="alert-success">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @error('npm_duplicate')
                <div class="alert-error">
                    ✕ {{ $message }}
                </div>
            @enderror

            <form id="registrationForm" action="{{ url('/register') }}" method="POST">
                @csrf

                <!-- Step 1 -->
                <div class="step active">
                    <h3>Step 1: Detail Tim</h3>
                    <div class="form-group">
                        <label for="competition_type">Jenis Kompetisi</label>
                        <select id="competition_type" name="competition_type" required>
                            <option value="">-- Pilih Jenis Kompetisi --</option>
                            <option value="Basis Data" {{ old('competition_type') == 'Basis Data' ? 'selected' : '' }}>Basis Data</option>
                            <option value="Pemrograman Terstruktur" {{ old('competition_type') == 'Pemrograman Terstruktur' ? 'selected' : '' }}>Pemrograman Terstruktur</option>
                        </select>
                        @error('competition_type') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="team_name">Nama Tim</label>
                        <input type="text" id="team_name" name="team_name" value="{{ old('team_name') }}" required>
                        @error('team_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="button-group">
                        <button type="button" onclick="nextStep()">Lanjut</button>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="step">
                    <h3>Step 2: Data Ketua Tim</h3>
                    <div class="form-group">
                        <label for="leader_name">Nama Lengkap Ketua</label>
                        <input type="text" id="leader_name" name="leader_name" value="{{ old('leader_name') }}" required>
                        @error('leader_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="leader_npm">NPM Ketua</label>
                        <input type="text" id="leader_npm" name="leader_npm" value="{{ old('leader_npm') }}" required>
                        @error('leader_npm') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="leader_email">Email Ketua</label>
                        <input type="email" id="leader_email" name="leader_email" value="{{ old('leader_email') }}" required>
                        @error('leader_email') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="leader_phone">Nomor Telepon Ketua</label>
                        <input type="text" id="leader_phone" name="leader_phone" value="{{ old('leader_phone') }}" required>
                        @error('leader_phone') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="button-group">
                        <button type="button" onclick="prevStep()">Kembali</button>
                        <button type="button" onclick="nextStep()">Lanjut</button>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="step">
                    <h3>Step 3: Data Anggota Tim 1</h3>
                    <div class="form-group">
                        <label for="member_1_name">Nama Lengkap Anggota 1</label>
                        <input type="text" id="member_1_name" name="member_1_name" value="{{ old('member_1_name') }}" required>
                        @error('member_1_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="member_1_npm">NPM Anggota 1</label>
                        <input type="text" id="member_1_npm" name="member_1_npm" value="{{ old('member_1_npm') }}" required>
                        @error('member_1_npm') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="button-group">
                        <button type="button" onclick="prevStep()">Kembali</button>
                        <button type="button" onclick="nextStep()">Lanjut</button>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="step">
                    <h3>Step 4: Data Anggota Tim 2 (Opsional)</h3>
                    <p class="note">Hanya diisi jika tim Anda terdiri dari 3 orang.</p>
                    <div class="form-group">
                        <label for="member_2_name">Nama Lengkap Anggota 2</label>
                        <input type="text" id="member_2_name" name="member_2_name" value="{{ old('member_2_name') }}">
                        @error('member_2_name') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="member_2_npm">NPM Anggota 2</label>
                        <input type="text" id="member_2_npm" name="member_2_npm" value="{{ old('member_2_npm') }}">
                        @error('member_2_npm') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="button-group">
                        <button type="button" onclick="prevStep()">Kembali</button>
                        <button type="submit">Daftarkan Tim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentStep = 0;
        const steps = document.querySelectorAll('.step');

        function showStep(step) {
            steps.forEach((s, index) => {
                s.classList.toggle('active', index === step);
            });
        }

        function nextStep() {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        }
    </script>
</body>
</html>
