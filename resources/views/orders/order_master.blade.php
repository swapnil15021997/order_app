@extends('app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
            <!-- Page pre-title -->
            <div class="page-pretitle">
                Overview
            </div>
            <h2 class="page-title">
                Orders
            </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
            
                <a href="{{route('order-add-page')}}" class="btn btn-primary d-none d-sm-inline-block" >
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Create new Order
                </a>
                <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                </a>
            </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
        <div id="alert-container"></div>

            <div class="row row-deck row-cards">    

                <div class="table-responsive">
                    <table id="branch_table" class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                        <tr>
                            <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                            
                            <th>Order Date</th>
                            <th>Order Type</th>
                            <th>From Branch</th>
                            <th>To Branch</th>

                            <th>order_number</th>
                            <th>qr_number</th>
                            <th>Operations</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">New Order</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                
                    <div class="mb-3">
                        <label class="form-label">Order Date</label>
                        <input type="date" id="order_date" class="form-control" form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Order Type</label>
                        <select id="order_type"  class="form-select">
                            <option value="1" selected>Repairing</option>
                            <option value="2">Order</option>
                        </select>
                    </div>
                </div>
            </div>
           
            <div class="row">
              
              <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">Order From</label>
                    <select id="searchableSelectFrom" class="form-select"  type="text">
                          @foreach ($branchesArray as $branch)
                              <option value="{{ $branch['branch_id'] }}">{{ $branch['branch_name'] }}</option>
                          @endforeach
                     </select>
                  </div>
                
              </div>
              <div class="col-lg-6">
                  <div class="mb-3">
                    <label class="form-label">Order To</label>
                    <select id="searchableSelectTo" class="form-select">
                          
                          @foreach ($branchesArray as $branch)
                              <option value="{{ $branch['branch_id'] }}">{{ $branch['branch_name'] }}</option>
                          @endforeach
                     </select>
                  </div>
              </div>
            </div>            
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Item name</label>
                  <input type="text" class="form-control" id="item_name">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Metal</label>
                    <select class="form-select" id="item_metal">
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
                        <select class="form-select" id="item_melting">
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
                        <input type="text" class="form-control" id="item_weight" name="example-text-input" placeholder="Weight of item">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div>
                        <label class="form-label">Item Images</label>
                        <input type="file" class="form-control" id="item_image_id"  multiple  placeholder="Choose Images">
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal" id="saveBranchBtn">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              Create new Order
            </a>
      
          </div>
      </div>
    </div>
</div>

    <div class="modal modal-blur fade" id="edit_order" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">New Order</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                
                    <div class="mb-3">
                        <input type="hidden" name="edit_order_id">
                        <label class="form-label">Order Date</label>
                        <input type="date" id="edit_order_date" class="form-control" form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Order Type</label>
                        <select id="edit_order_type"  class="form-select">
                            <option value="1" selected>Repairing</option>
                            <option value="2">Order</option>
                        </select>
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
          </div>
          <div class="modal-body">
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
                    <div>
                        <label class="form-label">Item Images</label>
                        <input type="file" class="form-control" id="edit_item_image_id"  multiple  placeholder="Choose Images">
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal" id="updateOrderBtn">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              Update Order
            </a>
      
          </div>
      </div>
    </div>
    </div>
    <input type="hidden" name="" id="delete_order_id">
    <div class="modal modal-blur fade" id="delete_order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        Do you want to delete this order?
                        </div>
                </div>
                
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                    </a>
                    <a id="DeleteOrderBtn" href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            Delete This Order
                    </a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script> -->

     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#order_date').val('');
            $('#order_type').val('');
            $('#searchableSelectFrom').val('');
            $('#searchableSelectTo').val('');
            $('#item_metal').val('');
            $('#item_name').val('');
            $('#item_melting').val('');
            $('#item_weight').val('');
            $('#item_image_id').val('');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('#branch_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('order_list') }}", 
                    type: 'POST',
                    data: function(d) {
                        d.search   = d.search.value; 
                        d.per_page = d.length;  
                        d.page     = d.start / d.length + 1;  
                        d.draw     = d.draw;  
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken  // Add CSRF token in the header
                    },
                    dataSrc: function(response) {

                        if (response.status === 200) {
                            return response.data.orders; 
                        }
                        return [];  // Return an empty array if no data
                    }
                },
                columns: [
                    { data: 'serial_number', name: 'serial_number' },  
                    { data: 'order_date', name: 'order_date' }, 
                    { data: 'order_type', name: 'order_type' }, 
                    { data: 'order_from_name', name: 'order_from_name' },  
                    { data: 'order_to_name', name: 'order_to_name' },  
                    { data: 'order_number', name: 'order_number' }, 
                    { data: 'order_qr_code', name: 'order_qr_code' }, 
                        { 
                        data: 'order_id', 
                        name: 'operations', 
                        render: function(data, type, row) {
                            return `<button data-bs-toggle="dropdown" type="button" class="btn dropdown-toggle dropdown-toggle-split"></button>
                                <div class="dropdown-menu dropdown-menu-end">
                                  <a class="dropdown-item" href="#" onclick="edit_order(${row.order_id})">
                                    Edit
                                  </a>
                                  <a class="dropdown-item" href="#" onclick="delete_order(${row.order_id})">
                                    Delete
                                  </a>
                                </div>`;
                                
                        },     
                    }   
                ],
                "pageLength": 10,  
                "lengthMenu": [10, 25, 50, 100]  
            });
            $('input[aria-controls="branch_table"]').on('keyup', function() {
                table.search(this.value).draw();
            });
       

           


            $('#updateOrderBtn').click(function(e) {
                e.preventDefault(); 
                var orderId = $('#edit_order_id').val();  // Get the order ID to update
                var orderDate = $('#edit_order_date').val();
                var orderType = $('#edit_order_type').val();
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
                                $('#branch_table').DataTable().ajax.reload();  
                                alert(response.message);
                                $('#edit_order').modal('hide');  
                            } else {
                                alert('Error updating order: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('An error occurred: ' + error);
                        }
                    });
                } else {
                    alert('Please fill in all fields.');
                }
            });

            $('#DeleteOrderBtn').click(function(e) {
                e.preventDefault(); 

                var orderId = $('#delete_order_id').val();
                if (orderId) {
                    $.ajax({
                        url: "{{ route('order_remove') }}",  
                        type: 'POST',
                        data: {
                            _token        : csrfToken,
                            order_id     : orderId,
                        },
                        success: function(response) {
                            if (response.status==200) {
                                $('#delete_order_id').val();
                                $('#delete_order').modal('hide');
                                $('#branch_table').DataTable().ajax.reload(); 
                                alert(response.message);
                                showAlert('success', response.message);
                            } else {
                                alert('Error deleting order: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('An error occurred: ' + error);
                        }
                    });
                } else {
                    alert('Please fill in both fields.');
                }
            });  
        });

        function edit_order(order_id){
            window.location.href = `/edit-order/${order_id}`;
            // var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // $.ajax({
            //     url: "{{ route('order_details') }}", 
            //     type: 'POST',
            //     data: {
            //         _token        : csrfToken,
            //         order_id     : order_id,
            //     },
            //     success: function(response) {
            //         // Handle success
            //         console.log("Success",response.data);
                   
            //         if (response.status==200) {
            //             var order = response.data;
            //             var items = response.data.items[0];
            //             console.log("Items",items);
            //             $('#edit_order_id').val(order.order_id);
            //             $('#edit_order_date').val(order.order_date);  
            //             $('#edit_order_type').val(order.order_type);
            //             $('#edit_searchableSelectFrom').val(order.order_from_branch_id);
            //             $('#edit_searchableSelectTo').val(order.order_to_branch_id);
            //             $('#edit_item_name').val(items.item_name);
            //             $('#edit_item_metal').val(items.item_metal);
            //             $('#edit_item_melting').val(items.item_melting);
            //             $('#edit_item_weight').val(items.item_weight);
            //             $('body').addClass('modal-open');
            //             $('#edit_order').modal('show');

            //         } else {
            //             alert('Error fetching branch: ' + response.message);
            //         }
            //     },
            //     error: function(xhr, status, error) {
            //         alert('An error occurred: ' + error);
            //     }
            // });
        }

        function delete_order(order_id){
            $('#delete_order_id').val(order_id);
            $('#delete_order').modal('show');
      
        }

        function formatDate(date) {
            var d = new Date(date);
            var year = d.getFullYear();  
            var month = ('0' + (d.getMonth() + 1)).slice(-2); 
            var day = ('0' + d.getDate()).slice(-2);  
            return year + '-' + month + '-' + day;  
        }

        
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