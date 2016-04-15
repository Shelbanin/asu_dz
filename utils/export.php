<?php
function generate_report($tp_data, $stamp_data) {
    $pdf = new FPDF();
    $pdf->Open();
    $pdf->SetTitle('order 1331');
    $pdf->SetAuthor($_SESSION['user']['acc_login']);
    $pdf->AddFont(
        'TimesNewRomanPSMT',
        '',
        '5eaaf5b2054a9ced24525c8fbe3bebfa_times.php'
    );
    $pdf->AddPage();
    $pdf->Image('static/report/map.png', 0, 0, 210, 297);
    $pdf->SetFont('TimesNewRomanPSMT', '', 14);


    for ($i = 0; $i < 10; $i++) {
        $pdf->Text(11, 68 + round($i * 7.3), "реяр");
    }

    $pdf->Output();
}
?>