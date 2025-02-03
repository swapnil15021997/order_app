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
            <div class="container-xl">
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
                <div id="receipt_div"
                    style="max-width: 1140px;width: 100%;position: relative;border: 1px solid #a6a6a6;background: white;margin: 0 auto;overflow: hidden;font-family: 'Manrope', serif">
                    <div style="position: relative;z-index: 50;font-family: Manrope, serif;">
                        <div style="display: grid;grid-template-columns:repeat(2, minmax(0, 1fr)); ">
                            <div style="display: flex;align-items: center;padding: 0 16px;">
                                <img src="{{ asset('static/sonic-large.svg') }}" width="240" height="auto"
                                    alt="Tabler" />
                            </div>
                            @php
                                $firstTransaction = $transfer_array[0]['transactions'][0] ?? null;
                            @endphp
                            <div style="padding-bottom: 20px">
                                <div
                                    style="display: flex;padding: 0px 16px;padding-top: 12px;font-size: 1.5rem;font-weight: 500;line-height: 1;background-color: #e5e5e5">
                                    <span
                                        style="padding-bottom: 4px;padding-right: 8px;border-right-width: 2px;border-color:#4c0519;color:#4c0519;">Gold</span>
                                    <span
                                        style="padding-bottom: 4px;padding: 0px 8px;border-right-width: 2px;border-color:#4c0519;color:#4c0519;">Silver</span>
                                    <span
                                        style="padding-bottom: 4px;padding: 0px 8px;border-right-width: 2px;border-color:#4c0519;color:#4c0519;">Diamond</span>
                                    <span style="padding-bottom: 4px;padding-left: 8px;color:#4c0519;">Platinum</span>
                                </div>
                                <p
                                    style="padding:8px 16px ;color:#881337 ;font-family: Times, 'Times New Roman', Georgia, serif; font-size:30px">
                                    Remarkable you, Today, Tomorrow</p>
                                <div style="display: flex;flex-direction: column;gap: 8px">
                                    <p
                                        style="display: flex;align-items: start;gap: 8px;font-weight: 500;font-size: 16px;margin: 0px">
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
                                    <p
                                        style="display: flex;align-items: start;gap: 8px;font-weight: 500;font-size: 16px;margin: 0px">
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

                        <div style="border-top:1px solid #a6a6a6;border-bottom: 1px solid #a6a6a6">
                            <div style="padding: 12px;text-align: center;border-bottom: 1px solid #a6a6a6">
                                <p style="font-size: 18px;font-weight: 700;line-height: 1;margin: 0px">
                                    Transfer Receipt
                                </p>
                            </div>

                            <div
                                style="display: grid;grid-template-columns: repeat(2, minmax(0, 1fr));gap: 0px;border-bottom: 1px solid #a6a6a6">
                                <div style="padding: 8px;border-right: 1px solid #a6a6a6">
                                    <p style="margin: 0px">
                                        <span style="font-weight: 600">Transfer From : </span>
                                        {{ $firstTransaction['from_branch_name'] }}
                                    </p>
                                    <p style="margin: 0px">
                                        <span style="font-weight: 600">Transfer To : </span>
                                        {{ $firstTransaction['to_branch_name'] }}
                                    </p>
                                </div>
                                <div style="display: grid;grid-template-columns: repeat(2, minmax(0, 1fr));gap: 0px;">
                                    <div
                                        style="display: flex;flex-direction: column;padding: 8px;border-right: 1px solid #a6a6a6">
                                        <span>Order Date:</span>
                                        <span style="font-weight: 600">
                                            {{ $firstTransaction['orders'][0]['order_date'] }}
                                        </span>
                                    </div>

                                    <div style="display: flex;flex-direction: column;padding: 8px;">
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

                            <div
                                style="display: grid;grid-template-columns: repeat(2, minmax(0, 1fr));gap: 0px;border-bottom: 1px solid #a6a6a6">
                                <div style="display: grid;grid-template-columns: repeat(6, minmax(0, 1fr));gap: 0px">
                                    <div
                                        style="grid-column: span 1 / span 1;padding: 8px;font-weight: 700;border-right: 1px solid #a6a6a6">
                                        Sr. No
                                    </div>
                                    <div
                                        style="grid-column: span 5 / span 5;padding: 8px;font-weight: 700;border-right: 1px solid #a6a6a6">
                                        Item Name
                                    </div>
                                </div>
                                <div style="display: flex">
                                    <div style="width: 20%;padding: 8px;font-weight: 700;border-right: 1px solid #a6a6a6">
                                        Item Metal
                                    </div>
                                    <div style="width: 20%;padding: 8px;font-weight: 700;border-right: 1px solid #a6a6a6">
                                        Item Melting
                                    </div>
                                    <div style="width: 20%;padding: 8px;font-weight: 700;border-right: 1px solid #a6a6a6">
                                        Item Weight
                                    </div>
                                    <div style="width: 20%;padding: 8px;font-weight: 700;border-right: 1px solid #a6a6a6">
                                        Item Colors
                                    </div>
                                    <div style="width: 20%;padding: 8px;font-weight: 700;">
                                        QR Code
                                    </div>
                                </div>
                            </div>

                            @foreach ($transfer_array[0]['transactions'] as $index => $transaction)
                                <div style="display: grid;grid-template-columns: repeat(2, minmax(0, 1fr));gap: 0px;">
                                    <div style="display: grid;grid-template-columns: repeat(6, minmax(0, 1fr));gap: 0px">
                                        <div
                                            style="grid-column: span 1 / span 1;padding: 10px;font-weight: 500;border-right: 1px solid #a6a6a6">
                                            {{ $index + 1 }}
                                        </div>
                                        <div
                                            style="grid-column: span 5 / span 5;padding: 10px;font-weight: 500;border-right: 1px solid #a6a6a6">
                                            {{ $transaction['items'][0]['item_name'] }}
                                        </div>
                                    </div>
                                    <div style="display: flex">
                                        <div
                                            style="width: 20%;padding: 10px;font-weight: 500;border-right: 1px solid #a6a6a6">
                                            {{ $transaction['items'][0]['item_metal'] }}
                                        </div>
                                        <div
                                            style="width: 20%;padding: 10px;font-weight: 500;border-right: 1px solid #a6a6a6">
                                            {{ $transaction['items'][0]['item_weight'] }}
                                        </div>
                                        <div
                                            style="width: 20%;padding: 10px;font-weight: 500;border-right: 1px solid #a6a6a6">
                                            {{ $transaction['items'][0]['item_weight'] }}
                                        </div>
                                        <div
                                            style="width: 20%;padding: 10px;font-weight: 500;border-right: 1px solid #a6a6a6">
                                            {{ $transaction['items'][0]['colors']['color_name'] }}
                                        </div>
                                        <div style="width: 20%;padding: 10px;font-weight: 500">
                                            {{ $transaction['orders'][0]['order_qr_code'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @for ($i = count($transfer_array[0]['transactions']); $i < 5; $i++)
                                <div style="display: grid;grid-template-columns: repeat(2, minmax(0, 1fr));gap: 0px;">
                                    <div style="display: grid;grid-template-columns: repeat(6, minmax(0, 1fr));gap: 0px">
                                        <div
                                            style="grid-column: span 1 / span 1;padding: 10px;border-right: 1px solid #a6a6a6">
                                            <p>&nbsp;</p>
                                        </div>
                                        <div
                                            style="grid-column: span 5 / span 5;padding: 10px;border-right: 1px solid #a6a6a6">
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

                        <div
                            style="height: 112px;display: grid;grid-template-columns: repeat(3, minmax(0, 1fr));gap: 0px;align-items: end">
                            <div style="padding: 8px;font-weight: 700">
                                Manager Signatory
                            </div>
                            <div style="padding: 8px;font-weight: 700">
                                Customer Signatory
                            </div>
                            <div style="padding: 8px;font-weight: 700">
                                Salesman Signatory
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('static/sonic-icon.svg') }}" alt="Icon"
                        style="position: absolute;bottom: -160px;right: -304px;opacity: 0.15;filter: grayscale(100%)">
                </div>
            </div>
        </div>
    </div>

    <script>
        function printDiv(type) {
            $('#receipt_div').addClass('on-print');
            var existingStyle = document.querySelector('style#customPrintStyle');
            if (existingStyle) {
                document.head.removeChild(existingStyle);
            }
            if (type == "original") {
                $('#print_type').text("Original");
            } else {
                $('#print_type').text("Duplicate");
                var style = document.createElement('style');
                style.id = "customPrintStyle";
                style.innerHTML = `
                @media print {
                    #payment_info, #cust_details {
                        display: none !important;
                    }


                }
            `;
                document.head.appendChild(style);
            }
            var printContents = document.getElementsByClassName('chalan')[0].innerHTML;

            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();
            document.body.innerHTML = printContents;
            window.onafterprint = function() {
                console.log("Removing")
                $('.container-xl').removeClass('on-print');
                document.body.innerHTML = originalContents;
            };

        }
    </script>
@endsection
