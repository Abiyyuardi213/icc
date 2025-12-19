@extends('layouts.main')

@section('title', 'Registrasi Tim - ICC 2026')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24 pb-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <!-- Back Button -->
        <a href="{{ url('/list-event') }}" class="inline-flex items-center text-gray-500 hover:text-[#EC46A4] font-medium mb-6 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar Event
        </a>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row min-h-[600px]">
            <!-- Sidebar / Progress -->
            <div class="bg-[#EC46A4] md:w-1/3 p-8 text-white flex flex-col justify-between relative overflow-hidden">
                <!-- Decorative Circles -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-32 h-32 rounded-full bg-white opacity-10"></div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-32 h-32 rounded-full bg-white opacity-10"></div>

                <div>
                    <h2 class="text-2xl font-bold mb-2">Registrasi Tim</h2>
                    <p class="text-pink-100 text-sm mb-8">Lengkapi data tim Anda untuk mengikuti kompetisi.</p>

                    <!-- Steps Component -->
                    <div class="space-y-6 relative">
                        <!-- Connecting Line -->
                        <div class="absolute left-[15px] top-2 bottom-2 w-0.5 bg-pink-400 -z-0"></div>

                        <!-- Step 1 -->
                        <div class="relative z-10 flex items-center gap-4 step-indicator active" data-step="1">
                            <div class="w-8 h-8 rounded-full border-2 border-white bg-white text-[#EC46A4] flex items-center justify-center font-bold text-sm transition-all duration-300">1</div>
                            <div>
                                <h4 class="font-bold text-sm">Informasi Tim</h4>
                                <p class="text-xs text-pink-200">Nama & Kategori</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="relative z-10 flex items-center gap-4 step-indicator opacity-60" data-step="2">
                            <div class="w-8 h-8 rounded-full border-2 border-white flex items-center justify-center font-bold text-sm transition-all duration-300">2</div>
                            <div>
                                <h4 class="font-bold text-sm">Data Ketua</h4>
                                <p class="text-xs text-pink-200">Identitas Ketua Tim</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative z-10 flex items-center gap-4 step-indicator opacity-60" data-step="3">
                            <div class="w-8 h-8 rounded-full border-2 border-white flex items-center justify-center font-bold text-sm transition-all duration-300">3</div>
                            <div>
                                <h4 class="font-bold text-sm">Anggota Tim</h4>
                                <p class="text-xs text-pink-200">Identitas Anggota</p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="relative z-10 flex items-center gap-4 step-indicator opacity-60" data-step="4">
                            <div class="w-8 h-8 rounded-full border-2 border-white flex items-center justify-center font-bold text-sm transition-all duration-300">4</div>
                            <div>
                                <h4 class="font-bold text-sm">Konfirmasi</h4>
                                <p class="text-xs text-pink-200">Review & Submit</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-xs text-pink-200 text-center md:text-left">
                    <p>© 2026 ICC - ITATS Coding Competition</p>
                </div>
            </div>

            <!-- Form Area -->
            <div class="bg-white md:w-2/3 p-8 flex flex-col relative w-full">
                <!-- Alerts -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                        <strong class="font-bold">Oops! Ada kesalahan:</strong>
                        <ul class="mt-1 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="wizardForm" action="{{ route('team.register') }}" method="POST" class="flex-1 flex flex-col justify-between h-full">
                    @csrf

                    <!-- Step 1 Content: Informasi Tim -->
                    <div class="step-content active" data-step="1">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Informasi Tim & Lomba</h3>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Kompetisi</label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($events as $event)
                                    <label class="cursor-pointer">
                                       <input type="radio"
                                            name="competition_id"
                                            value="{{ $event->id }}"
                                            data-max-member="{{ $event->max_members }}"
                                            class="peer sr-only"
                                            required
                                            {{ (old('competition_id') == $event->id || (isset($selected_event) && $selected_event->id == $event->id)) ? 'checked' : '' }}>
                                        <div class="p-4 border-2 border-gray-200 rounded-xl hover:border-pink-300 peer-checked:border-[#EC46A4] peer-checked:bg-pink-50 transition-all text-center">
                                            <div class="text-[#EC46A4] font-bold text-lg mb-1">{{ $event->name }}</div>
                                            <p class="text-xs text-gray-500 line-clamp-2">{{ strip_tags($event->description) }}</p>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <label for="team_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Tim</label>
                                <input type="text" name="team_name" id="team_name" value="{{ old('team_name') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-transparent outline-none transition placeholder-gray-400"
                                    placeholder="Contoh: Garuda Cyber Team">
                                <p class="text-xs text-gray-500 mt-1">Gunakan nama yang unik dan sopan.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 Content: Leader Data -->
                    <div class="step-content hidden" data-step="2">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Data Ketua Tim</h3>

                        <div class="space-y-4">
                            <!-- Pre-filled from User Auth -->
                            <div class="bg-blue-50 border border-blue-100 p-4 rounded-lg flex items-start gap-3 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-blue-800 font-semibold">Data diambil dari akun login Anda.</p>
                                    <p class="text-xs text-blue-600">Pastikan data ini benar sebelum melanjutkan.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" name="leader_name" value="{{ old('leader_name', $user->name) }}" required readonly
                                        class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600 cursor-not-allowed">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="leader_email" value="{{ old('leader_email', $user->email) }}" required readonly
                                        class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600 cursor-not-allowed">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">NPM</label>
                                    <input type="text" name="leader_npm" value="{{ old('leader_npm') }}" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-transparent outline-none transition"
                                        placeholder="Nomor Pokok Mahasiswa">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">No. WhatsApp</label>
                                    <input type="text" name="leader_phone" value="{{ old('leader_phone') }}" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#EC46A4] focus:border-transparent outline-none transition"
                                        placeholder="08xxxxxxxxxx">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 Content: Members -->
                    {{-- <div class="step-content hidden" data-step="3">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Anggota Tim</h3>

                        <div class="space-y-6">
                            <!-- Member 1 -->
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <h4 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <span class="w-6 h-6 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center text-xs">1</span>
                                    Anggota Pertama (Wajib)
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-500 uppercase">Nama Lengkap</label>
                                        <input type="text" name="member_1_name" value="{{ old('member_1_name') }}" required
                                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#EC46A4] outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-500 uppercase">NPM</label>
                                        <input type="text" name="member_1_npm" value="{{ old('member_1_npm') }}" required
                                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#EC46A4] outline-none">
                                    </div>
                                </div>
                            </div>

                            <!-- Member 2 -->
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <h4 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
                                    <span class="w-6 h-6 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center text-xs">2</span>
                                    Anggota Kedua (Opsional)
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-500 uppercase">Nama Lengkap</label>
                                        <input type="text" name="member_2_name" value="{{ old('member_2_name') }}"
                                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#EC46A4] outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-500 uppercase">NPM</label>
                                        <input type="text" name="member_2_npm" value="{{ old('member_2_npm') }}"
                                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#EC46A4] outline-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Step 3 Content: Members -->
<div class="step-content hidden" data-step="3">
    <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">
        Anggota Tim
    </h3>

    <p class="text-sm text-gray-500 mb-4">
        Jumlah anggota menyesuaikan dengan maksimal anggota kompetisi (ketua sudah dihitung).
    </p>

    <div id="membersContainer" class="space-y-6">
        <!-- Dynamic members injected by JS -->
    </div>
</div>


                    <!-- Step 4 Content: Review -->
                    <div class="step-content hidden" data-step="4">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 border-b pb-2">Konfirmasi Pendaftaran</h3>

                        <div class="bg-pink-50 border border-pink-100 rounded-xl p-6 text-center mb-6">
                            <h4 class="text-lg font-bold text-pink-800 mb-2">Hampir Selesai!</h4>
                            <p class="text-gray-600 text-sm">Pastikan semua data yang Anda masukkan sudah benar sebelum mendaftar.</p>
                        </div>

                        <div class="space-y-3 text-sm text-gray-700">
                            <!-- Summaries (Filled by JS) -->
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">Tim</span>
                                <span class="font-bold" id="review_team_name">-</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">Kompetisi</span>
                                <span class="font-bold" id="review_competition">-</span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">Ketua</span>
                                <span class="font-bold" id="review_leader">-</span>
                            </div>
                            <div class="flex justify-between pb-2">
                                <span class="text-gray-500">Anggota</span>
                                <span class="font-bold" id="review_members_count">- Orang</span>
                            </div>
                        </div>

                        <div class="mt-8 flex items-start gap-3">
                            <input type="checkbox" required id="confirm_check" class="mt-1 w-4 h-4 text-pink-600 border-gray-300 rounded focus:ring-pink-500">
                            <label for="confirm_check" class="text-sm text-gray-600">
                                Saya menyatakan bahwa data yang diisi adalah benar dan saya bersedia mengikuti seluruh aturan yang berlaku di ICC 2026.
                            </label>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between pt-8 border-t border-gray-100 mt-auto">
                        <button type="button" id="prevBtn" onclick="prevStep()" class="hidden px-6 py-2.5 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 font-semibold transition">
                            Kembali
                        </button>
                        <div class="ml-auto">
                            <button type="button" id="nextBtn" onclick="nextStep()" class="px-8 py-2.5 rounded-lg bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold shadow-lg shadow-pink-200 transition">
                                Lanjut
                            </button>
                            <button type="submit" id="submitBtn" class="hidden px-8 py-2.5 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold shadow-lg shadow-green-200 transition">
                                Daftar Sekarang
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let currentStep = 1;
const totalSteps = 4;
let maxMember = 0;

/* =========================
   Generate Member Inputs
========================= */
function generateMembers() {
    const container = document.getElementById('membersContainer');
    if (!container) return;

    container.innerHTML = '';

    if (maxMember <= 1) return;

    const memberCount = maxMember - 1; // ketua sudah dihitung

    for (let i = 1; i <= memberCount; i++) {
        container.insertAdjacentHTML('beforeend', `
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                <h4 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center text-xs">${i}</span>
                    Anggota ${i} ${i === 1 ? '(Wajib)' : '(Opsional)'}
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase">Nama Lengkap</label>
                        <input type="text"
                               name="members[${i}][name]"
                               ${i === 1 ? 'required' : ''}
                               class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#EC46A4] outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase">NPM</label>
                        <input type="text"
                               name="members[${i}][npm]"
                               ${i === 1 ? 'required' : ''}
                               class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#EC46A4] outline-none">
                    </div>
                </div>
            </div>
        `);
    }
}

/* =========================
   UI Update
========================= */
function updateUI() {
    document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
    document.querySelector(`.step-content[data-step="${currentStep}"]`).classList.remove('hidden');

    document.querySelectorAll('.step-indicator').forEach(el => {
        const step = parseInt(el.dataset.step);
        const circle = el.querySelector('div:first-child');

        if (step === currentStep) {
            el.classList.remove('opacity-60');
            circle.className = "w-8 h-8 rounded-full border-2 border-white bg-white text-[#EC46A4] flex items-center justify-center font-bold text-sm";
        } else if (step < currentStep) {
            el.classList.remove('opacity-60');
            circle.className = "w-8 h-8 rounded-full border-2 border-[#EC46A4] bg-[#EC46A4] text-white flex items-center justify-center font-bold text-sm";
            circle.innerHTML = "✓";
        } else {
            el.classList.add('opacity-60');
            circle.className = "w-8 h-8 rounded-full border-2 border-white flex items-center justify-center font-bold text-sm";
            circle.innerHTML = step;
        }
    });

    document.getElementById('prevBtn').classList.toggle('hidden', currentStep === 1);
    document.getElementById('nextBtn').classList.toggle('hidden', currentStep === totalSteps);
    document.getElementById('submitBtn').classList.toggle('hidden', currentStep !== totalSteps);

    if (currentStep === 3) generateMembers();
    if (currentStep === totalSteps) populateReview();
}

/* =========================
   Validation
========================= */
function validateStep(step) {
    let valid = true;
    const inputs = document.querySelector(`.step-content[data-step="${step}"]`)
        .querySelectorAll('input[required], select[required]');

    inputs.forEach(input => {
        if (!input.checkValidity()) {
            input.reportValidity();
            valid = false;
        }
    });
    return valid;
}

function nextStep() {
    if (validateStep(currentStep) && currentStep < totalSteps) {
        currentStep++;
        updateUI();
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        updateUI();
    }
}

/* =========================
   Review Step
========================= */
function populateReview() {
    document.getElementById('review_team_name').innerText =
        document.getElementById('team_name').value || '-';

    const selectedComp = document.querySelector('input[name="competition_id"]:checked');
    if (selectedComp) {
        const title = selectedComp.nextElementSibling.querySelector('.text-\\[\\#EC46A4\\]').innerText;
        document.getElementById('review_competition').innerText = title;
    }

    document.getElementById('review_leader').innerText =
        document.querySelector('input[name="leader_name"]').value;

    let total = 1; // ketua
    document.querySelectorAll('#membersContainer input[name$="[name]"]').forEach(input => {
        if (input.value.trim() !== '') total++;
    });

    document.getElementById('review_members_count').innerText = total + " Personil";
}

/* =========================
   Event Selection
========================= */
document.querySelectorAll('input[name="competition_id"]').forEach(radio => {
    radio.addEventListener('change', function () {
         console.log('Max member:', this.dataset.maxMember);
        maxMember = parseInt(this.dataset.maxMember);
        if (currentStep === 3) generateMembers();
    });
});

/* Init */
const checkedRadio = document.querySelector('input[name="competition_id"]:checked');
if (checkedRadio) {
    maxMember = parseInt(checkedRadio.dataset.maxMember);
}
updateUI();
</script>

@endsection
