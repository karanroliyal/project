<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice PDF</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

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
        .mt-3{
            margin-top: -5px;
        }
    </style>

</head>

<body>


    <table class="logo-with-invoice-num">

        <tbody>
            <tr>
                <td><img class="logo" src="assets/images/logo.png" alt=""></td>
                <td>
                    <h1 class="big">INVOICE</h1>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="invoice_num"># INV0123</td>
            </tr>
        </tbody>

    </table>


    <h3>Name: <span class="values">Karan</span></h3>
    <h3 class="mt-3" >Address: <span class="values">322-B , shakti khand-1 , indirapuram</span></h3>
    <h3 class="mt-3" >Date: <span class="values">2025-01-12</span></h3>
    <h3 class="mt-3" >Client ID: <span class="values">65</span></h3>





    <table style="width: 100%;">
            <tr>
                <th><p></p>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
    </table>


</body>

</html>