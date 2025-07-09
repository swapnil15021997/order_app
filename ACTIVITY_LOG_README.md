# Activity Logging System

This document describes the activity logging system implemented for the order management application.

## Overview

The activity logging system tracks all user activities related to orders, including:
- Order creation
- Order updates
- Order transfers
- Order approvals
- Order removals

## Database Schema

The activity log is stored in the `activity_log` table with the following structure:

```sql
CREATE TABLE activity_log (
    activity_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT NOT NULL,
    order_trans_id BIGINT NULL,
    order_activity VARCHAR(255) NOT NULL,
    user_id BIGINT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

## Model: ActivityLog

The `ActivityLog` model is located at `app/Models/ActivityLog.php` and provides the following methods:

### Static Methods

1. **logActivity($orderId, $activity, $userId = null, $transactionId = null)**
   - Logs a single activity for one order
   - Parameters:
     - `$orderId`: The order ID
     - `$activity`: Activity description (e.g., 'Order Created', 'Order Transfer')
     - `$userId`: User ID (defaults to authenticated user)
     - `$transactionId`: Transaction ID (optional)

2. **logMultipleOrdersActivity($orderIds, $activity, $userId = null, $transactionIds = null)**
   - Logs activities for multiple orders (used for bulk operations)
   - Parameters:
     - `$orderIds`: Array of order IDs
     - `$activity`: Activity description
     - `$userId`: User ID (defaults to authenticated user)
     - `$transactionIds`: Array of transaction IDs (optional)

3. **getActivitiesWithPagination($perPage = 15, $search = null)**
   - Retrieves activities with pagination and search functionality
   - Parameters:
     - `$perPage`: Number of items per page
     - `$search`: Search query for filtering activities

### Relationships

- `order()`: Belongs to Order model
- `transaction()`: Belongs to Transactions model
- `user()`: Belongs to User model

## Controller: ActivityController

The `ActivityController` is located at `app/Http/Controllers/ActivityController.php` and provides:

1. **activity_index()**: Displays the activity log master page
2. **activity_list()**: Returns paginated activity data via AJAX

## Routes

The following routes are added for activity logging:

```php
Route::get('activity-master', [ActivityController::class, 'activity_index'])->name('activity-master');
Route::post('activity-list', [ActivityController::class, 'activity_list'])->name('activity_list');
```

## Integration Points

Activity logging has been integrated into the following OrderController methods:

### Order Creation
- **Method**: `order_add()`
- **Activity**: "Order Created"
- **Transaction ID**: Included

### Order Updates
- **Method**: `order_update()`
- **Activity**: "Order Updated"

### Order Transfers
- **Method**: `order_transfer()`
- **Activity**: "Order Transfer"
- **Transaction ID**: Included

### Order Approvals
- **Method**: `order_approve()`, `order_get_approve()`
- **Activity**: "Order Approve"
- **Transaction ID**: Included

### Multiple Order Approvals
- **Method**: `multiple_approve()`
- **Activity**: "Order Approve"
- **Handles**: Multiple orders in single operation

### Multiple Order Transfers
- **Method**: `multiple_transfer()`
- **Activity**: "Order Transfer"
- **Handles**: Multiple orders in single operation

### Order Removal
- **Method**: `order_remove()`
- **Activity**: "Order Removed"

## Frontend Integration

### Navigation
Activity log link has been added to:
- Main navigation bar (`resources/views/navbar.blade.php`)
- Mobile navigation menu (`resources/views/footer.blade.php`)

### Activity Log View
The activity log view is located at `resources/views/activity/activity_master.blade.php` and includes:
- Search functionality
- Pagination
- Responsive data table
- Real-time data loading via AJAX

## Activity Types

The system logs the following activity types:
1. **Order Created**: When a new order is created
2. **Order Updated**: When an existing order is modified
3. **Order Transfer**: When an order is transferred between branches
4. **Order Approve**: When an order is approved/received
5. **Order Removed**: When an order is deleted

## Usage Examples

### Logging a Single Activity
```php
use App\Models\ActivityLog;

// Log order creation
ActivityLog::logActivity($orderId, 'Order Created', $userId, $transactionId);
```

### Logging Multiple Activities
```php
// Log multiple order transfers
$orderIds = [1, 2, 3];
$transactionIds = [10, 11, 12];
ActivityLog::logMultipleOrdersActivity($orderIds, 'Order Transfer', $userId, $transactionIds);
```

### Retrieving Activities
```php
// Get paginated activities
$activities = ActivityLog::getActivitiesWithPagination(15, 'Order');

// Get activities with search
$activities = ActivityLog::getActivitiesWithPagination(15, 'Transfer');
```

## Security Considerations

1. **User Authentication**: All activity logging requires authenticated users
2. **Permission Checks**: Activity logging respects existing permission systems
3. **Data Validation**: All inputs are validated before logging
4. **Audit Trail**: Complete audit trail of all order-related activities

## Testing

A test file `test_activity_log.php` is provided to verify the functionality:
- Tests single activity logging
- Tests multiple activity logging
- Tests activity retrieval with pagination

## Future Enhancements

Potential improvements for the activity logging system:
1. **Activity Categories**: Group activities by type
2. **Export Functionality**: Export activity logs to CSV/PDF
3. **Real-time Notifications**: WebSocket notifications for new activities
4. **Advanced Filtering**: Filter by date range, user, branch, etc.
5. **Activity Analytics**: Dashboard with activity statistics 