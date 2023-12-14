<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Regency;
use App\Models\Sinonim;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
use App\Models\KataPembuka;
use Illuminate\Http\Request;
use App\Exports\ArtikelExport;
use App\Models\KategoriBisnis;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;

class ArtikelController extends Controller
{
    /**
     * Method index
     *
     * Fungsi menampilkan artikel sesuai dengan pembuat artikel
     *
     * @return void
     */
    public function index()
    {
        $created_by = Auth::user()->id;

        $data = Artikel::select('artikels.*')
            ->join(DB::raw('(SELECT MAX(id) AS max_id FROM artikels GROUP BY history) AS subquery'), function ($join) {
                $join->on('artikels.id', '=', 'subquery.max_id');
            })
            ->where('created_by', $created_by)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('artikel.index', compact('data'));

    }

    /**
     * Method create
     *
     * Fungsi menampilkan form untuk membuat artikel
     *
     * @return void
     */
    public function create()
    {
        $kategori = KategoriBisnis::all();
        $provinces = Province::all();
        return view('artikel.create', compact('provinces', 'kategori'));
    }

    /**
     * Method store
     *
     * Fungsi untuk menyimpan artikel ke database
     *
     * @param Request $request [explicite description]
     *
     * @return void
     */
    public function store(Request $request)
    {
        $history = uniqid();
        if (!empty(Auth::user()->no_bisnis) && (Auth::user()->no_personal) ) {
            if (
                Auth::user()->hasRole([
                    'super-admin',
                    'admin',
                    'contributor-pro',
                ])
            ) {
                $validatedData = $request->validate(
                    [
                        'provinsi' => 'required_if:target,1',
                        'kabupaten' => 'nullable|required_if:target,2',
                        'judul' => 'required',
                        'keyword' => 'nullable',
                        'kata_pembuka' => 'required',
                        'artikel' => 'required',
                        'keyword_tanya' => 'nullable',
                        'keyword_terkait' => 'nullable',
                    ],
                    [
                        'judul.required' => 'Judul tidak boleh kosong!',
                        'kata_pembuka.required' => 'Kata pembuka tidak boleh kosong!',
                        'artikel.required' => 'Artikel tidak boleh kosong!',
                    ]
                );
            } else {
                $validatedData = $request->validate(
                    [
                        'provinsi' => 'required_if:target,1',
                        'kabupaten' => 'nullable|required_if:target,2',
                        'judul' => 'required',
                        'kata_pembuka' => 'required',
                        'artikel' => 'required',
                    ],
                    [
                        'judul.required' => 'Judul tidak boleh kosong!',
                        'kata_pembuka.required' =>'Kata pembuka tidak boleh kosong!',
                        'artikel.required' => 'Artikel tidak boleh kosong!',
                    ]
                );
            }
            if ($request->input('target') == '1') {
                $key = 0;
                $provinsiId = $request->input('provinsi');
                $kabupatens = Regency::where('province_id', $provinsiId)->get();
                foreach ($kabupatens as $kabupaten) {
                    $kecamatan = District::where(
                        'regency_id',
                        $kabupaten->id
                    )->get();
                    $no = Auth::user()->no_bisnis;
                    $alamat = Auth::user()->alamat;
                    $kecamatanArray = $kecamatan->pluck('name')->toArray();
                    $spin = $request->input('spin');
                    $isi = $request->input('artikel');
                    if ($spin) {
                        $isiartikel = $this->spin($isi, $key);
                        $isi = $isiartikel;
                    }
                    $artikel = new Artikel();
                    $artikel->provinsi = $provinsiId;
                    $artikel->kabupaten = $kabupaten->id;
                    $artikel->judul =
                    $request->input('judul') .
                    ' ' .
                    ucwords(strtolower($kabupaten->name));
                    $artikel->keyword = $this->replace(
                        $request->input('keyword'),
                        $kabupaten->name
                    );
                    $artikel->kata_pembuka = $this->replace(
                        $request->input('kata_pembuka'),
                        ucwords(strtolower($kabupaten->name)),
                        array_map(function ($kecamatan) {
                            return ucwords(strtolower($kecamatan));
                        }, $kecamatanArray),
                        $no,
                        $alamat
                    );
                    $artikel->artikel = $this->replace(
                        $isi,
                        ucwords(strtolower($kabupaten->name)),
                        array_map(function ($kecamatan) {
                            return ucwords(strtolower($kecamatan));
                        }, $kecamatanArray)
                    );
                    $artikel->keyword_tanya = $this->replace(
                        $request->input('keyword_tanya'),
                        ucwords(strtolower($kabupaten->name))
                    );
                    $artikel->keyword_terkait = $this->replace(
                        $request->input('keyword_terkait'),
                        ucwords(strtolower($kabupaten->name))
                    );
                    $artikel->history = $history;
                    $artikel->created_by = Auth::user()->id;
                    $artikel->save();
                }
            } elseif ($request->input('target') == '2') {
                $key = 0;
                $kabupatenId = $request->input('kabupaten');
                $kecamatans = District::where(
                    'regency_id',
                    $kabupatenId
                )->get();
                foreach ($kecamatans as $kecamatan) {
                    $desa = Village::where(
                        'district_id',
                        $kecamatan->id
                    )->get();
                    $no = Auth::user()->no_bisnis;
                    $alamat = Auth::user()->alamat;
                    $desaArray = $desa->pluck('name')->toArray();
                    $spin = $request->input('spin');
                    $isi = $request->input('artikel');
                    if ($spin == true) {
                        $isiartikel = $this->spin($isi, $key);
                        $isi = $isiartikel;
                    }

                    $artikel = new Artikel();
                    $artikel->provinsi = $request->input('provinsi');
                    $artikel->kabupaten = $kabupatenId;
                    $artikel->judul =
                    $request->input('judul') .
                    ' ' .
                    ucwords(strtolower($kecamatan->name));
                    $artikel->keyword = $this->replace(
                        $request->input('keyword'),
                        ucwords(strtolower($kecamatan->name))
                    );
                    $artikel->kata_pembuka = $this->replace(
                        $request->input('kata_pembuka'),
                        ucwords(strtolower($kecamatan->name)),
                        array_map(function ($desa) {
                            return ucwords(strtolower($desa));
                        }, $desaArray),
                        $no,
                        $alamat
                    );
                    $artikel->artikel = $this->replace(
                        $isi,
                        ucwords(strtolower($kecamatan->name)),
                        array_map(function ($desa) {
                            return ucwords(strtolower($desa));
                        }, $desaArray)
                    );

                    $artikel->keyword_tanya = $this->replace(
                        $request->input('keyword_tanya'),
                        $kecamatan->name
                    );
                    $artikel->keyword_terkait = $this->replace(
                        $request->input('keyword_terkait'),
                        $kecamatan->name
                    );
                    $artikel->history = $history;
                    $artikel->created_by = Auth::user()->id;
                    $artikel->save();
                }
            }
            return redirect()
                ->route('artikel.index')
                ->with('message', 'Artikel berhasil tambah');
        } else {
            $user = Crypt::encryptString(Auth::user()->id);
            return redirect()->route('profile.edit', $user);
        }
    }

    /**
     * Method clear
     *
     * Fungsi untuk menghapus semua artikel yang sudah dibuat
     *
     * @return void
     */
    public function clear($history)
    {
        $clear = Artikel::where('history', $history)->delete();
        return redirect()->route('artikel.index');
    }

    /**
     * Method getKabupaten
     *
     * Fungsi untuk mengambil data kabupaten
     *
     * @param Request $request [explicite description]
     *
     * @return json [data kabupaten]
     */
    public function getKabupaten(Request $request)
    {
        $id_provinsi = $request->id;
        $kabupaten = Regency::where('province_id', $id_provinsi)->get();

        return response()->json($kabupaten);
    }

    /**
     * Method getKecamatan
     *
     * Fungsi untuk mengambil data kecamatan
     *
     * @param Request $request [explicite description]
     *
     * @return json
     */
    public function getKecamatan(Request $request)
    {
        $id_kabupaten = $request->id;
        $kecamatan = District::where('regency_id', $id_kabupaten)->get();

        return response()->json($kecamatan);
    }

    /**
     * Method getKatapembuka
     *
     * Fungsi untuk mengambil referensi kata pembuka
     *
     * @param Request $request [explicite description]
     *
     * @return json
     */
    public function getKatapembuka(Request $request)
    {
        $id_kategori = $request->id;
        $kata_pembuka = KataPembuka::where('kategori', $id_kategori)->get();

        return response()->json($kata_pembuka);
    }

    /**
     * Method getIsiartikel
     *
     * Fungsi untuk mengambil referensi artikel
     *
     * @param Request $request [explicite description]
     *
     * @return json
     */


    /**
     * Method export
     *
     * Fungsi export untuk melakukan export artikel ke dalam excel
     *
     * @return void
     */
    public function export($artikel)
    {
        return Excel::download(new ArtikelExport($artikel), 'artikel.xlsx');
    }
    

    /**
     * Method replace
     * Fungsi untuk melakukan replace tags yang diberikan pada artikel
     * @param $string [kalimat yang akan di replace]
     * @param $array1 [mereplace dengan target1]
     * @param $no [mereplace dengan no telepon]
     * @param $alamat [mereplace dengan alamat]
     * @return void
     */
    private function replace(
        $string,
        $array1 = [],
        $array2 = [],
        $no = '',
        $alamat = ''
    ) {
        $text = $string;

        if (!empty($array1)) {
            $text = str_replace('[target1]', $array1, $text);
        }

        if (!empty($array2)) {
            $text = str_replace('[target2]', implode("\n", $array2), $text);
        }

        if (!empty($no)) {
            $text = str_replace('[no telepon]', $no, $text);
        }

        if (!empty($alamat)) {
            $text = str_replace('[alamat]', $alamat, $text);
        }

        return $text;
    }

    /**
     * Method spin
     *
     * @param $text [isi artikel yang akan di spin]
     * @param $key [index random number]
     *
     * @return void
     */
    private function spin($text, $key)
    {
        $inputArtikel = $text;
        $inputKata = '';
        $return = '';
        $words = explode(' ', $inputArtikel);
        foreach ($words as $word) {
            $inputKata = $word;
            $sinonimField = Sinonim::where(
                'data',
                'LIKE',
                $inputKata . '%'
            )->pluck('data');
            if ($sinonimField->isEmpty()) {
                continue;
            }
            $sinonimArray = explode('|', $sinonimField->first());
            $jumlahIndeks = count($sinonimArray);
            if ($jumlahIndeks > 1) {
                $key = array_rand($sinonimArray);
            } else {
                $key = 0;
            }
            $sinonimTerpilih = $sinonimArray[$key];
            $return = str_replace($inputKata, $sinonimTerpilih, $inputArtikel);
            $inputArtikel = $return;
        }
        return $inputArtikel;
    }
}
