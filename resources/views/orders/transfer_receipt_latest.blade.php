@extends('app')

@section('content')
 
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transfers</li>
                    </ol>
                </nav>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <button type="button" class="btn btn-primary printMe" onclick="printDiv()">
                    Print
                </button>
            </div>
        </div>
    </div>
    <div class="page-body chalan">
        <!-- <div class="container-xl" id="transfer_receipt_div"> -->
        <div class="page-container">
    <div class="card p-4">
        @php
            $firstTransaction = $transfer_array[0]['transactions'][0] ?? null;
        @endphp
        <div class="text-center">
            <h2 id="document_title">Issue for Hallmarking</h2>
            <div class="text-muted">Printed on 12-Jul-25 at 10:17 (TRIPLICATE FOR CONSIGNER)</div>
        </div>
        <hr>

        <table class="table table-bordered w-100">
            <tr>
                <td class="align-top w-50">
                    
                    {{$firstTransaction['from_branch_name']}}
                    <br><br>
                    <br>
                    <!-- SONIC HALLMARK PRIVATE LIMITED<br>
                    40, AABHUSHAN COMPLEX<br>
                    SONI BAZAR RAJKOT<br>
                    GSTIN/UIN: 24ABICS3406J1ZD<br>
                    State Name: Gujarat, Code: 24 -->
                    {{$firstTransaction['to_branch_name']}}
                </td>
                <td class="align-top w-50">
                    <table class="table table-bordered table-sm ">
                        <tr>
                            <td><strong>Delivery Note No.:</strong></td>
                            <td><strong>Dated:</strong>
                            <br>
                            {{$firstTransaction['trans_date']}}
                            </td>
                           
                        </tr>
                       
                        <tr>
                            <td><strong>Reference No. & Date:</strong></td>
                            <td>Other References</td>
                        </tr>
                        <tr>
                            <td><strong>Buyer's Order No.:</strong></td>
                            <td><strong>Dated:</strong></td>
                            
                        </tr>
                      
                        <tr>
                            <td><strong>Dispatch Doc No.:</strong></td>
                            <td>Destination</td>
                        </tr>
                        
                        <tr>
                            <td><strong>Terms of Delivery:</strong></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>Sl No.</th>
                        <th>Description of Goods</th>
                        <th>HSN/SAC</th>
                        <th>Gross Weight</th>
                        <th>Quantity</th>
                        <th>Rate</th>
                        <th>per</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $total_weight = 0;
                    @endphp
                @foreach ($transfer_array[0]['transactions'] as $index => $transaction)
                    @foreach($transaction['items'] as $item)
                    @php
                        $total_weight += $item['item_weight'];
                    @endphp
                    <tr>
                        <td>1</td>
                        <td>{{$item['item_name']}}<br><small>{{$item['item_metal']}}<br>1 Pcs</small></td>
                        <td contenteditable="true" id="hsn_sac_1">711319</td>
                        <td>{{$item['item_weight']}} GRM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                    
                @endforeach
                    <!-- <tr>
                        <td>2</td>
                        <td>Gold Mix Ornaments 22 Ct<br><small>Gold Mix Chain<br>1 Pcs</small></td>
                        <td contenteditable="true" id="hsn_sac_2">711319</td>
                        <td>10.390 GRM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Gold Mix Ornaments 22 Ct<br><small>Gold Mix Kansar<br>1 Pair</small></td>
                        <td contenteditable="true" id="hsn_sac_3">711319</td>
                        <td>2.650 GRM</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr> -->
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td><strong>{{$total_weight}} GRM</strong></td>
                        <td colspan="4"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <div class="row">
                <div class="col-md-10">
                    <strong>HSN/SAC:</strong> <span contenteditable="true" id="main_hsn_sac">711319</span><br>
                </div>
            <!-- <strong>HSN/SAC:</strong> <span contenteditable="true" id="main_hsn_sac">711319</span><br> -->
                <div class="col-md-2">
                    <strong>Taxable Value:</strong> NIL
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                               
            </div>
        </div>
        <div class="row mt-4">
            
            <div class="col-md-6">
                <strong>Company's PAN:</strong> ABDCS4503K<br>
               
            </div>
           
        </div>
        <div class="row mt-4 border-top border-left border-right border-bottom">
            <div class="col-md-6">
                <table class="table  mb-0">
                    <tr>
                    <strong>Recd. in Good Condition</strong>
                    </tr>
                   
                </table>
            </div>
            <div class="col-md-6">
                <table class="table mb-0">
                    <tr>
                        <td class="text-center">Prepared By</td>
                        <td class="text-center">Verified By</td>
                        <td class="text-center">Authorised Signatory</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="text-center text-muted mt-4">
            This is a Computer Generated Document
        </div>
    </div>
</div>
            
    </div>
</div>

<script>
function printDiv() {
    var printContents = document.getElementById('transfer_receipt_div').innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}

// Update document title based on selection
document.getElementById('document_type').addEventListener('change', function() {
    var title = document.getElementById('document_title');
    if (this.value === 'hallmarking') {
        title.textContent = 'Issue for Hallmarking';
    } else if (this.value === 'kariger') {
        title.textContent = 'Issue for Kariger';
    }
});

// Update HSN/SAC across all rows when main HSN/SAC is changed
document.getElementById('main_hsn_sac').addEventListener('input', function() {
    var hsnValue = this.textContent;
    document.getElementById('hsn_sac_1').textContent = hsnValue;
    document.getElementById('hsn_sac_2').textContent = hsnValue;
    document.getElementById('hsn_sac_3').textContent = hsnValue;
    document.getElementById('total_hsn_sac').textContent = hsnValue;
});

// Make all HSN/SAC cells editable and sync
document.querySelectorAll('[id^="hsn_sac_"]').forEach(function(element) {
    element.addEventListener('input', function() {
        var hsnValue = this.textContent;
        document.getElementById('main_hsn_sac').textContent = hsnValue;
        document.getElementById('total_hsn_sac').textContent = hsnValue;
        // Update other HSN/SAC cells
        document.querySelectorAll('[id^="hsn_sac_"]').forEach(function(el) {
            if (el !== this) {
                el.textContent = hsnValue;
            }
        });
    });
});
</script>

@endsection