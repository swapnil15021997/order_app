@extends('app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                    Edit Order
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
           
            <div class="row">
                <div id="alert-container"></div>
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
                                <input class="form-check-input" id="order_type" type="checkbox" @if($order['order_type'] == 2) checked @endif>
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
                                <option value="{{ $branch['branch_id'] }}"
                                
                                @if ($branch['branch_id'] == $order['order_from_branch_id']) selected @endif
                                >{{ $branch['branch_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Order To</label>
                        <select id="edit_searchableSelectTo" class="form-select">
                            
                            @foreach ($branchesArray as $branch)
                                <option value="{{ $branch['branch_id'] }}"
                                @if ($branch['branch_id'] == $order['order_to_branch_id']) selected @endif
                                >{{ $branch['branch_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                          
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                    <label class="form-label">Item name</label>
                    <input type="text" class="form-control" value="{{$order['items'][0]['item_name']}}" id="edit_item_name">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Metal</label>
                        <select class="form-select" id="edit_item_metal">
                        <option value="" disabled selected>Select a metal</option>

                            @foreach ($metals as $metal)
                                <option value="{{ $metal->metal_name }}" 
                                @if ($metal->metal_name == $order['items'][0]['item_metal']) selected @endif
                                >{{ $metal->metal_name }}</option>
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
                                <option value="{{ $melt->melting_name }}" 
                                @if ($melt->melting_name == $order['items'][0]['item_melting']) selected @endif
                                >{{ $melt->melting_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <label class="form-label">Weight</label>
                        <input type="text" class="form-control" id="edit_item_weight" value="{{$order['items'][0]['item_weight']}}" name="example-text-input" placeholder="Weight of item">

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
            @if(!empty($fileArray))
                @foreach($fileArray as $file)
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-sm">
                            <a href="{{ $file['file_url'] ?? '#' }}" class="d-block" target="_blank">
                                <img src="{{ $file['file_url'] ?? './static/photos/default-image.jpg' }}" class="card-img-top" alt="{{ $file['file_name'] ?? 'File Image' }}">
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">No files available.</p>
            @endif
            </div>
           
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <a href="#" class="btn btn-primary ms-auto"  id="updateOrderBtn">
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

   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
   

    <script>

        $('#updateOrderBtn').click(function(e) {
            e.preventDefault(); 
            var orderId = $('#edit_order_id').val();  // Get the order ID to update
            var orderDate = $('#edit_order_date').val();
            var orderType    = document.getElementById('order_type');
              
                const orderTypeValue = orderType.checked ? 2 : 1;
            
            var orderFrom = $('#edit_searchableSelectFrom').val();
            var orderTo = $('#edit_searchableSelectTo').val();
            var itemMetal = $('#edit_item_metal').val();
            var itemName = $('#edit_item_name').val();
            var itemMelting = $('#edit_item_melting').val();
            var itemWeight = $('#edit_item_weight').val();
            var itemImages = $('#edit_item_image_id')[0].files; 
            
            if (orderDate && orderType && orderFrom && orderTo) {
                var formData = new FormData();
                formData.append('_token', csrfToken);  
                formData.append('order_id', edit_order_id);  
                formData.append('order_date', orderDate);
                formData.append('order_type', orderType);
                formData.append('order_from_branch_id', orderFrom);
                formData.append('order_to_branch_id', orderTo);
                formData.append('item_metal', itemMetal);
                formData.append('item_name', itemName);
                formData.append('item_melting', itemMelting);
                formData.append('item_weight', itemWeight);

                // Append files to FormData
                for (var i = 0; i < itemImages.length; i++) {
                    formData.append('item_file_images[]', itemImages[i]);
                }

                $.ajax({
                    url: "{{ route('order-update') }}",  
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 200) {

                            alert(response.message);
                            showAlert('success', response.message);
                            setTimeout(function() {
                                    location.href = "{{ route('order-master') }}";
                            }, 1000);

                        } else {
                            alert('Error updating order: ' + response.message);
                            showAlert('warning', response.message);

                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                        showAlert('warning', error);

                    }
                });
            } else {
                alert('Please fill in all fields.');
                showAlert('warning', 'Please fill in all fields orderDate, orderType and Order To');

            }
        });

        
        function showAlert(type, message) {
            const alertContainer = document.getElementById('alert-container');
            const alertHTML = `
                <div class="alert alert-${type} alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            ${type === 'success' ? `
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l5 5l10 -10" />
                            </svg>` : `
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                                <path d="M12 9v4" />
                                <path d="M12 17h.01" />
                            </svg>`}
                        </div>
                        <div>${message}</div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            `;
            alertContainer.innerHTML = alertHTML;
            console.log("here");
        }
    </script>
@endsection