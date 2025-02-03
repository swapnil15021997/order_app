@extends('app')

@section('content')
<!-- Page header -->
<style>
    .receipt-card {
        font-family: "Manrope", serif;
    }
</style>
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <!-- <div class="page-pretitle">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                Overview
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div> -->
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
        <div class="container-xl" id="transfer_receipt_div">
            <div id="alert-container"></div>
            <div class="container">
                <div id="alert-site"></div>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-success" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
            </div>



            <div class="transfers-chalan-container">
                <div class="chalan-container">
                    <div class="chalan-head">
                        <div class="chalan-hed-img">
                            <img src="{{ asset('static/sonic-large.svg') }}" width="240" height="auto" alt="Tabler" />
                        </div>
                        @php
                            $firstTransaction = $transfer_array[0]['transactions'][0] ?? null;
                        @endphp
                        <div class="chalan-hed-content">
                            <div class="chalan-hed-content-tag-line">
                                <span>Gold</span>
                                <span>Silver</span>
                                <span>Diamond</span>
                                <span>Platinum</span>
                            </div>
                            <p class="chalan-hed-content-tag">
                                Remarkable you, Today, Tomorrow</p>
                            <div class="chalan-hed-content-location-list">
                                <p>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                            <path
                                                d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                            <path
                                                d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                        </svg>
                                    </span>
                                    Shop No.: 112-119, Shree Laxmi Narayan Dev Complex </br>
                                    Palace Road - Rajkot | Mo.: 9815180980
                                </p>
                                <p>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                            <path
                                                d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10" />
                                            <path
                                                d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                        </svg>
                                    </span>
                                    Haveli Street, Savarkundala, Dist. Amreli | Mo.: 6354109408
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="chalan-body">
                        <div class="chalan-body-head">
                            <p>
                                Transfer Receipt
                            </p>
                        </div>

                        <div class="chalan-table-header">
                            <div class="chalan-table-header-first">
                                <p>
                                    <span>Transfer From : </span>
                                    {{ $firstTransaction['from_branch_name'] }}
                                </p>
                                <p>
                                    <span>Transfer To : </span>
                                    {{ $firstTransaction['to_branch_name'] }}
                                </p>
                            </div>
                            <div class="chalan-table-header-second">
                                <div class="chalan-table-header-second-first">
                                    <span>Order Date:</span>
                                    <span style="font-weight: 600">
                                        {{ $firstTransaction['orders'][0]['order_date'] }}
                                    </span>
                                </div>

                                <div class="chalan-table-header-second-second">
                                    <span>Order Type:</span>
                                    <span style="font-weight: 600">
                                        @if ($firstTransaction['orders'][0]['order_type'] == 1)
                                            Order
                                        @else
                                            Reparing
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="table-colume head">
                            <div class="table-first-list">
                                <div class="table-first">
                                    Sr. No
                                </div>
                                <div class="table-second">
                                    Item Name
                                </div>
                            </div>
                            <div style="display: flex">
                                <div class="table-col">
                                    Item Metal
                                </div>
                                <div class="table-col">
                                    Item Melting
                                </div>
                                <div class="table-col">
                                    Item Weight
                                </div>
                                <div class="table-col">
                                    Item Colors
                                </div>
                                <div class="table-col">
                                    QR Code
                                </div>
                            </div>
                        </div>

                        @foreach ($transfer_array[0]['transactions'] as $index => $transaction)
                            <div class="table-colume">
                                <div class="table-first-list">
                                    <div class="table-first-second-first">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="table-first-second-second">
                                        {{ $transaction['items'][0]['item_name'] }}
                                    </div>
                                </div>
                                <div style="display: flex">
                                    <div class="table-col">
                                        {{ $transaction['items'][0]['item_metal'] }}
                                    </div>
                                    <div class="table-col">
                                        {{ $transaction['items'][0]['item_weight'] }}
                                    </div>
                                    <div class="table-col">
                                        {{ $transaction['items'][0]['item_weight'] }}
                                    </div>
                                    <div class="table-col">
                                        {{ $transaction['items'][0]['colors']['color_name'] }}
                                    </div>
                                    <div class="table-col">
                                        {{ $transaction['orders'][0]['order_qr_code'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @for ($i = count($transfer_array[0]['transactions']); $i < 5; $i++)
                            <div style="display: grid;grid-template-columns: repeat(2, minmax(0, 1fr));gap: 0px;">
                                <div style="display: grid;grid-template-columns: repeat(6, minmax(0, 1fr));gap: 0px">
                                    <div style="grid-column: span 1 / span 1;padding: 10px;border-right: 1px solid #a6a6a6">
                                        <p>&nbsp;</p>
                                    </div>
                                    <div style="grid-column: span 5 / span 5;padding: 10px;border-right: 1px solid #a6a6a6">
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                                <div style="display: flex">
                                    <div style="width: 20%;padding: 10px;border-right: 1px solid #a6a6a6">
                                        <p>&nbsp;</p>
                                    </div>
                                    <div style="width: 20%;padding: 10px;border-right: 1px solid #a6a6a6">
                                        <p>&nbsp;</p>
                                    </div>
                                    <div style="width: 20%;padding: 10px;border-right: 1px solid #a6a6a6">
                                        <p>&nbsp;</p>
                                    </div>
                                    <div style="width: 20%;padding: 10px;border-right: 1px solid #a6a6a6">
                                        <p>&nbsp;</p>
                                    </div>
                                    <div style="width: 20%;padding: 10px">
                                        <p>&nbsp;</p>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div class="chalan-footer">
                        <div>
                            Manager Signatory
                        </div>
                        <div>
                            Customer Signatory
                        </div>
                        <div>
                            Salesman Signatory
                        </div>
                    </div>
                </div>
                <img src="{{ asset('static/sonic-icon.svg') }}" alt="Icon" class="bg-image-chalan">
            </div>

        </div>
    </div>




    <script>
        function printDiv(type) {
            $('#transfer_receipt_div').addClass('on-print-receipt');

            var printContents = document.getElementsByClassName('chalan')[0].innerHTML;

            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();
            document.body.innerHTML = printContents;
            window.onafterprint = function () {
                console.log("Removing")
                $('.container-xl').removeClass('on-print-receipt');
                document.body.innerHTML = originalContents;
            };

        }
    </script>
    @endsection
