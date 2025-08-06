<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Transfer Receipt</title>
    <style>
        *{
            margin  : 0;
            padding:0;
            box-sizing: border-box;
        }
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
            padding: 4px 6px;
            vertical-align: top;
        }
        .border{
            border: 1px solid #000;
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
            text-align: center;
            position: absolute;
            left:50%;
            transform: translateX(-50%);
        }
        .header-info {
            font-size: 10px;
            color: #666;
            text-align: center;
            margin-top: -10px;
        }
        .no-border{
            border:none !important;
        }
        .text-right{
            text-align: right !important;
        }
        .item-table{
            border:1px solid #000;
        }
        .item-table tr{
            border-bottom : 1px solid #000;
        }
        .item-table td,
        .item-table th{
            border-right : 1px solid #000;
        }
        .border-c {
            border-style:solid;
            border-color:#000;
            border-width:0px;
        }
        .border-b {
            border-bottom-width:1px;
        }
         .border-t {
            border-top-width:1px;
        }
        .border-r {
            border-right-width:1px;
        }
          .border-l {
            border-left-width:1px;
        }
        .head{
            padding-bottom: 26px;
        }
        .section-first{
             border:1px solid #000;
                margin-bottom:14px;
                  display: table;
                  width: 100%;
        }
        .column-one,
        .column-two {
                  width: 50%;
              display: table-cell;
        }


                .column-one tr .hight{
                     min-height: 90px;
                    padding: 4px 6px;
                }

.column-two tr,
{
            width: 100%;
}

.column-two td .two-height{
                     min-height: 35px;
}

.column-two table tr:nth-last-child(1) td .two-height{
                     min-height: 80px;
}

        </style>
</head>
<body>
    <div class="head">
                    <div>
                        <div class="document-title">{{ $transfer_type }}</div>
                    </div>
                    <div>
                        <div class="header-info text-right">Printed on {{ date('d-M-y') }} at {{ date('H:i') }} <br /> (TRIPLICATE FOR CONSIGNER)</div>
                    </div>
    </div>

  <div class="section-first">
        <div class="column-one border-c border-r">
                <table width="100%" cellspacing="0" cellpadding="0">
        <tr class="border-c border-b">
            <div class="hight">
            <div class="font-bold">{{ $firstTransaction['from_branch_name'] }}</div>
            <div>{{ $firstTransaction['from_branch_address'] }}</div>
            </div>
        </tr>
            <tr>
            <div class="hight">
            <div>Buyer (Bill to)</div>
            <div class="font-bold">{{ $firstTransaction['to_branch_name'] }}</div>
            <div>{{ $firstTransaction['to_branch_address'] }}</div>
            <div><span>GSTIN/UIN:</span> 24ABICS3406J1ZD</div>
            <div><span>State Name:</span> Gujarat, Code: 24</div>
            </div>
        </tr>
            </table>
        </div>
     <div class="column-two">
  <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td class="border-c border-r border-b" width="50%">
        <div class="two-height">
            <div class="font-bold">Delivery Note No.</div>
            <div>{{ $transfer_array[0]['multiple_transfer_delivery_note'] }}</div>
        </div>
      </td>
      <td class="border-c border-b" width="50%">
        <div class="two-height">
        <div class="font-bold">Dated.</div>
        <div>{{ $firstTransaction['trans_date'] }}</div>
</div>
      </td>
    </tr>
    <tr>
        <td class="border-c border-r border-b">
        <div class="two-height">
</div>
      </td>
        <td class="border-c  border-b">
        <div class="two-height">
        <div class="font-bold">Mode/Terms of payment.</div>
</div>
      </td>
    </tr>
    <tr>
      <td class="border-c  border-r border-b">
        <div class="two-height">
        <div class="font-bold">Reference No. & Date.</div>
</div>
      </td>
       <td class="border-c border-b">
        <div class="two-height">
        <div class="font-bold">Other References</div>
</div>
      </td>
    </tr>
    <tr>
      <td class="border-c border-r border-b">
        <div class="two-height">
        <div class="font-bold">Buyer's Order No.</div>
</div>
      </td>
       <td class="border-c  border-b">
        <div class="two-height">
        <div class="font-bold">Dated.</div>
</div>
      </td>
    </tr>
    <tr>
      <td class="border-c border-r border-b">
        <div class="two-height">
        <div class="font-bold">Dispatch Doc No.</div>
</div>
      </td>
      <td class="border-c border-b">
        <div class="two-height"></div>
      </td>
    </tr>
    <tr>
      <td class="border-c border-r border-b">
        <div class="two-height">
        <div class="font-bold">Dispatch Through</div>
</div>
      </td>
      <td class="border-c border-b">
        <div class="two-height">
        <div class="font-bold">Destination</div>
</div>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div class="two-height">
        <div class="font-bold">Terms of Delivery</div>
</div>
      </td>
    </tr>
  </table>
</div>

    </div>

    
   
    <table width="100%" class="item-table" cellpadding="0" cellspacing="0">
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
                            {{ $item['item_name'] }}<br />
                            <span class="font-tiny">{{ $item['item_metal'] }}<br />1 Pcs ({{ $transaction['orders'][0]['order_number'] }})</span>
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
                <td></td>
                <td  class="font-bold">Total</td>
                <td></td>
                <td></td>
                <td class="text-center font-bold">{{ $total_weight }} GRM</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table class="border" width="100%" cellpadding="0" cellspacing="0">
        <tr >
            <td class="border-c border-r border-b">
                HSN/SAC
            </td >
            <td class="border-c border-r border-b">
                Taxable Value
            </td>
        </tr>
        @php
                        $hsn_sac = implode(',', array_unique($hsn_sac)); // comma-separated and unique values
                    @endphp
               
        <tr>
            <td class="border-c border-r border-b">

                {{$hsn_sac}}
            </td>
            <td class="border-c border-r border-b"></td>
        </tr>
        <tr>
            <td class="border-c border-r border-b">Total</td>
            <td class="border-c border-r border-b"></td>
        </tr>
    </table>

    <table class="border" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td class="w-50">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="font-bold ">Tax Amount (in words):</td>
                         
                    </tr>
                    <tr>
                        <td class="font-bold">Company's PAN: <span class="circled">ABDCS4503K</span> </td>
                       
                    </tr>
                  
                </table>
            </td>
           
        </tr>
         
    </table>

    <table width="100%" class="border" cellpadding="0" cellspacing="0">
        <tr>
            <td class="border-c border-r" width="50%">
                <div>
                    <div class="font-bold">Recd. in Good Condition</div>
                </div>
            </td>
            <td width="50%">
                <table>
                    <tr>
                    <td>
                        <div class="text-center font-bold">Prepared by</div>
                        <div></div>
                    </td>
                    <td>
                        <div class="text-center font-bold">Verified by</div>
                        <div></div>
                    </td>
                    <td>
                        <div class="text-center font-bold">Authorised Signatory</div>
                        <div></div>
                    </td>
                </tr>
                </table>
                </td>
                </tr>
            </table>

            <p class="computer-generated">
                This is a Computer Generated Document
</p>
</body>
</html> 