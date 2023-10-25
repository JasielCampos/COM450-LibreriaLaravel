<?php

namespace Tests\Unit;

use Barryvdh\DomPDF\PDF;
use Tests\TestCase;
use App\Http\Controllers\PDFController;
use Illuminate\Http\Request;
use Illuminate\View\View;


use Illuminate\Filesystem\Filesystem;

class PdfControllerTest extends TestCase
{
    public function testPdfMonthGeneratesResponse()
    {
        // Crea un objeto Request falso con el mes de prueba
        $month = '2023-05'; // Cambia esto al mes que desees
        $request = Request::create('/pdf_month', 'POST', ['month' => $month]);

        // Crea una instancia del controlador
        $pdfController = new PDFController();

        // Llama al método pdf_month
        $response = $pdfController->pdf_month($request);

        // Verifica que la respuesta sea una instancia de Illuminate\Http\Response
        $this->assertInstanceOf(\Illuminate\Http\Response::class, $response);

        // Verifica que el código de respuesta sea 200 (éxito)
        $this->assertEquals(200, $response->getStatusCode());

        // Puedes realizar otras verificaciones en la respuesta si es necesario
    }
    public function testPdfNotGeneratesResponse()
    {
        // Crea una instancia del controlador
        $pdfController = new PdfController();

        // Llama al método pdf_not
        $response = $pdfController->pdf_not();

        // Verifica que la respuesta sea una instancia de Illuminate\Http\Response
        $this->assertInstanceOf(\Illuminate\Http\Response::class, $response);

        // Verifica que el código de respuesta sea 200 (éxito)
        $this->assertEquals(200, $response->getStatusCode());

        // Puedes realizar otras verificaciones si es necesario
    }

}