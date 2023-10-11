<?php

namespace App\Http\Controllers;

use App\Models\book_issue;
use App\Http\Requests\Storebook_issueRequest;
use App\Http\Requests\Updatebook_issueRequest;
use App\Models\auther;
use App\Models\book;
use App\Models\settings;
use App\Models\student;
use \Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class BookIssueController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('book.issueBooks', [
      'books' => book_issue::Paginate(5)
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('book.issueBook_add', [
      'students' => student::latest()->get(),
      'books' => book::where('status', 'Y')->get(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\Storebook_issueRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Storebook_issueRequest $request)
  {
    $issue_date =  date_create(date('Y-m-d H:i:s'));
    $return_date = date('Y-m-d H:i:s', strtotime("+" . (settings::latest()->first()->return_days) . " days"));
    $data = book_issue::create($request->validated() + [
      'student_id' => $request->student_id,
      'book_id' => $request->book_id,
      'issue_date' => $issue_date,
      'return_date' => $return_date,
      'issue_status' => 'N',
    ]);
    $data->save();
    $book = book::find($request->book_id);
    $book->status = 'N';
    $book->save();
    return redirect()->route('book_issued');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    // calculate the total fine  (total days * fine per day)
    $book = book_issue::where('id', $id)->get()->first();
    $first_date = date_create(date('Y-m-d H:i:s'));
    $last_date = date_create($book->return_date);
    $diff = date_diff($first_date, $last_date);
    $fine = (settings::latest()->first()->fine * $diff->format('%a'));
    return view('book.issueBook_edit', [
      'book' => $book,
      'fine' => $fine,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\Updatebook_issueRequest  $request
   * @param  \App\Models\book_issue  $book_issue
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    // dd($request->all());
    $book = book_issue::find($id);
    $book->issue_status = 'Y';
    $book->return_day = now();
    $book->save();
    $bookk = book::find($book->book_id);
    $bookk->status = 'Y';
    $bookk->save();
    return redirect()->route('book_issued');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\book_issue  $book_issue
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    book_issue::find($id)->delete();
    return redirect()->route('book_issued');
  }

  // public function generate_pdf()
  // {
  //   $books = book_issue::all();
  //   $pdf = PDF::loadView('book.generar_pdf', compact('books'));
  //   return $pdf->download('book_issue.pdf');
  // }

  public function generate_pdf()
  {
    $books = Book::all();

    // Load the view and pass data to it
    $data = ['book' => $books];
    $html = view('book.generar_pdf', $data)->render();

    $pdf = new Dompdf();
    $pdf->setOptions(new Options(['isPhpEnabled' => true]));
    $pdf->loadHtml($html);

    // (Optional) Set paper size and orientation
    $pdf->setPaper('A4', 'portrait');

    // Render PDF (first step: generate PDF content)
    $pdf->render();

    // Output generated PDF (second step: save it or stream it)
    return $pdf->stream('libros_prestados.pdf');
  }
}
