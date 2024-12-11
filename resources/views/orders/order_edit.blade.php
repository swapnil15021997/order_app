@extends('app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                    New Role
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
           
            <div class="row">
                <div class="col-lg-6">
                 
                    <div class="mb-3">
                        <input type="hidden" name="edit_order_id">
                        <label class="form-label">Order Date</label>
                        <input type="date" id="edit_order_date" value="{{$order['order_date']}}" class="form-control" form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Order Type</label>
                        <div class="d-flex align-items-center">
                            <label class="form-check-label me-2">Reparing</label>
                            <label class="form-check form-switch m-0">
                                <input class="form-check-input" id="orderType" type="checkbox" @if($order['order_type'] == 2) checked @endif>
                            </label>
                            <label class="form-check-label ms-2">Order</label>
                        </div>
                         
                    </div>
                </div>
            </div>
            
            <div class="row">
                
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Order From</label>
                        <select id="edit_searchableSelectFrom" class="form-select"  type="text">
                            @foreach ($branchesArray as $branch)
                                <option value="{{ $branch['branch_id'] }}">{{ $branch['branch_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Order To</label>
                        <select id="edit_searchableSelectTo" class="form-select">
                            
                            @foreach ($branchesArray as $branch)
                                <option value="{{ $branch['branch_id'] }}">{{ $branch['branch_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                          
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                    <label class="form-label">Item name</label>
                    <input type="text" class="form-control" id="edit_item_name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Metal</label>
                        <select class="form-select" id="edit_item_metal">
                        <option value="" disabled selected>Select a metal</option>

                            @foreach ($metals as $metal)
                                <option value="{{ $metal->metal_name }}" selected>{{ $metal->metal_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <label class="form-label">Melting</label>
                        <select class="form-select" id="edit_item_melting">
                            <option value="" disabled selected>Select a melting</option>
                            @foreach ($melting as $melt)
                                <option value="{{ $melt->melting_name }}" selected>{{ $melt->melting_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label class="form-label">Weight</label>
                        <input type="text" class="form-control" id="edit_item_weight" name="example-text-input" placeholder="Weight of item">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Item Images</label>
                        <input type="file" class="form-control" id="edit_item_image_id"  multiple  placeholder="Choose Images">
                    </div>
                </div>
            </div>
           
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal" id="updateOrderBtn">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        Update Order
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
@endsection