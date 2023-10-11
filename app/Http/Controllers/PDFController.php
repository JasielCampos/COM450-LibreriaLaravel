<?php

namespace App\Http\Controllers;

use App\Models\book_issue;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\book;

class PDFController extends Controller
{
  function pdf_date(Request $request)
  {
    $request->validate(['date' => "required|date"]);
    $pdf = Pdf::loadView('report.dateWise', ['books' => book_issue::where('issue_date', 'LIKE', '%' . $request->date)->latest()->get()]);
    return $pdf->stream();
  }
  // function pdf_month(Request $request)
  // {
  //   $request->validate(['month' => "required|date"]);
  //   $pdf = Pdf::loadView('report.pdf_month', ['books' => book_issue::where('issue_date', 'LIKE', '%' . $request->month . '%')->latest()->get(),]);
  //   return $pdf->stream('a4' . 'landscape')->stream();
  // }

  // public function pdf_month(Request $request)
  // {
  //   // Obtén los libros según el mes
  //   $month = $request->input('month');
  //   $books = book_issue::whereMonth('issue_date', date('m', strtotime($month)))
  //     ->whereYear('issue_date', date('Y', strtotime($month)))
  //     ->get();

  //   // Genera el PDF
  //   $pdf = PDF::loadView('report.pdf_month', ['books' => $books]);

  //   // Descargar el PDF
  //   return $pdf->download('ReporteMensual.pdf');
  // }
  public function pdf_month(Request $request)
  {
    // Obtén los libros según el mes
    $month = $request->input('month');
    $books = book_issue::whereMonth('issue_date', date('m', strtotime($month)))
      ->whereYear('issue_date', date('Y', strtotime($month)))
      ->get();

    // Genera el PDF
    $pdf = PDF::loadView('report.pdf_month', ['books' => $books]);

    // Retorna el PDF para que se muestre en el navegador
    return $pdf->setPaper('a4')->stream('ReporteMensual.pdf');
  }

  function pdf_not()
  {
    //$books = ['books' => book_issue::where('issue_status', 'LIKE', '%'. 'N' .'%')->latest()->get()];
    $pdf = Pdf::loadView('report.pdf_not', ['books' => book_issue::where('issue_status', 'LIKE', '%' . 'N' . '%')->latest()->get()]);
    return $pdf->setPaper('a4' . 'landscape')->stream();

    //return view('report.pdf_not',[
    //    'books' => book_issue::latest()->get()
    // ]);

    // $books = ['books' => book_issue::latest()->get()];
    //$pdf = Pdf::loadView('/report/pdf_not', compact('books'));
    // return $pdf->stream();

  }
}
