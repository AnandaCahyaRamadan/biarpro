<?php

namespace App\Exports;

use App\Models\Artikel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArtikelExport implements FromCollection, WithHeadings
{

    protected $history;

    public function __construct($history)
    {
        $this->history = $history;
    }

    public function collection()
    {
        if (Auth::user()->hasRole(['super-admin', 'admin', 'contributor-pro'])) {
            return Artikel::where('history', $this->history)
                ->select(
                    'judul',
                    DB::raw("CONCAT( keyword,'\n\n', kata_pembuka,'\n\n', artikel,'\n\n', keyword_tanya) as Deskripsi")
                )->get();
        } else {
            return Artikel::where('history', $this->history)
                ->select(
                    'judul',
                    DB::raw("CONCAT(kata_pembuka,'\n\n',artikel) as Deskripsi")
                )->get();
        }
    }

    /**
     * Method headings
     *
     * @return array
     */
    public function headings(): array
    {
        if (Auth::user()->hasRole(['super-admin', 'admin', 'contributor-pro'])) {
            return [
                'Judul',
                'Deskripsi',
            ];
        } else {
            return [
                'Judul',
                'Deskripsi',
            ];
        }
    }

}
