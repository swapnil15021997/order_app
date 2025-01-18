@extends('app')

@section('content')
<!-- Page header -->
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

            <div class="row row-deck row-cards custom-table-resposive">

                <div class="alert-site">

                </div>
                <div class="table-responsive" style="overflow-y: auto;">
                    <table id="branch_table" class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                            <tr>
                                <th class="w-1">Sr No</th>
                                <th class="">Date</th>
                                <th class="">Total Orders</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script> -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>

$(document).ready(function () {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('#branch_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('transfer-list') }}",
                    type: 'POST',
                    data: function (d) {
                        d.search = d.search.value;
                        d.per_page = d.length;
                        d.page = d.start / d.length + 1;
                        d.draw = d.draw;
                        d.sort = d.order[0].column === 1 ? 'branch_name' : 'branch_id';
                        d.sortOrder = d.order[0].dir;

                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    dataSrc: function (response) {

                        if (response.status === 200) {

                            return response.data;
                        }
                        return [];
                    }
                },
                columns: [
                    { data: 'serial_number', name: 'serial_number', orderable: true },
                    {
                        data: 'date', name: 'date', orderable: false, render: function (data, type, row){
                            console.log(row);
                            return row.trans_at;
                        },
                    },
                    {
                        data: 'count', name: 'count', orderable: false, render: function (data, type, row){
                            return row.transactions.length;
                        },
                    },

                    {

                        data: 'branch_id',
                        name: 'operations',
                        render: function (data, type, row) {
                            return `

                                 <ul class="action-list d-flex list-unstyled">

            <li class="action-item" title="View Receipt" onclick="view_receipt(${row.trans_id})">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.45448 13.8458C1.84656 12.7245 1.84656 11.3653 2.45447 10.2441C4.29523 6.84896 7.87965 4.54492 11.9999 4.54492C16.1202 4.54492 19.7046 6.84897 21.5454 10.2441C22.1533 11.3653 22.1533 12.7245 21.5454 13.8458C19.7046 17.2409 16.1202 19.5449 11.9999 19.5449C7.87965 19.5449 4.29523 17.2409 2.45448 13.8458Z" stroke="black" stroke-width="1.6"/>
<path d="M15.0126 12C15.0126 13.6569 13.6695 15 12.0126 15C10.3558 15 9.01263 13.6569 9.01263 12C9.01263 10.3431 10.3558 9 12.0126 9C13.6695 9 15.0126 10.3431 15.0126 12Z" stroke="black" stroke-width="1.6"/>
</svg>

            </li>

                                `;
                        },
                    }
                ],
                order: [[0, 'desc']],
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "paging": true,

            });
        });


        function view_receipt(trans_id) {
            window.location.href = `/view-receipt/${trans_id}`;
        }
    </script>
    @endsection
