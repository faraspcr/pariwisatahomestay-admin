<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',  // FILE_NAME BUKAN FILE_URL
        'caption',
        'mime_type',
        'sort_order'
    ];

    // Accessor untuk URL file
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->ref_table . '/' . $this->file_name);

    }

    // Accessor untuk cek gambar
    public function getIsImageAttribute()
    {
        return strpos($this->mime_type, 'image') !== false;
    }
}
