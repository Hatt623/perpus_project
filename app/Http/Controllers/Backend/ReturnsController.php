<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Returns;
use App\Models\Book;

use Carbon\Carbon;
use Auth;

// import buat laporan
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class ReturnsController extends Controller
{
    public function index()
    {
        //cara pertama penjelasan: unique tuh bakal hapus duplikat
        $returns = Returns::with('book', 'lending', 'user')->latest()->get()->unique('lend_code'); 
        
        // cara kedua map akan ambil baris pertama sebagai representasi
        // $returns = Returns::with('book','lending','user')
        //     ->get()
        //     ->groupBy('lend_code')
        //     ->map(function ($group) {
        //         return $group->first(); // ambil salah satu representatif
        //     }); 
        
        $title = 'Delete Returns & Lendings';
        $text = 'Are you sure you want to delete this data?';
        confirmDelete($title, $text);

        return view('backend.return.index', compact('returns'));
    }

    public function show($id)
    {
       $return = Returns::with('user', 'lending.book')->findOrFail($id);
       return view('backend.return.show', compact('return'));
    }

    public function showByLendCode($code)
    {
        $returns = Returns::with('book', 'lending', 'user')->where('lend_code', $code)->get();

        if ($returns->isEmpty()) {
            toast('No returns found for lend code: ' . $code, 'warning');
            return redirect()->route('backend.returns.index');
        }

        return view('backend.return.grouped', compact('returns', 'code'));
    }

    public function lendingReports(Request $request)
    {
        $query = Returns::with('book', 'user')->latest();

        // Filter tanggal
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay(),
            ]);
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $returns = $query->get()->unique('lend_code');
        return view('backend.return.reports', compact('returns'));
    }

    public function destroy($id)
    {
        $return = Returns::findOrFail($id);

        // Ambil buku terkait dan tambah quantity bila kondisi good
        if ($return->book_status == 'good') {

        $book = Book::find($return->book_id);
        $book->stock += 1; // nambah balik buku yang dikembalikan
        $book->save();

        Returns::where('id', $id)->delete();
        toast('Book successfully returned', 'success');
        return redirect()->route('backend.returns.group',$return->lend_code);
        }
        
        $return -> delete();
        toast('Data successfully deleted', 'success');
        return redirect()->route('backend.returns.group', $return->lend_code);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,success,cancel',
            'book_status' => 'required|in:good,bad',
            'fines' => 'nullable|numeric|min:0',
            'lending_status' => 'required|in:borrowed,returned',
            

        ]);

        $return =   Returns::findOrFail($id);
        $return ->  status = $request->status;
        $return ->  book_status = $request->book_status;
        $return ->  lending_status = $request->lending_status;
        $return ->  returned_at = $return->returned_at;
        $return->fines = $return->calculateFines();

        // logiknya kurang logis komen aja
        // if ($return->lending_status == 'returned') {
        //     $return->lending_status = 'returned';
        //     $return->save();

        //     // Ambil buku terkait dan tambah quantity
        //     $book = Book::find($return->book_id);
        //     $book->stock += 1; // nambah balik buku yang dikembalikan
        //     $book->save();

        //     Returns::where('id', $id)->delete();
        //     toast('Book successfully returned', 'success');
        //     return redirect()->route('backend.returns.group',$return->lend_code);
        // }

        $return->save();
        toast('Data updated successfully', 'success');
        return redirect()->route('backend.returns.show', $id);
    }

    // Laporan
    // CSV
    public function exportCSV(Request $request)
    {
        $query = Returns::with('user', 'book',);

        // Filter tanggal
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay(),
            ]);
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $returns = $query->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=returns.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $columns = ['No', 'User', 'Lend Code', 'Book Title', 'Status', 'Lending Status', 'Returned At', 'Fines'];

        $callback = function () use ($returns, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            $No = 1;
            foreach ($returns as $return) {
                fputcsv($file, [
                    $No++,
                    optional($return->user)->name,
                    $return->lend_code,
                    optional($return->book)->title,
                    $return->status,
                    $return->lending_status,
                    optional($return->created_at)->format('d M Y'),
                    optional($return->returned_at)->format('d M Y'),
                    $return->calculateFines(),
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

        // PDF
    public function exportPDF(Request $request)
    {
        $query = Returns::with('user','book');

        // Filter tanggal
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay(),
            ]);
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $returns = $query->get();

        $pdf = Pdf::loadView('backend.return.pdf', compact('returns'))->setPaper('a4','landscape');

        return $pdf->download('returns.pdf');
    }
}
