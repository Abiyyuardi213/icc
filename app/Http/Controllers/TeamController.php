<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    public function create()
    {
        return view('registration');
    }

    public function store(Request $request)
    {
        $rules = [
            'competition_type' => ['required', 'string', Rule::in(['Basis Data', 'Pemrograman Terstruktur'])],
            'team_name' => 'required|string|max:255|unique:teams,team_name',

            'leader_name' => 'required|string|max:255',
            'leader_npm' => 'required|string|max:255|unique:teams,leader_npm',
            'leader_email' => 'required|email|max:255|unique:teams,leader_email',
            'leader_phone' => 'required|string|max:15',

            'member_1_name' => 'required|string|max:255',
            'member_1_npm' => 'required|string|max:255|unique:teams,member_1_npm',

            'member_2_name' => 'nullable|string|max:255',
            'member_2_npm' => 'nullable|string|max:255|unique:teams,member_2_npm|required_with:member_2_name',
        ];

        $validatedData = $request->validate($rules, [
            'competition_type.required' => 'Jenis kompetisi wajib dipilih.',
            'team_name.unique' => 'Nama tim ini sudah terdaftar.',
            'leader_email.unique' => 'Email ketua tim ini sudah terdaftar.',
            'leader_npm.unique' => 'NPM ketua tim ini sudah terdaftar sebagai ketua di tim lain.',
            'member_1_npm.unique' => 'NPM anggota tim 1 ini sudah terdaftar sebagai anggota tim 1 di tim lain.',
            'member_2_npm.unique' => 'NPM anggota tim 2 ini sudah terdaftar sebagai anggota tim 2 di tim lain.',
            'member_2_npm.required_with' => 'NPM Anggota Tim 2 wajib diisi jika Nama Anggota Tim 2 diisi.',
        ]);

        $npms = array_filter([
            $validatedData['leader_npm'],
            $validatedData['member_1_npm'],
            $validatedData['member_2_npm'] ?? null
        ]);

        if (count($npms) !== count(array_unique($npms))) {
            return back()->withErrors(['npm_duplicate' => 'NPM Ketua dan Anggota tidak boleh ada yang sama dalam satu tim.'])->withInput();
        }

        Team::create($validatedData);

        return redirect('/register')->with('success', 'Registrasi Tim ICC 2026 berhasil! Selamat berkompetisi!');
    }
}
