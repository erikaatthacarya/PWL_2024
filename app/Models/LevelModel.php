<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level'; // Ganti sesuai nama tabel level kamu
    protected $primaryKey = 'level_id';
    
    // Tambahkan fillable jika kamu akan create/update
    protected $fillable = ['nama_level'];

    public function users()
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }
}
