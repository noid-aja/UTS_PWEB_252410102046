<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function loginForm(Request $request)
    {
        return view('login', [
            'registered' => $request->query('registered'),
            'username'   => $request->query('username', ''),
        ]);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|min:6|max:20',
            'password' => 'required|min:7',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.min'      => 'Username minimal 6 karakter.',
            'username.max'      => 'Username maksimal 20 karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 7 karakter.',
        ]);

        return redirect()->route('dashboard', ['username' => $data['username']]);
    }

    public function registerForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|min:6|max:20',
            'email'    => 'required|email',
            'password' => 'required|min:7|confirmed',
        ], [
            'username.required'  => 'Username wajib diisi.',
            'username.min'       => 'Username minimal 6 karakter.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email belum benar.',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 7 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
        ]);

        return redirect()->route('login', [
            'registered' => 1,
            'username'   => $data['username'],
        ]);
    }

    public function dashboard(Request $request)
    {
        $username = $request->query('username');
        if (!$username) {
            return redirect()->route('login');
        }

        $songs = $this->songs();

        $stats = [
            ['label' => 'Lagu tersedia', 'value' => count($songs)],
            ['label' => 'Genre berbeda', 'value' => count(array_unique(array_column($songs, 'genre')))],
            ['label' => 'Instrumen',     'value' => 3],
        ];

        $steps = [
            'Pilih satu lagu dari halaman Katalog Lagu.',
            'Mulai dari tab gitar atau bass, mainkan pelan dulu.',
            'Pasang metronom sesuai BPM lagu, lalu naikkan tempo sedikit demi sedikit.',
            'Coba pola drum untuk merasakan groove lagunya.',
        ];

        return view('dashboard', [
            'username' => $username,
            'stats'    => $stats,
            'featured' => array_slice($songs, 0, 3),
            'steps'    => $steps,
        ]);
    }

    public function pengelolaan(Request $request)
    {
        $username = $request->query('username');
        if (!$username) {
            return redirect()->route('login');
        }

        $labels = ['guitar' => 'Gitar', 'bass' => 'Bass', 'drums' => 'Drum'];

        $songs = array_map(function ($song) use ($labels) {
            $song['instruments'] = array_filter(
                $labels,
                fn ($label, $key) => !empty($song[$key]['tab']),
                ARRAY_FILTER_USE_BOTH
            );
            return $song;
        }, $this->songs());

        return view('pengelolaan', [
            'username' => $username,
            'songs'    => $songs,
        ]);
    }

    public function profile(Request $request)
    {
        $username = $request->query('username');
        if (!$username) {
            return redirect()->route('login');
        }

        $songs = $this->songs();

        // Contoh data profil (disimulasikan, bukan dari database)
        $skills = [
            ['name' => 'Gitar', 'percent' => 70, 'color' => 'amber'],
            ['name' => 'Bass',  'percent' => 45, 'color' => 'teal'],
            ['name' => 'Drum',  'percent' => 55, 'color' => 'coral'],
        ];

        return view('profile', [
            'username'  => $username,
            'skills'    => $skills,
            'favorites' => array_slice($songs, 0, 4),
            'since'     => now()->format('d M Y'),
        ]);
    }

    public function logout()
    {
        return redirect()->route('login');
    }

    private function songs(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Crazy Train',
                'artist' => 'Ozzy Osbourne',
                'genre' => 'Heavy Metal',
                'year' => 1980,
                'bpm' => 138,
                'key' => 'F# minor',
                'level' => 'Sedang',
                'color' => 'amber',
                'desc' => 'Riff gitar ikonik dengan nuansa pentatonik F# minor dan tempo yang cepat.',
                'guitar' => [
                    'title' => 'Kerangka riff (pentatonik F# minor, versi sederhana)',
                    'tab' => 'e|-------------------------------|
B|-------------------------------|
G|-------------------------------|
D|-------------------------------|
A|-------4-----2--------4-----0--|
E|-2--2-----2-----2--2-----2-----|',
                ],
                'bass' => [
                    'title' => 'Ikuti nada akar gitar',
                    'tab' => 'G|-------------------------------|
D|-------------------------------|
A|-------4-----2--------4-----0--|
E|-2--2-----2-----2--2-----2-----|',
                ],
                'drums' => [
                    'title' => 'Beat rock 4/4',
                    'tab' => 'HH|x-x-x-x-x-x-x-x-|
SD|----o-------o---|
BD|o-------o-------|',
                    'tip' => 'Kick di ketukan 1 dan 3, snare di ketukan 2 dan 4, hi-hat delapanan terus.',
                ],
            ],
            [
                'id' => 2,
                'title' => 'Smoke on the Water',
                'artist' => 'Deep Purple',
                'genre' => 'Hard Rock',
                'year' => 1972,
                'bpm' => 112,
                'key' => 'G minor (blues)',
                'level' => 'Mudah',
                'color' => 'teal',
                'desc' => 'Riff paling sering dipelajari pemula, dimainkan di dua senar sekaligus.',
                'guitar' => [
                    'title' => 'Riff utama (senar D dan G dimainkan bareng)',
                    'tab' => 'e|-------------------------------------------|
B|-------------------------------------------|
G|-0--3--5----0--3--6--5----0--3--5----3--0--|
D|-0--3--5----0--3--6--5----0--3--5----3--0--|
A|-------------------------------------------|
E|-------------------------------------------|',
                ],
                'bass' => [
                    'title' => 'Riff di senar E',
                    'tab' => 'G|-------------------------------------------|
D|-------------------------------------------|
A|-------------------------------------------|
E|-3--6--8----3--6--9--8----3--6--8----6--3--|',
                ],
                'drums' => [
                    'title' => 'Beat rock sederhana',
                    'tab' => 'HH|x-x-x-x-x-x-x-x-|
SD|----o-------o---|
BD|o-------o-o-----|',
                    'tip' => 'Pola dasar saja. Mulai dari kick dan snare dulu, baru tambah hi-hat.',
                ],
            ],
            [
                'id' => 3,
                'title' => 'Seven Nation Army',
                'artist' => 'The White Stripes',
                'genre' => 'Alternative Rock',
                'year' => 2003,
                'bpm' => 124,
                'key' => 'E minor',
                'level' => 'Mudah',
                'color' => 'coral',
                'desc' => 'Riff satu senar yang gampang dihafal, enak buat latihan alternate picking.',
                'guitar' => [
                    'title' => 'Riff utama (satu senar A)',
                    'tab' => 'e|-----------------------|
B|-----------------------|
G|-----------------------|
D|-----------------------|
A|-7--7--10--7--5--3--2--|
E|-----------------------|',
                ],
                'bass' => [
                    'title' => 'Nada sama di senar A bass',
                    'tab' => 'G|-----------------------|
D|-----------------------|
A|-7--7--10--7--5--3--2--|
E|-----------------------|',
                ],
                'drums' => [
                    'title' => 'Kick di setiap ketukan',
                    'tab' => 'HH|----------------|
SD|----o-------o---|
BD|o---o---o---o---|',
                    'tip' => 'Kick dimainkan tegas di empat ketukan. Versi sederhana untuk latihan.',
                ],
            ],
            [
                'id' => 4,
                'title' => 'Highway to Hell',
                'artist' => 'AC/DC',
                'genre' => 'Hard Rock',
                'year' => 1979,
                'bpm' => 116,
                'key' => 'A mayor',
                'level' => 'Mudah',
                'color' => 'amber',
                'desc' => 'Progresi chord terbuka A, D/F#, dan G yang cocok buat pemula.',
                'guitar' => [
                    'title' => 'Chord: A, D/F#, G',
                    'tab' => 'e|-0--2--3--|
B|-2--3--0--|
G|-2--2--0--|
D|-2--0--0--|
A|-0--0--2--|
E|----2--3--|',
                ],
                'bass' => [
                    'title' => 'Nada akar tiap chord',
                    'tab' => 'G|----------|
D|----------|
A|-0--5-----|
E|-------3--|',
                ],
                'drums' => [
                    'title' => 'Beat rock 4/4',
                    'tab' => 'HH|x-x-x-x-x-x-x-x-|
SD|----o-------o---|
BD|o-------o-------|',
                    'tip' => 'Jaga tempo tetap stabil, kekuatan lagu ini ada di groove yang lurus.',
                ],
            ],
            [
                'id' => 5,
                'title' => 'Smells Like Teen Spirit',
                'artist' => 'Nirvana',
                'genre' => 'Grunge',
                'year' => 1991,
                'bpm' => 117,
                'key' => 'F minor',
                'level' => 'Sedang',
                'color' => 'teal',
                'desc' => 'Empat power chord F5, Bb5, Ab5, Db5 yang jadi ciri khas grunge.',
                'guitar' => [
                    'title' => 'Power chord: F5, Bb5, Ab5, Db5',
                    'tab' => 'e|--------------|
B|--------------|
G|--------------|
D|-3--8--6--11--|
A|-3--8--6--11--|
E|-1--6--4--9---|',
                ],
                'bass' => [
                    'title' => 'Nada akar tiap chord',
                    'tab' => 'G|-------------|
D|-------------|
A|-------------|
E|-1--6--4--9--|',
                ],
                'drums' => [
                    'title' => 'Pola dasar rock',
                    'tab' => 'HH|x-x-x-x-x-x-x-x-|
SD|----o-------o---|
BD|o-------o-o-----|',
                    'tip' => 'Tambahkan crash di ketukan pertama saat chorus supaya lebih keras.',
                ],
            ],
            [
                'id' => 6,
                'title' => 'We Will Rock You',
                'artist' => 'Queen',
                'genre' => 'Rock',
                'year' => 1977,
                'bpm' => 81,
                'key' => 'Tanpa nada tetap',
                'level' => 'Mudah',
                'color' => 'coral',
                'desc' => 'Hampir seluruhnya ritme: dua hentakan kaki dan satu tepuk tangan.',
                'guitar' => [
                    'title' => null,
                    'tab' => null,
                ],
                'bass' => [
                    'title' => null,
                    'tab' => null,
                ],
                'drums' => [
                    'title' => 'Stomp, stomp, clap',
                    'tab' => 'SD|--------o-------|
BD|o---o-----------|',
                    'tip' => 'Kick dua kali lalu snare satu kali (pengganti tepuk tangan), diikuti jeda.',
                ],
            ],
        ];
    }
}
