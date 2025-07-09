@extends('app')

@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Activity Log</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Activity Log</h4>
                            <p class="card-text">Track all user activities related to orders</p>
                        </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search by order number, QR code, or activity type..." onkeypress="handleSearchKeyPress(event)" oninput="handleSearchInput(event)">
                                <button class="btn btn-primary" type="button" onclick="searchActivities()">
                                    <i class="fas fa-search"></i> Search
                                </button>
                                <button class="btn btn-outline-secondary" type="button" onclick="clearSearch()">
                                    <i class="fas fa-times"></i> Clear
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn btn-secondary" onclick="refreshTable()">
                                <i class="fas fa-refresh"></i> Refresh
                            </button>
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <div class="col-12">
                            <small id="tableInfo" class="text-muted"></small>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="activityTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order Number</th>
                                    <th>QR Code</th>
                                    <th>Activity</th>
                                    <th>Transaction ID</th>
                                    <th>User</th>
                                    <th>Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded here -->
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <label class="me-2">Show:</label>
                                <select id="perPageSelect" class="form-select form-select-sm" style="width: auto;" onchange="changePerPage()">
                                    <option value="15">15</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span class="ms-2">entries</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="Activity pagination">
                                <ul id="pagination" class="pagination justify-content-end mb-0">
                                    <!-- Pagination will be generated here -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Get CSRF token for AJAX requests
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

let currentPage = 1;
let perPage = 15;
let totalPages = 1;
let searchQuery = '';

// Initialize the table when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadActivities();
});

function loadActivities(page = 1) {
    currentPage = page;
    
    const data = {
        page: page,
        per_page: perPage,
        search: searchQuery,
        draw: 1
    };

    // Debug logging
    console.log('Sending request with data:', data);

    fetch('{{ route("activity_list") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 200) {
            displayActivities(data.data);
            totalPages = data.total_pages;
            updatePagination();
            updateTableInfo(data.recordsTotal, data.recordsFiltered);
        } else {
            showAlert('error', data.message || 'Failed to load activities');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'An error occurred while loading activities');
    });
}

function displayActivities(activities) {
    const tbody = document.querySelector('#activityTable tbody');
    tbody.innerHTML = '';

    if (activities.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="text-center">No activities found</td></tr>';
        return;
    }

    activities.forEach(activity => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${activity.activity_id}</td>
            <td>${activity.order_number}</td>
            <td>${activity.order_qr_code}</td>
            <td>
                <span class="badge bg-primary text-white">${activity.order_activity}</span>
            </td>
            <td>${activity.transaction_id || 'N/A'}</td>
            <td>${activity.user_name}</td>
            <td>${activity.created_at}</td>
        `;
        tbody.appendChild(row);
    });
}

function updatePagination() {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    if (totalPages <= 1) return;

    // Previous button
    const prevLi = document.createElement('li');
    prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
    prevLi.innerHTML = `<a class="page-link" href="#" onclick="loadActivities(${currentPage - 1})">Previous</a>`;
    pagination.appendChild(prevLi);

    // Page numbers
    const startPage = Math.max(1, currentPage - 2);
    const endPage = Math.min(totalPages, currentPage + 2);

    for (let i = startPage; i <= endPage; i++) {
        const li = document.createElement('li');
        li.className = `page-item ${i === currentPage ? 'active' : ''}`;
        li.innerHTML = `<a class="page-link" href="#" onclick="loadActivities(${i})">${i}</a>`;
        pagination.appendChild(li);
    }

    // Next button
    const nextLi = document.createElement('li');
    nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
    nextLi.innerHTML = `<a class="page-link" href="#" onclick="loadActivities(${currentPage + 1})">Next</a>`;
    pagination.appendChild(nextLi);
}

function updateTableInfo(total, filtered) {
    const start = (currentPage - 1) * perPage + 1;
    const end = Math.min(currentPage * perPage, filtered);
    
    // Display search results info
    const infoElement = document.getElementById('tableInfo');
    if (infoElement) {
        if (searchQuery) {
            infoElement.innerHTML = `Showing ${start} to ${end} of ${filtered} entries (filtered from ${total} total entries) for search: "${searchQuery}"`;
        } else {
            infoElement.innerHTML = `Showing ${start} to ${end} of ${total} entries`;
        }
    }
    
    console.log(`Showing ${start} to ${end} of ${filtered} entries (filtered from ${total} total entries)`);
}

function handleSearchKeyPress(event) {
    if (event.key === 'Enter') {
        searchActivities();
    }
}

function handleSearchInput(event) {
    // Debounce the search to avoid too many requests
    clearTimeout(window.searchTimeout);
    window.searchTimeout = setTimeout(() => {
        searchQuery = event.target.value;
        console.log('Real-time search query:', searchQuery);
        loadActivities(1);
    }, 500); // Wait 500ms after user stops typing
}

function searchActivities() {
    searchQuery = document.getElementById('searchInput').value;
    console.log('Search query:', searchQuery);
    loadActivities(1);
}

function clearSearch() {
    searchQuery = '';
    document.getElementById('searchInput').value = '';
    loadActivities(1);
}

function changePerPage() {
    perPage = parseInt(document.getElementById('perPageSelect').value);
    loadActivities(1);
}

function refreshTable() {
    clearSearch();
}

function showAlert(type, message) {
    // You can implement your own alert system here
    alert(message);
}
</script>

<style>
.badge {
    font-size: 0.8em;
}

.table th {
    background-color: #f8f9fa;
    border-color: #dee2e6;
}

.pagination .page-link {
    color: #007bff;
}

.pagination .page-item.active .page-link {
    background-color: #007bff;
    border-color: #007bff;
}

.pagination .page-item.disabled .page-link {
    color: #6c757d;
}
</style>
@endsection 