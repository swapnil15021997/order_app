<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{
    use HasFactory;

    protected $table = 'email_log';

    protected $primaryKey = 'mail_id';
    protected $fillable = [
        'mail_order_id',
        'mail_from',
        'mail_to',
        'mail_cc',
        'mail_bcc',
        'mail_subject',
        'mail_content',
        'mail_status'
    ];
}
