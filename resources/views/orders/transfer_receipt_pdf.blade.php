<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Transfer Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
            color: #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        td, th {
            border: 1px solid #000;
            padding: 4px 6px;
            vertical-align: top;
        }
        .text-center {
            text-align: center;
        }
        .text-left {
            text-align: left;
        }
        .font-bold {
            font-weight: bold;
        }
        .font-small {
            font-size: 10px;
        }
        .font-tiny {
            font-size: 9px;
        }
        .bg-gray {
            background-color: #f0f0f0;
        }
        .handwritten {
            font-style: italic;
            color: #0066cc;
        }
        .circled {
            border: 2px solid #0066cc;
            padding: 2px 6px;
        }
        .arrow {
            color: #0066cc;
            font-weight: bold;
        }
        .star {
            color: #0066cc;
            font-size: 14px;
        }
        .total-row {
            font-weight: bold;
            background-color: #f0f0f0;
        }
        .signature-cell {
            height: 60px;
            vertical-align: bottom;
            text-align: center;
        }
        .computer-generated {
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .document-title {
            font-size: 18px;
            font-weight: bold;
            border: 2px solid #000;
            padding: 8px;
            text-align: center;
        }
        .header-info {
            font-size: 10px;
            color: #666;
            text-align: center;
        }
        .w-50 {
            width: 50%;
        }
        .w-25 {
            width: 25%;
        }
        .w-33 {
            width: 33.33%;
        }
    </style>
</head>
<body>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="document-title">{{ $transfer_type }}</td>
                    </tr>
                    <tr>
                        <td class="header-info">Printed on {{ date('d-M-y') }} at {{ date('H:i') }} (TRIPLICATE FOR CONSIGNER)</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="w-50">
                <table width="100%" cellpadding="0" cellspacing="0">
                    
                    
                    <tr>
                        <td class="font-bold">{{ $firstTransaction['from_branch_name'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $firstTransaction['from_branch_address'] }}</td>
                    </tr>
                    <tr><td><br></td></tr>
                    <tr><td><br></td></tr>
                  
                    
                    <tr>
                        <td class="font-bold">Buyer (Bill to)</td>
                    </tr>
                    <tr>
                        <td class="font-bold">{{ $firstTransaction['to_branch_name'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $firstTransaction['to_branch_address'] }}</td>
                    </tr>
                    <tr>
                        <td>GSTIN/UIN: 24ABICS3406J1ZD</td>
                    </tr>
                    <tr>
                        <td>State Name: Gujarat, Code: 24</td>
                    </tr>
                    
                </table>
            </td>
            <td class="w-50">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="font-bold">Delivery Note No.:</td>
                        <td class="font-bold">Dated:</td>
                    </tr>
                    <tr>
                        <td>
                             {{ $transfer_array[0]['multiple_transfer_delivery_note'] }}<br>
                        
                        </td>
                        <td>{{ $firstTransaction['trans_date'] }}</td>
                    </tr>
                    <tr>
                        <td class="font-bold">Reference No. & Date:
                            <br><br>
                        </td>
                        <td class="font-bold">Other References</td>
                    </tr>
                   
                    <tr>
                        <td class="font-bold">Buyer's Order No.:
                        <br><br>
                        </td>
                        <td class="font-bold">Dated:</td>
                    </tr>
                     
                    <tr>
                        <td class="font-bold">Dispatch Doc No.:

                        <br><br>
                        </td>
                        <td class="font-bold">Destination
 
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="font-bold">Terms of Delivery:
                        <br><br>
                        </td>
                        <td></td>
                    </tr>
                   
                </table>
            </td>
        </tr>
    </table>

    <table width="100%" cellpadding="0" cellspacing="0">
        <thead>
            <tr class="bg-gray">
                <th class="text-center">SI No.</th>
                <th class="text-center">Description of Goods</th>
                <th class="text-center">HSN/SAC</th>
                <th class="text-center">Gross Weight</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Rate</th>
                <th class="text-center">per</th>
                <th class="text-center">Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_weight = 0;
                $hsn_sac = [];
                $index = 0;
            @endphp
            @foreach ($transfer_array[0]['transactions'] as $index => $transaction)
                @foreach($transaction['items'] as $item)
                    @php
                        $total_weight += $item['item_weight'];
                        $hsn_sac[] = $item['item_hsn_number'];
                        $index++;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $index }}</td>
                        <td class="text-left">
                            {{ $item['item_name'] }}<br>
                            <span class="font-tiny">{{ $item['item_metal'] }}<br>1 Pcs ({{ $transaction['orders'][0]['order_number'] }})</span>
                        </td>
                        <td class="text-center">{{ $item['item_hsn_number'] }}</td>
                        <td class="text-center">{{ $item['item_weight'] }} GRM</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>
                @endforeach
            @endforeach
            <tr class="total-row">
                <td colspan="3" class="font-bold">Total</td>
                <td class="text-center font-bold">{{ $total_weight }} GRM</td>
                <td colspan="4"></td>
            </tr>
        </tbody>
    </table>

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="w-50">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="font-bold">Tax Amount (in words):</td>
                         
                    </tr>
                    <tr>
                        <td class="font-bold">Company's PAN: <span class="circled">ABDCS4503K</span> </td>
                       
                    </tr>
                  
                </table>
            </td>
           
        </tr>
         
    </table>
    <table width="100%" cellpadding="0" cellspacing="0">

                
                <tr>
                    <td class="font-bold">Recd. in Good Condition</td>
                     
                    <td class="text-center font-bold">Prepared by</td>
                    <td class="text-center font-bold">Verified by</td>
                    <td class="text-center font-bold">Authorised Signatory</td>
                </tr>
                <tr>
                    <td class="font-bold"></td>
                   
                    <td class="text-center">
                        <div class="arrow">↓</div>
                        <div style="margin-top: 20px;">H.P.Koner</div>
                    </td>
                    <td class="text-center">
                        <div class="arrow">→</div>
                        <div style="margin-top: 20px;">BM</div>
                    </td>
                    <td class="text-center">
                        <div class="star">★</div>
                        <div style="margin-top: 20px;">[Signature]</div>
                    </td>
                </tr>
            </table>

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="computer-generated">
                This is a Computer Generated Document
            </td>
        </tr>
    </table>
</body>
</html> 