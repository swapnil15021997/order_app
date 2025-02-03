@extends('app')

@section('content')
    <!-- Page header -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

            </div>
        </div>
        <div class="page-body">
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

                    <button type="button" class="btn btn-primary printMe" onclick="printDiv()">Print</button>

                </div>
                <div id="receipt_div" class="receipt max-w-[1140px] w-full relative border-[1px] border-[#a6a6a6] bg-white mx-auto overflow-hidden">
                    <div class="relative z-50 receipt-card">
                        <div class="grid grid-cols-2">
                            <div class="flex items-center px-4">
                                <img src="{{ asset('static/sonic-large.svg') }}" width="240" height="auto"
                                    alt="Tabler" />
                            </div>
                            @php
                                $firstTransaction = $transfer_array[0]['transactions'][0] ?? null;
                            @endphp
                            <div class="pb-5">
                                <div class="flex px-4 pt-3 text-2xl font-medium leading-none bg-neutral-200">
                                    <span class="pb-1 pe-2 border-r-2 border-black text-rose-950">Gold</span>
                                    <span class="pb-1 px-2 border-r-2 border-black text-rose-950">Silver</span>
                                    <span class="pb-1 px-2 border-r-2 border-black text-rose-950">Diamond</span>
                                    <span class="pb-1 ps-2 text-rose-950">Platinum</span>
                                </div>
                                <p class="px-4 py-2 text-rose-900"
                                    style="font-family: Times, 'Times New Roman', Georgia, serif; font-size:30px">
                                    Remarkable you, Today, Tomorrow</p>
                                <div class="flex flex-col gap-2">
                                    <p class="flex items-start gap-2 font-medium text-base">
                                        <span class="pt-1">
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
                                    <p class="flex items-start gap-2 font-medium text-base">
                                        <span class="pt-1">
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

                        <div class="border-y-[1px] border-[#a6a6a6]">
                            <div class="py-2 text-center border-b border-[#a6a6a6]">
                                <p class="text-lg font-bold">
                                    Transfer Receipt
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-0 border-b border-[#a6a6a6]">
                                <div class="p-2 border-r border-[#a6a6a6]">
                                    <p>
                                        <span class="font-semibold">Transfer From : </span>
                                        {{ $firstTransaction['from_branch_name'] }}
                                    </p>
                                    <p>
                                        <span class="font-semibold">Transfer To : </span>
                                        {{ $firstTransaction['to_branch_name'] }}
                                    </p>
                                </div>
                                <div class="grid grid-cols-2 gap-0">
                                    <div class="flex flex-col p-2 border-r border-[#a6a6a6]">
                                        <span>Order Date:</span>
                                        <span class="font-semibold">
                                            {{ $firstTransaction['orders'][0]['order_date'] }}
                                        </span>
                                    </div>

                                    <div class="flex flex-col p-2">
                                        <span>Order Type:</span>
                                        <span class="font-semibold">
                                            @if ($firstTransaction['orders'][0]['order_type'] == 1)
                                                Order
                                            @else
                                                Reparing
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-0 border-b border-[#a6a6a6]">
                                <div class="grid grid-cols-6 gap-0">
                                    <div class="col-span-1 p-2 font-bold border-r border-[#a6a6a6]">
                                        Sr. No
                                    </div>
                                    <div class="col-span-5 p-2 font-bold border-r border-[#a6a6a6]">
                                        Item Name
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/5 p-2 font-bold border-r border-[#a6a6a6]">
                                        Item Metal
                                    </div>
                                    <div class="w-1/5 p-2 font-bold border-r border-[#a6a6a6]">
                                        Item Melting
                                    </div>
                                    <div class="w-1/5 p-2 font-bold border-r border-[#a6a6a6]">
                                        Item Weight
                                    </div>
                                    <div class="w-1/5 p-2 font-bold border-r border-[#a6a6a6]">
                                        Item Colors
                                    </div>
                                    <div class="w-1/5 p-2 font-bold">
                                        QR Code
                                    </div>
                                </div>
                            </div>

                            @foreach ($transfer_array[0]['transactions'] as $index => $transaction)
                                <div class="grid grid-cols-2 gap-0">
                                    <div class="grid grid-cols-6 gap-0">
                                        <div class="col-span-1 font-medium p-2.5 border-r border-[#a6a6a6]">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="col-span-5 font-medium p-2.5 border-r border-[#a6a6a6]">
                                            {{ $transaction['items'][0]['item_name'] }}
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/5 font-medium p-2.5 border-r border-[#a6a6a6]">
                                            {{ $transaction['items'][0]['item_metal'] }}
                                        </div>
                                        <div class="w-1/5 font-medium p-2.5 border-r border-[#a6a6a6]">
                                            {{ $transaction['items'][0]['item_weight'] }}
                                        </div>
                                        <div class="w-1/5 font-medium p-2.5 border-r border-[#a6a6a6]">
                                            {{ $transaction['items'][0]['item_weight'] }}
                                        </div>
                                        <div class="w-1/5 font-medium p-2.5 border-r border-[#a6a6a6]">
                                            {{ $transaction['items'][0]['colors']['color_name'] }}
                                        </div>
                                        <div class="w-1/5 font-medium p-2.5">
                                            {{ $transaction['orders'][0]['order_qr_code'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @for ($i = count($transfer_array[0]['transactions']); $i < 10; $i++)
                                <div class="grid grid-cols-2 gap-0">
                                    <div class="grid grid-cols-6 gap-0">
                                        <div class="col-span-1 py-2.5 border-r border-[#a6a6a6]">
                                            <p>&nbsp;</p>
                                        </div>
                                        <div class="col-span-5 py-2.5 border-r border-[#a6a6a6]">
                                            <p>&nbsp;</p>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="w-1/5 py-2.5 border-r border-[#a6a6a6]">
                                            <p>&nbsp;</p>
                                        </div>
                                        <div class="w-1/5 py-2.5 border-r border-[#a6a6a6]">
                                            <p>&nbsp;</p>
                                        </div>
                                        <div class="w-1/5 py-2.5 border-r border-[#a6a6a6]">
                                            <p>&nbsp;</p>
                                        </div>
                                        <div class="w-1/5 py-2.5 border-r border-[#a6a6a6]">
                                            <p>&nbsp;</p>
                                        </div>
                                        <div class="w-1/5 py-2.5">
                                            <p>&nbsp;</p>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <div class="h-28 grid grid-cols-3 gap-0 items-end">
                            <div class="p-2 font-bold">
                                Manager Signatory
                            </div>
                            <div class="p-2 font-bold">
                                Customer Signatory
                            </div>
                            <div class="p-2 font-bold">
                                Salesman Signatory
                            </div>
                        </div>
                    </div>
                    <img src="{{ asset('static/sonic-icon.svg') }}" alt="Icon"
                        class="absolute -bottom-40 -right-[19rem] grayscale opacity-15">
                </div>
            </div>
        </div>
    </div>

    <script>
        function printDiv(type) {
            // $('#receipt_div').addClass('on-print');
            // var existingStyle = document.querySelector('style#customPrintStyle');
            // if (existingStyle) {
            //     document.head.removeChild(existingStyle);
            // }
            // if (type == "original") {
            //     $('#print_type').text("Original");
            // } else {
            //     $('#print_type').text("Duplicate");
            //     var style = document.createElement('style');
            //     style.id = "customPrintStyle";
            //     style.innerHTML = `
            //         @media print {
            //             #payment_info, #cust_details {
            //                 display: none !important;
            //             }


            //         }
            //     `;
            //     document.head.appendChild(style);
            // }
            var printContents = document.getElementsByClassName('receipt')[0].innerHTML;

            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();
            document.body.innerHTML = printContents;
            window.onafterprint = function () {
                console.log("Removing")
                // $('.container-xl').removeClass('on-print');
                document.body.innerHTML = originalContents;
            };

        }
    </script>
@endsection
