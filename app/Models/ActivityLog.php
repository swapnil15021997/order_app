<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_log';
    
    protected $primaryKey = 'activity_id';
    protected $fillable = [
        'order_id',
        'order_trans_id',
        'order_activity',
        'user_id'
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transactions::class, 'order_trans_id', 'trans_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Static method to log activity
    public static function logActivity($orderId, $activity, $userId = null, $transactionId = null)
    {
        return self::create([
            'order_id' => $orderId,
            'order_trans_id' => $transactionId,
            'order_activity' => $activity,
            'user_id' => $userId ?? auth()->id()
        ]);
    }

    // Method to log multiple orders activity (for bulk operations)
    public static function logMultipleOrdersActivity($orderIds, $activity, $userId = null, $transactionIds = null)
    {
        $logs = [];
        
        if (is_array($orderIds)) {
            foreach ($orderIds as $index => $orderId) {
                $transactionId = $transactionIds && isset($transactionIds[$index]) ? $transactionIds[$index] : null;
                
                $logs[] = self::create([
                    'order_id' => $orderId,
                    'order_trans_id' => $transactionId,
                    'order_activity' => $activity,
                    'user_id' => $userId ?? auth()->id()
                ]);
            }
        }
        
        return $logs;
    }

    // Get all activities with pagination
    public static function getActivitiesWithPagination($perPage = 15, $search = null)
    {
        $query = self::with(['order', 'transaction', 'user'])
            ->orderBy('created_at', 'desc');

        if ($search && !empty(trim($search))) {
            $search = trim($search);
            $query->where(function ($q) use ($search) {
                $q->where('order_activity', 'like', "%{$search}%")
                  ->orWhereHas('order', function ($orderQuery) use ($search) {
                      $orderQuery->where('order_number', 'like', "%{$search}%")
                                ->orWhere('order_qr_code', 'like', "%{$search}%");
                  })
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('user_name', 'like', "%{$search}%");
                  });
            });
        }

        return $query->paginate($perPage);
    }
}
