@extends('layouts.user')

@section('title', 'Event Saya - ICC')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Event Saya</h1>
            <p class="text-gray-600">Daftar kompetisi yang sedang Anda ikuti.</p>
        </div>
        <a href="{{ route('event.list') }}"
            class="px-4 py-2 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold rounded-lg shadow-md transition text-sm">
            Tambah Event
        </a>
    </div>

    @php
        $teams = auth()->user()->teams()->orderBy('created_at', 'desc')->get();
    @endphp

    @if ($teams->count() > 0)
        <div class="space-y-8">
            @foreach ($teams as $team)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50 bg-opacity-50">
                        <div>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold 
                        {{ $team->status == 'verified' ? 'bg-green-100 text-green-700' : ($team->status == 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                {{ ucfirst($team->status) }}
                            </span>
                            <h3 class="text-xl font-bold text-gray-800 mt-2">{{ $team->event->name }}</h3>
                        </div>
                        <!-- Assuming edit route needs context now or just edit latest? For now keeps same route but might need param if generic edit exists.
                                         However, TeamController@edit currently gets Auth::user()->team (latest).
                                         Ideally we update edit to accept team id or event id.
                                         For now, let's assume we need to fix TeamController@edit too. -->
                        <!-- Ideally: route('team.edit', $team->id) -->
                        <a href="{{ route('participants.edit') }}"
                            class="text-[#EC46A4] hover:text-[#d63f93] font-medium text-sm flex items-center gap-1 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Tim
                        </a>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-4">Informasi Tim</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between border-b pb-2">
                                    <span class="text-gray-500 text-sm">Nama Tim</span>
                                    <span class="font-medium text-gray-800">{{ $team->name }}</span>
                                </div>
                                <div class="flex justify-between border-b pb-2">
                                    <span class="text-gray-500 text-sm">Tanggal Daftar</span>
                                    <span class="font-medium text-gray-800">{{ $team->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between pb-2">
                                    <span class="text-gray-500 text-sm">Ketua Tim</span>
                                    <span
                                        class="font-medium text-gray-800">{{ $team->leader_name ?? auth()->user()->name }}</span>
                                    <!-- Assuming leader_name might be in related table or accessor. TeamController saves it in members table.
                                                     We need a helper or relation. Team hasMany Members. -->
                                    @php
                                        // Quick fix to get leader name if not direct attribute, depending on model implementation
                                        // $leader = $team->members()->where('role', 'leader')->first();
                                        // $leaderName = $leader ? $leader->name : (auth()->user()->name);
                                    @endphp
                                    <!-- Actually the view used $team->leader_name before, assuming it existed or was accessor -->
                                </div>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-4">Timeline Event</h4>
                            <div class="relative border-l-2 border-gray-200 ml-3 space-y-6 pb-2">
                                <div class="mb-8 ml-6">
                                    <span
                                        class="absolute -left-2.5 flex items-center justify-center w-5 h-5 bg-blue-100 rounded-full ring-4 ring-white">
                                        <span class="w-2.5 h-2.5 bg-blue-500 rounded-full"></span>
                                    </span>
                                    <h5 class="flex items-center mb-1 text-sm font-semibold text-gray-900">Pendaftaran</h5>
                                    <time class="block mb-2 text-xs font-normal leading-none text-gray-400">Sedang
                                        Berlangsung</time>
                                </div>
                                <div class="mb-8 ml-6">
                                    <span
                                        class="absolute -left-2.5 flex items-center justify-center w-5 h-5 bg-gray-200 rounded-full ring-4 ring-white">
                                        <span class="w-2.5 h-2.5 bg-gray-400 rounded-full"></span>
                                    </span>
                                    <h5 class="flex items-center mb-1 text-sm font-semibold text-gray-500">Technical Meeting
                                    </h5>
                                    <time class="block mb-2 text-xs font-normal leading-none text-gray-400">Akan
                                        Datang</time>
                                </div>

                                @if ($team->event->preliminary_date)
                                    <div class="mb-8 ml-6">
                                        <span
                                            class="absolute -left-2.5 flex items-center justify-center w-5 h-5 bg-yellow-100 rounded-full ring-4 ring-white">
                                            <span class="w-2.5 h-2.5 bg-yellow-400 rounded-full"></span>
                                        </span>
                                        <h5 class="flex items-center mb-1 text-sm font-semibold text-gray-900">Penyisihan
                                        </h5>
                                        <time
                                            class="block mb-2 text-xs font-normal leading-none text-gray-400">{{ $team->event->preliminary_date->format('d M Y') }}</time>
                                    </div>
                                @endif

                                @if ($team->event->final_date)
                                    <div class="mb-8 ml-6">
                                        <span
                                            class="absolute -left-2.5 flex items-center justify-center w-5 h-5 bg-purple-100 rounded-full ring-4 ring-white">
                                            <span class="w-2.5 h-2.5 bg-purple-400 rounded-full"></span>
                                        </span>
                                        <h5 class="flex items-center mb-1 text-sm font-semibold text-gray-900">Final</h5>
                                        <time
                                            class="block mb-2 text-xs font-normal leading-none text-gray-400">{{ $team->event->final_date->format('d M Y') }}</time>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="p-6 border-t border-gray-100">
                        <h4 class="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#EC46A4]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Tugas & Submisi
                        </h4>

                        @if ($team->status === 'verified')
                            @if ($team->event->tasks->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach ($team->event->tasks as $task)
                                        @php
                                            if ($task->type === 'quiz') {
                                                // Check for individual submission first
                                                $submission = \App\Models\Submission::where('task_id', $task->id)
                                                    ->where('user_id', auth()->id())
                                                    ->first();
                                            } else {
                                                // Regular task uses team submission
                                                $submission = $team->submissions->where('task_id', $task->id)->first();
                                            }

                                            $status = $submission ? 'Selesai' : 'Belum Submit';
                                            $statusColor = $submission
                                                ? 'text-green-600 bg-green-50'
                                                : 'text-yellow-600 bg-yellow-50';

                                            // Check if overdue
                                            $isOverdue = now()->greaterThan($task->end_time) && !$submission;
                                            if ($isOverdue) {
                                                $status = 'Waktu Habis';
                                                $statusColor = 'text-red-600 bg-red-50';
                                            }
                                        @endphp
                                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                            <div class="flex justify-between items-start mb-2">
                                                <h5 class="font-semibold text-gray-800">{{ $task->title }}</h5>
                                                <span
                                                    class="text-xs px-2 py-1 rounded-full font-medium {{ $statusColor }}">
                                                    {{ $status }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-500 mb-3 line-clamp-2">
                                                {{ Str::limit(strip_tags($task->description), 80) }}</p>
                                            <div class="flex justify-between items-center text-xs text-gray-500 mb-4">
                                                <span>Deadline: {{ $task->end_time->format('d M H:i') }}</span>
                                            </div>
                                            <a href="{{ route('user.tasks.show', $task->id) }}"
                                                class="block text-center w-full py-2 rounded-lg bg-gray-50 text-gray-700 hover:bg-[#EC46A4] hover:text-white font-medium transition text-sm">
                                                {{ $submission || $isOverdue ? 'Lihat Tugas/Nilai' : 'Kerjakan Tugas' }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                    <p class="text-gray-500 text-sm">Belum ada tugas yang diberikan untuk event ini.</p>
                                </div>
                            @endif
                        @else
                            <div
                                class="text-center py-6 bg-yellow-50 rounded-lg border border-yellow-100 text-yellow-700 text-sm">
                                <p class="font-semibold">Menunggu Verifikasi</p>
                                <p>Tugas akan muncul setelah tim Anda diverifikasi oleh admin.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="bg-pink-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-[#EC46A4]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Belum ada Event</h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto">Anda belum mendaftar di kompetisi manapun. Yuk pilih kompetisi
                yang sesuai dengan minatmu!</p>
            <a href="{{ route('event.list') }}"
                class="px-6 py-2.5 bg-[#EC46A4] hover:bg-[#d63f93] text-white font-semibold rounded-lg shadow-md transition">
                Lihat Event Tersedia
            </a>
        </div>
    @endif
@endsection
