<?php

include_once 'assets/backend/connection.php';


$sql = "SELECT * FROM invoice_master im
        JOIN client_master cm 
        ON im.client_id = cm.id WHERE im.invoice_id = {$_GET['my_id']};";




$result = $conn->query($sql);



$html = "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Invoice PDF</title>
    <link rel='stylesheet' href='assets/css/bootstrap.min.css'>

    <style>
        .logo-with-invoice-num {

            html,
            body {
                margin: 0px;
                padding: 0px;
            }

            .logo {
                width: 50%;
            }

            .big {
                margin-top: -50px;
                padding: 0px;
            }

            .invoice_num {
                margin-top: -120px;
                font-size: large;
                color: #585858;
            }

        }

        .p-0 {
            padding: 0px;
        }

        .m-0 {
            margin: 0px;
        }

        .values {
            margin-top: -0px;
            font-size: 20px;
            color: #585858;
            margin-left: 3px;
            word-break: break-word;
        }

        .items-table {
            width: 100%;
        }

        .tr {
            background-color: black;
            color: white;
        }

        .th {
            padding-left: 10px;
        }

        .text-center {
            text-align: center;
        }

        .mt-2 {
            margin-top: 20px;
        }

        .mt-3 {
            margin-top: 30px;
        }

        .mt--3 {
            margin-top: -30px;
        }

        .ml {
            margin-left: 500px;
        }
    </style>

</head>

<body>


    <table class='logo-with-invoice-num'>

        <tbody>
            <tr>
                <td><img class='logo' src='assets/images/logo.png' alt=''></td>
                <td>
                    <h1 class='big'>INVOICE</h1>
                </td>
            </tr>
           ";

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()){

        $html .= " <tr>
                <td></td>
                <td class='invoice_num'># {$row['invoice_number']}</td>
            </tr>
        </tbody>

    </table>
        <h3>Name: <span class='values'>{$row['NAME']}</span></h3>
                <h3 class='mt-2'>Address: <span class='values'>{$row['address']}</span></h3>
                <h3 class='mt-2'>Date: <span class='values'>{$row['invoice_date']}</span></h3>
                <h3 class='mt-2'>Client ID: <span class='values'>{$row['id']}</span></h3>";


                $html .= "<hr>
                <table class='items-table mt-3'>
                    <tr class='tr'>
                        <th class='th' style='width: 40%;'>
                            <h3>Item</h3>
                        </th>
                        <th class='th text-center' style='width: 20%;'>
                            <h3>Quantity</h3>
                        </th>
                        <th class='th text-center' style='width: 20%;'>
                            <h3>Price</h3>
                        </th>
                        <th class='th text-center' style='width: 20%;'>
                            <h3>Amount</h3>
                        </th>
                    </tr>";


                    $sql2 = "SELECT * FROM 
                            invoice i 
                            JOIN item_master im
                            ON i.item_id = im.id
                            WHERE i.invoice_id = {$_GET['my_id']};";

                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                    
                        while ($row1 = $result2->fetch_assoc()) {
                        
                            $html .= "<tr>
                        <td>
                            <h4>{$row1['item_name']}</h4>
                        </td>
                        <td>
                            <h4 class='text-center'>{$row1['quantity']}</h4>
                        </td>
                        <td>
                            <h4 class='text-center'>₹{$row1['item_price']}</h4>
                        </td>
                        <td>
                            <h4 class='text-center'>₹{$row1['amount']}</h4>
                        </td>
                            </tr>";
                        }
                    
                    
                    }
            $html .= " </table> <hr>

            <div style='margin-left: 550px;'>
                <h4>Subtotal: <span>₹{$row['total_amount']}</span></h4>
                <h4>TAX(0%): <span>₹0.00</span></h4>
                <h4>Total: <span>₹{$row['total_amount']}</span></h4>
                            
            </div>
            </body>
            </html>";
        }
}





$font = 'dejavusans';

$content = <<<EOT
<page>
<h1>$font</h1>
\xE2\x9C\x9D U+271D LATIN CROSS
</page>
EOT;

require __DIR__ . '/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;


$html2pdf = new Html2Pdf();
$html2pdf->setDefaultFont($font);
ob_start();
$html2pdf->writeHTML($html);
$file = time() . '.pdf';
$html2pdf->output($file);
