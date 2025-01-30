@extends('app')

@section('content')
<!-- Page header -->
 <style>
    .receipt-card{
        font-family: "Manrope", serif;
        width: 100%;
        background-color: white;
        max-width: 1140px;
        margin: auto;
        border: 1px solid #a6a6a6;
        color: #212121;

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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-success" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

            </div>
            <div class="receipt-card">
            
                <div class="row">
                    <div class="col-md-6 pt-6 px-4">
                        <img src="{{ asset('static/sonic-large.svg')}}" width="240" height="auto" alt="Tabler" />
                    </div>
                    @php
                            $firstTransaction = $transfer_array[0]['transactions'][0] ?? null;
                    @endphp
                    <div class="col-md-6 pt-2">
                        <p style="font-family: Times, 'Times New Roman', Georgia, serif; font-size:30px"> Remarkable you, Today, Tomorrow</p>
                        <p class="text-red"> 
                        <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                        </svg>
                        </span>    
                        Shop No.: 112-119, Shree Laxmi Narayan Dev Complex </br> 
                        Palace Road - Rajkot | Mo.: 9815180980
                        </p>
                        <p  class="text-red">
                        <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                            <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                            <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                        </svg>
                        </span>    
                        Haveli Street, Savarkundala, Dist. Amreli | Mo.: 6354109408</p>
                    </div>
                    
                </div>


                <div class="card">
                    <table class="table " >
                        <thead>
                            <tr>
                                <th style="border-top :1px solid #a6a6a6; border-bottom :1px solid #a6a6a6" class="text-center" colspan="6">
                                    <p style="font-size:20px">
                                    Transfer Receipt
                                    </p>    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="50%" colspan="2" style="border-bottom :1px solid #a6a6a6;" >
                                    <p>
                                    Transfer From : {{ $firstTransaction['from_branch_name'] }} </br>
                                    Transfer To: {{ $firstTransaction['to_branch_name'] }}

                                    </p>

                                </td>
                                <td width="25%"  style="border-bottom :1px solid #a6a6a6; border-left :1px solid #a6a6a6">Order Date

                                </br>
                                {{$firstTransaction['orders'][0]['order_date'] }}
                                </td>

                                <td width="25%" style="border-bottom :1px solid #a6a6a6; border-left :1px solid #a6a6a6" colspan="3">
                                    
                                    @if($firstTransaction['orders'][0]['order_type'] == 1)

                                        <p>Order Type: </br><b>Order </b></p>
                                    @else
                                        <p>Order Type: </br><b>Reparing</b></p>

                                    @endif
                                </td>
                                
                            </tr>
                            <tr>
                                <th width="5%" style="border-bottom :1px solid #a6a6a6">
                                    Sr. No

                                </th>
                                <th width="30%" style="border-left :1px solid #a6a6a6; border-bottom :1px solid #a6a6a6">Item Name</th>

                                <th width="15%" style="border-left :1px solid #a6a6a6; border-bottom :1px solid #a6a6a6;">Item Metal</th>
                                <th width="15%" style="border-left :1px solid #a6a6a6; border-bottom :1px solid #a6a6a6;">Item Melting</th>
                                <th width="15%" style="border-left :1px solid #a6a6a6; border-bottom :1px solid #a6a6a6">Item Colors</th>
                                <th width="20%" style="border-left: 1px solid #a6a6a6; border-bottom: 1px solid #a6a6a6;">QR Code</th>

                            </tr>
                            @foreach ($transfer_array[0]['transactions'] as $index => $transaction)
                       
                            <tr style="height: 50px">
                                <td width="5%"  style="border-bottom :1px solid #a6a6a6">{{$index+1}}</td>
                                <td width="30%"  style="border-left :1px solid #a6a6a6; border-bottom :1px solid #a6a6a6">
                                    <p>
                                    {{$transaction['items'][0]['item_name']}}
                                    </p></td>
                                  
                                <td width="15%"  style="border-left :1px solid #a6a6a6; border-bottom :1px solid #a6a6a6"><p>{{$transaction['items'][0]['item_metal'] }}</p></td>
                                <td width="15%"  style="border-left :1px solid #a6a6a6; border-bottom :1px solid #a6a6a6"><p>{{ $transaction['items'][0]['item_weight']}}</p></td>
                                <td width="15%"  style="border-left :1px solid #a6a6a6; border-bottom :1px solid #a6a6a6"><p>{{ $transaction['items'][0]['item_color']}}</p></td>
                                <td width="20%" style="border-left: 1px solid #a6a6a6; border-bottom: 1px solid #a6a6a6;">
                                    <p>{{ $transaction['orders'][0]['order_qr_code'] }}</p>
                                </td>
                            </tr>
                            @endforeach
                            @for ($i = count($transfer_array[0]['transactions']); $i < 5; $i++)
                                <tr style="height: 50px;">
                                    <td width="5%" style=""></td>
                                    <td width="30%" style="border-left: 1px solid #a6a6a6; ">
                                        <p>&nbsp;</p> <!-- Empty Cell -->
                                    </td>
                                    <td width="15%" style="border-left: 1px solid #a6a6a6; ">
                                        <p>&nbsp;</p>
                                    </td>
                                    <td width="15%" style="border-left: 1px solid #a6a6a6;">
                                        <p>&nbsp;</p>
                                    </td>
                                    <td width="15%" style="border-left: 1px solid #a6a6a6;">
                                        <p>&nbsp;</p>
                                    </td>
                                    <td width="20%" style="border-left: 1px solid #a6a6a6;">
                                        <p>&nbsp;</p>
                                    </td>
                                </tr>
                            @endfor
                            

                            <tr style="height: 150px; border-top: 1px solid #a6a6a6;">
                                <th width="30%" style="border:none;">
                                    Manager Signatory    
                                </th>
                                <th width="30%" style="border:none;">
                                    Customer Signatory
                                </th>
                                <th width="30%" style="border:none;">
                                    Salesman Signatory
                                </th>
                                
                            </tr>

                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection