<?php
require_once __DIR__ . '/vendor/autoload.php';

use TCPDF;

$html = <<<HTML
<h1 style="color:#2E86C1; font-size:24px;">صورتحساب فروش</h1>
<p><strong>تاریخ:</strong> ۱۴۰۳/۰۳/۱۳</p>
<p><strong>مشتری:</strong> علی رضایی</p>

<table style="width:100%; border-collapse:collapse; font-size:15px;">
    <thead>
        <tr>
            <th style="border:1px solid #aaa; padding:10px;">کالا</th>
            <th style="border:1px solid #aaa; padding:10px;">تعداد</th>
            <th style="border:1px solid #aaa; padding:10px;">قیمت واحد</th>
            <th style="border:1px solid #aaa; padding:10px;">جمع</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="border:1px solid #aaa; padding:10px;">کتاب ریاضی</td>
            <td style="border:1px solid #aaa; padding:10px;">۲</td>
            <td style="border:1px solid #aaa; padding:10px;">۵۰۰٬۰۰۰ ریال</td>
            <td style="border:1px solid #aaa; padding:10px;">۱٬۰۰۰٬۰۰۰ ریال</td>
        </tr>
        <tr>
            <td style="border:1px solid #aaa; padding:10px;">دفتر مشق</td>
            <td style="border:1px solid #aaa; padding:10px;">۵</td>
            <td style="border:1px solid #aaa; padding:10px;">۱۰۰٬۰۰۰ ریال</td>
            <td style="border:1px solid #aaa; padding:10px;">۵۰۰٬۰۰۰ ریال</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" style="border:1px solid #aaa; padding:10px; text-align:left; font-weight:bold;">مبلغ کل</td>
            <td style="border:1px solid #aaa; padding:10px; font-weight:bold;">۱٬۵۰۰٬۰۰۰ ریال</td>
        </tr>
    </tfoot>
</table>
HTML;

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

$pdf->SetCreator('YourAppName');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('صورتحساب فروش');
$pdf->SetSubject('Invoice');

$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 10);

$pdf->AddPage();

$pdf->setRTL(true);

$fontDir = __DIR__ . '/fonts';

$regularFont = TCPDF_FONTS::addTTFfont("$fontDir/Vazirmatn-Regular.ttf", 'TrueTypeUnicode', '', 32);
$boldFont = TCPDF_FONTS::addTTFfont("$fontDir/Vazirmatn-Bold.ttf", 'TrueTypeUnicode', '', 32);

$pdf->SetFont($regularFont, '', 12);

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output(__DIR__ . '/invoice.pdf', 'F');

echo "PDF created successfully: " . __DIR__ . '/invoice.pdf' . "\n";
