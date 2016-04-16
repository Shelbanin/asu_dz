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

    $tp_counter = 10;
    $row_counter = 0;
    $first_row = 68;
    $one_row = 7.3;
    $left_column = 11;
    $right_column = 24;
    $stamp_first_row = 265;
    $stamp_sec_row = 270;
    $stamp_left_col = 136;

    foreach ($tp_data as $oper_type => $opers_array) {
        $pdf->Text(
            $right_column,
            $first_row + round($row_counter * $one_row),
            $oper_type
        );
        $row_counter++;
        foreach ($opers_array as $oper) {
            $pdf->Text(
                $left_column,
                $first_row + round($row_counter * $one_row),
                $tp_counter
            );
            $pdf->Text(
                $right_column,
                $first_row + round($row_counter * $one_row),
                $oper
            );
            $tp_counter += 10;
            $row_counter++;
        }
    }

    $pdf->Text(
        $stamp_left_col,
        $stamp_first_row,
        $stamp_data['perf']
    );
    $pdf->Text(
        $stamp_left_col,
        $stamp_sec_row,
        $stamp_data['owner']
    );

    $pdf->Output();
}
?>