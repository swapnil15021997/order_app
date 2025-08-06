<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Transactions;
class Transfer extends Model
{
    use HasFactory;
    
    protected $table = 'multiple_transfer';
    protected $primaryKey = 'trans_id';
    protected $fillable = [
        'trans_ids',
        'trans_status',
        'multiple_transfer_delivery_note',
        'multiple_transfer_type'
    ];
    public function transactions()
    {
        return $this->hasMany(Transactions::class, 'trans_id', 'trans_ids');
    }

}
