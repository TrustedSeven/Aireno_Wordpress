<?php
require('tcpdf/tcpdf.php');
require_once(ABSPATH . 'wp-load.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Aireno');
$pdf->SetTitle('Quotation');
$pdf->SetSubject('Quotation ');

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

$project_id = $_REQUEST['project_id'];
if (get_post($project_id)->post_type != AIRENO_CPT_PROJECT) {

} else {
    $editor = "";

    $businesses = get_field('business', $project_id);
    if (!is_array($businesses)) $businesses = array();
    $contractors = get_field('contractor', $project_id);
    if (!is_array($contractors)) $contractors = array();
    $businesses = array_merge($businesses, $contractors);

    if (count($businesses) > 0) {
        $business = $businesses[0];
        $business_data = aireno_get_userdata($business);

        $company = $business_data->company_name;
        $address = $business_data->address;
        $email = $business_data->email;
        $phone = $business_data->phone;
        $clogo = $business_data->business_logo;

        $editor .= '<table style="width:50%;">
                <tr><td>' . $company . '</td></tr>
                <tr><td>' . $address . '</td></tr>
                <tr><td>' . $email . '</td></tr>
                <tr><td>' . $phone . '</td></tr>
        </table>';

        $editor .= '<p>&nbsp;</p>';
    }

    $client_id = get_field('client', $project_id);
    if ($client_id) {
        $client_data = aireno_get_userdata($client_id);
        $total = get_field('total_price', $project_id);
        $total = round($total, 2);
        $total = number_format($total, 2, '.', '');

        $editor .= '<table>
                <tr><td><h2>' . get_the_title($project_id) . '</h2></td></tr>
                <tr><td><h3>Quote for: ' . $client_data->display_name . '</h3></td></tr>
                <tr><td>' . $client_data->email . '</td></tr>
                <tr><td>' . $client_data->phone . '</td></tr>
                <tr><td>' . $client_data->address . '</td></tr>
        </table>';

        $editor .= '<p>&nbsp;</p>';
    }

    $scopes = get_field('project_scopes', $project_id);
    if (!is_array($scopes))
        $scopes = array();

    $arrayNames = array();
    $refine_data = array();

    foreach ($scopes as $sS) {
        $scopeId = $sS;

        $scopeContent = get_post($scopeId)->post_content;
        $scopeDataDecoded = base64_decode($scopeContent);
        $sData = json_decode($scopeDataDecoded, true);

        $name = $sData['projectName'];

        $templateID = $sData['templateId'];

        if (have_rows('quote_fields', $templateID)) {
            while (have_rows('quote_fields', $templateID)) {
                the_row();
                $layout = get_row_layout();
                if ($layout == 'fields') {
                    $in_price = get_sub_field('in_price');
                    $slug = get_sub_field('slug');
                    while (have_rows('fields')) {
                        the_row();
                        $item_title = get_sub_field('title');
                        $item_slug = get_sub_field('slug');
                        $extra_count = intval($sData[$item_slug . '_multiple']);

                        if (is_array($sData[$slug]) && in_array($item_title, $sData[$slug]) && $item_slug) {
                            for ($i = 1; $i < $sData[$item_slug . '_count']; $i++) {
                                $c_key = 'category_' . $item_slug . '_' . $i;
                                if ($sData['default_' . $item_slug . '_' . $i] == 'true') {
                                    if (!array_key_exists($sData[$c_key], $refine_data)) {
                                        $refine_data[$sData[$c_key]] = array(
                                            'total_price' => 0,
                                            'items' => array()
                                        );
                                    }
                                    $item_price = ($in_price) ? $sData['price_' . $item_slug . '_' . $i] : 0;
                                    $item_price = str_replace('$', '', $item_price);
                                    $margin = ($in_price) ? $sData['margin_' . $item_slug . '_' . $i] : 0;
                                    $margin = str_replace('%', '', $margin);
                                    $refine_data[$sData[$c_key]]['total_price'] += floatval($item_price) * floatval($sData['quantity_' . $item_slug . '_' . $i]) * $extra_count * (1 + $margin / 100);
                                    $refine_data[$sData[$c_key]]['items'][] = array(
                                        'title' => $item_title,
                                        'price' => $item_price,
                                        'quantity' => $sData['quantity_' . $item_slug . '_' . $i],
                                        'quantity_type' => $sData['quantity_type_' . $item_slug . '_' . $i],
                                        'description' => $sData['description_' . $item_slug . '_' . $i],
                                        'scopeName' => get_post($scopeId)->post_title,
                                        'margin' => $margin,
                                        'extra_count' => $extra_count
                                    );
                                }
                            }
                        } else if ($item_title == $sData[$slug] && $item_slug) {
                            for ($i = 1; $i < $sData[$item_slug . '_count']; $i++) {
                                if ($sData['default_' . $item_slug . '_' . $i] == 'true') {
                                    $c_key = 'category_' . $item_slug . '_' . $i;
                                    if (!array_key_exists($sData[$c_key], $refine_data)) {
                                        $refine_data[$sData[$c_key]] = array(
                                            'total_price' => 0,
                                            'items' => array()
                                        );
                                    }
                                    $item_price = ($in_price) ? $sData['price_' . $item_slug . '_' . $i] : 0;
                                    $item_price = str_replace('$', '', $item_price);
                                    $margin = ($in_price) ? $sData['margin_' . $item_slug . '_' . $i] : 0;
                                    $margin = str_replace('%', '', $margin);
                                    $refine_data[$sData[$c_key]]['total_price'] += floatval($item_price) * floatval($sData['quantity_' . $item_slug . '_' . $i]) * $extra_count * (1 + $margin / 100);
                                    $refine_data[$sData[$c_key]]['items'][] = array(
                                        'title' => $item_title,
                                        'price' => $item_price,
                                        'quantity' => $sData['quantity_' . $item_slug . '_' . $i],
                                        'quantity_type' => $sData['quantity_type_' . $item_slug . '_' . $i],
                                        'description' => $sData['description_' . $item_slug . '_' . $i],
                                        'scopeName' => get_post($scopeId)->post_title,
                                        'margin' => $margin,
                                        'extra_count' => $extra_count
                                    );
                                }
                            }
                        }
                    }
                }
            }
        }

        $scopePrice = get_field('scope_price', $scopeId);
        $scopeTemplateId = get_field('scopeTemplate', $scopeId);
        $scopeTemplateFields = get_field('quote_fields', $scopeTemplateId);

        $customQuoteFieldTitle = $sData['customQuoteFieldTitle'];
        $customQuoteFieldTotal = $sData['customQuoteFieldTotalPrice'];

        $extra_count = 1;
        if (is_array($customQuoteFieldTitle))
            foreach ($customQuoteFieldTitle as $customFieldId => $title) {
                if (isset($sData['customQuoteFieldDescription' . $customFieldId]) && is_array($sData['customQuoteFieldDescription' . $customFieldId])) {
                    foreach ($sData['customQuoteFieldDescription' . $customFieldId] as $idx => $description) {
                        $defaults = $sData['customQuoteFieldIncluded' . $customFieldId];
                        $default = in_array($idx, $defaults);
                        $category = $sData['customQuoteFieldCategory' . $customFieldId][$idx];
                        $quantity = $sData['customQuoteFieldQuantity' . $customFieldId][$idx];
                        $quantity_type = $sData['customQuoteFieldQuantityType' . $customFieldId][$idx];
                        $price = $sData['customQuoteFieldPrices' . $customFieldId][$idx];
                        $margin = $sData['customQuoteFieldMargins' . $customFieldId][$idx];
                        if ($default && $category && $quantity && $price) {
                            if (!array_key_exists($category, $refine_data)) {
                                $refine_data[$category] = array(
                                    'total_price' => 0,
                                    'items' => array()
                                );
                            }
                            $refine_data[$category]['items'][] = array(
                                'title' => $title,
                                'description' => $description,
                                'price' => $price,
                                'quantity' => $quantity,
                                'quantity_type' => $quantity_type,
                                'scopeName' => get_post($scopeId)->post_title,
                                'margin' => $margin,
                                'extra_count' => $extra_count
                            );
                            $refine_data[$category]['total_price'] += floatval($price) * floatval($quantity) * (100 + $margin) / 100;
                        }
                    }
                }
            }
    }

    if (count($refine_data) > 0) {
        $editor .= '<table style="width:100%;">';
        foreach ($refine_data as $cat => $data) {
            if ($data['total_price'] > 0) {
                $print = "$" . number_format($data['total_price'], 2, '.', '');
                $editor .= '<tr><td colspan="2"><h3>'.get_term($cat)->name.'</h3></td></tr>';
            }
            else {
                $editor .= '<tr><td colspan="3"><h3>'.get_term($cat)->name.'</h3></td></tr>';
            }

            $scopeNames = array();
            foreach ($data['items'] as $item) {
                $scopeNames[] = $item['scopeName'];
            }
            $scopeNames = array_unique($scopeNames);
            $index = 1;
            foreach ($scopeNames as $name) {
                $refines = array(
                    'items' => array(),
                    'price' => 0
                );
                foreach ($data['items'] as $item) {
                    if ($item['scopeName'] == $name) {
                        $refines['items'][] = $item;
                        $refines['price'] += floatval($item['price']) * floatval($item['quantity']) * $item['extra_count'] * (1 + $item['margin'] / 100);
                    }
                }

                if ($refines['price'] > 0) {
                    $sub_print = "$" . number_format($refines['price'], 2, '.', '');
                    $editor .= '<tr><td colspan="2"><h4>&nbsp;&nbsp;&nbsp;'.$name.'</h4></td></tr>';
                }
                else {
                    $editor .= '<tr><td colspan="3"><h4>&nbsp;&nbsp;&nbsp;'.$name.'</h4></td></tr>';
                }

                foreach ($refines['items'] as $item) {

                    $item_description = $item['description'] . ' x ' . (floatval($item['quantity']) * $item['extra_count']) . ' (' . $item['quantity_type'] . ')';

                    $editor .= '<tr><td>'.$item_description.'</td>';

                    $price = floatval($item['price']) * floatval($item['quantity']) * $item['extra_count'] * (1 + $item['margin'] / 100);
                    if ($price > 0) {
                        $item_price = "$" . number_format($price, 2, '.', '');
                        $editor .= '<td style="text-align:right;">' . $item_price. '</td>';
                    }
                    $editor .= '</tr>';
                }
                $index++;
               $editor .= '<tr><td style="width: 100%; text-align:right; font-weight: bold; color: #a1a5b7">Sub total: ' . $sub_print. '</td></tr>';
            }
        }
        $editor .= '<tr><td style="text-align:right; font-size: 20px; font-weight: bold; color: #f1416c;">Grand Total: $' . $total . '</td></tr>';
        $editor .= '</table>';
    }

    // Set some content to print
    $html = <<<EOD
        <div style="text-align:left">
                <img src="{$clogo}" height="60px" width="auto" >
        </div>
        <br />
        {$editor}
        <br />
        EOD;

    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    // ---------------------------------------------------------

    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    ob_start();
    $pdf->Output('quote.pdf', 'I');
    ob_end_flush();
    //============================================================+
    // END OF FILE
    //============================================================+
}