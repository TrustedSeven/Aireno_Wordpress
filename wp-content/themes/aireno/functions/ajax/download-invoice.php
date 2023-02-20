<?php
require('tcpdf/tcpdf.php');
require_once(ABSPATH . 'wp-load.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Houseace');
$pdf->SetTitle('Online Quotation');
$pdf->SetSubject('Online Quotation ');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('helvetica', '', 12, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

$payment_id = $_REQUEST['payment_id'];
if (get_post($payment_id)->post_type == AIRENO_CPT_PAYMENT) {
    $sender = get_field('sender', $payment_id);
    $payment_user = get_field('payment_user', $payment_id);
    $amount = floatval(get_field('amount', $payment_id));
    $project_id = get_field('project_id', $payment_id);
    $title_quote = get_post($project_id)->post_title;
    $payment_userdata = aireno_get_userdata($payment_user);
    $sender_data = aireno_get_userdata($sender);
    $payment = get_post($payment_id);
    $amount_display = number_format($amount, 2);
    $gst = number_format($amount * 0.1, 2);
    $grand = number_format($amount, 2);

    // Set some content to print
    $html = <<<EOD
    <table width="100%">
            <tr style="vertical-align:top;">
                    <td width="50%">
                            <img src="{$sender_data->business_logo}" height="60px" >
                            <p>Company: {$sender_data->company_name}<br/>
                                    Address: {$sender_data->address}<br />
                                    E-mail:&nbsp;&nbsp;{$sender_data->email}<br />
                                    Phone:&nbsp;&nbsp;{$sender_data->phone}<br />
                                    ABN: {$sender_data->company_abn}
                            </p>
                    </td>
                    <td width="50%" style="vertical-align:top;">
                            <p style="text-align:right"><b>Invoice Info</b><br />#{$payment_id}</p>
                            <p style="text-align:right">To: <b>{$payment_userdata->display_name}</b>
                            <br />{$payment_userdata->address}<br />
                            E-mail:&nbsp;&nbsp;{$payment_userdata->email}<br />
                            Phone:&nbsp;&nbsp;{$payment_userdata->phone}
                            </p>
                    </td>
            </tr>
    </table>
    <p>&nbsp;</p>
    <p style="font-size:20px">Project: {$title_quote}</p>    
    <table width="100%" cellpadding="7">
            <thead>
                    <tr>
                            <th width="20%" style="border:1px solid black;">Title</th>
                            <th width="65%" style="border:1px solid black;">Description</th>
                            <th width="15%" style="border:1px solid black;">Unit Cost</th>
                    </tr>
            </thead>
            <tbody>
                    <tr>
                            <td width="20%" style="border:1px solid black; font-size:12px;">
                                {$payment->post_title}
                            </td>
                            <td width="65%" style="border:1px solid black; font-size:12px;">
                                    {$payment->post_content}
                            </td>
                            <td width="15%" style="border:1px solid black; font-size:12px;">
                                    $ {$amount_display}
                            </td>
                    </tr>
            </tbody>
    </table>
    <table width="100%">
        <tr>
            <td width="50%"></td>
            <td width="50%">
                <table width="100%" cellpadding="7">
                    <tr>
                        <td width="50%" style="border-bottom:solid 1px black;">GST(10%)</td>
                        <td width="50%" style="text-align:right;border-bottom:solid 1px black;">
                            $ {$gst}
                        </td>
                    </tr>
                    <tr>
                        <td width="50%" style="border-bottom:solid 1px black;">Grand Total</td>
                        <td width="50%" style="text-align:right;border-bottom:solid 1px black;">
                            $ {$grand}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <p>&nbsp;</p>
    <p><b>Payment Instructions</b><br />{$sender_data->payment_instructions}</p>
    EOD;

    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    // Close and output PDF document
    ob_start();
    $pdf->Output('invoice.pdf', 'I');
    ob_end_flush();
    //============================================================+
}
else {

}