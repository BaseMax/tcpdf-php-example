<?php 
require_once __DIR__ . '/vendor/autoload.php';

$logoPath = __DIR__ . '/logo.jpg';

$html = <<<HTML
<style>
    body { font-family: 'Vazirmatn', sans-serif; }
    .header { text-align: center; margin-bottom: 20px; }
    .header img { width: 100px; }
    .header h1 { color: #2E86C1; font-size: 22px; margin: 5px 0; }
    .header p { font-size: 12px; margin: 0; color: #333; }
    .info { margin-bottom: 20px; }
    .info td { padding: 4px 8px; font-size: 14px; }
    .table thead { background-color: #2E86C1; color: #fff; }
    .table th, .table td {
        border: 1px solid #aaa;
        padding: 10px;
        text-align: center;
        font-size: 14px;
    }
    .total td {
        font-weight: bold;
        background-color: #f2f2f2;
    }
</style>

<div class="header">
    <img src="@LOGO@" alt="لوگو">
    <h1>صورتحساب فروش</h1>
    <p>کاشان، خیابان مدرس، پلاک ۲۳</p>
    <p>۰۳۱-۵۵۵۵۵۵۵۵</p>
</div>

<table class="info" style="width: 100%;">
    <tr>
        <td style="text-align: right;"><strong>تاریخ:</strong> ۱۴۰۳/۰۳/۱۳</td>
        <td style="text-align: left;"><strong>مشتری:</strong> علی رضایی</td>
    </tr>
</table>

<table class="table" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>کالا</th>
            <th>تعداد</th>
            <th>قیمت واحد</th>
            <th>جمع</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>کتاب ریاضی</td>
            <td>۲</td>
            <td>۵۰۰٬۰۰۰ ریال</td>
            <td>۱٬۰۰۰٬۰۰۰ ریال</td>
        </tr>
        <tr>
            <td>دفتر مشق</td>
            <td>۵</td>
            <td>۱۰۰٬۰۰۰ ریال</td>
            <td>۵۰۰٬۰۰۰ ریال</td>
        </tr>
    </tbody>
    <tfoot class="total">
        <tr>
            <td colspan="3" style="text-align: left;">مبلغ کل</td>
            <td>۱٬۵۰۰٬۰۰۰ ریال</td>
        </tr>
    </tfoot>
</table>
HTML;

$logoData = base64_encode(file_get_contents($logoPath));
$logoTag = 'data:image/png;base64,' . $logoData;
$html = str_replace('@LOGO@', $logoTag, $html);

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('YourAppName');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('صورتحساب فروش');
$pdf->setPrintHeader(false);
$pdf->SetSubject('Invoice');
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 10);

$pdf->AddPage();
$pdf->setRTL(true);

$fontDir = __DIR__ . '/fonts';
$regularFont = TCPDF_FONTS::addTTFfont("$fontDir/Vazirmatn-Regular.ttf", 'TrueTypeUnicode', '', 32);
$pdf->SetFont($regularFont, '', 12);

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output(__DIR__ . '/invoice.pdf', 'F');

echo "PDF created successfully: " . __DIR__ . '/invoice.pdf' . "\n";
