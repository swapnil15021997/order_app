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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transfers</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="multiple_transfer_delivery_note">Delivery Note</label>
                                <input type="text" name="multiple_transfer_delivery_note" id="multiple_transfer_delivery_note" class="form-control" value="{{$transfer['multiple_transfer_delivery_note'] ?? ''}}">
                            </div>

                            <div class="col-md-6">
                                <label for="multiple_transfer_type">Transfer Type</label>
                                <select name="multiple_transfer_type" id="multiple_transfer_type" class="form-control">
                                    <option value="1" {{ $transfer['multiple_transfer_type'] == 1 ? 'selected' : '' }}>Issue for Karagir</option>
                                    <option value="2" {{ $transfer['multiple_transfer_type'] == 2 ? 'selected' : '' }}>Issue for Hallmarking</option>
                                </select>
                            </div>
                        
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" id="save_transfer_receipt" onclick="save_transfer_receipt()">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    function save_transfer_receipt(){
        var multiple_transfer_delivery_note = $('#multiple_transfer_delivery_note').val();
        var multiple_transfer_type = $('#multiple_transfer_type').val();
        var trans_id = '{{$transfer['trans_id']}}';
        console.log(multiple_transfer_delivery_note,multiple_transfer_type);

        const formData = new FormData();
        formData.append('multiple_transfer_delivery_note', multiple_transfer_delivery_note);
        formData.append('multiple_transfer_type', multiple_transfer_type);
        formData.append('trans_id', trans_id);

        $.ajax({
            url: "{{ route('transfer_receipt_save') }}",
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken  // Add CSRF token in the header
            },
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 200) {
                    showAlert('success', response.message);
                }else{
                    showAlert('warning', response.message);
                }
            },
            error: function (xhr, status, error) {
                showAlert('error', 'Something went wrong');
            }
        }); 
    }   
</script>

@endsection