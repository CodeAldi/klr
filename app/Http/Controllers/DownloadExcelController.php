<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelWriter;

class DownloadExcelController extends Controller
{
    function teknisiExcel(Request $request) {
        $laporan = Pemakaian::where('labor_komputer_id', Auth()->user()->assignment[0]->labkom->id)->get();
        if (count($laporan) > 0) {
            $namaLab = $laporan[0]->labor->namaLab;
            $writer = SimpleExcelWriter::streamDownload($namaLab . '.xlsx');
            $writer->addHeader(['no','nama peminjam','nama komputer','mulai','selesai']);
            foreach ($laporan as $key => $value) {
                $writer->addRow([
                    $key,
                    $value->user->name,
                    $value->komputer->nama,
                    date('H:i:s', strtotime($value->start)) . 'WIB' . date('d-m-Y', strtotime($value->start)),
                    date('H:i:s', strtotime($value->end)) . 'WIB' . date('d-m-Y', strtotime($value->end)),
                ]);
            }
            $writer->toBrowser();
            return back();
        }
    }
}
