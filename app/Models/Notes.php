<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notes extends Model
{
    //

    use HasFactory;

    protected $table = 'notes';
    protected $primaryKey = 'notes_id';
    protected $fillable = [
        
        'notes_id',
        'notes_text',
        'notes_type',
        'notes_file_id'
    
    
    ];

    public function file()
    {
        return $this->belongsTo(File::class, 'notes_file_id', 'file_id');
    }

    public static function get_notes_by_id($notes_id){
        $notes = Notes::where('notes_id', $notes_id)
                ->with('file')
                ->where('is_delete',0)
                ->first();
        return $notes;
    }

}
