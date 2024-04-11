<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class URL extends Model
{
    use HasFactory;

    protected $table = 'url';
    protected $fillable = [
        'long_url',
        'short_url',
        'times',
    ];

    public function save_short($long_url)
    {
         $this->long_url = $long_url;
         $this->short_url = hash('md5', $long_url);
         $this->save();
    }

    public function url_exists($long_url)
    {
        $url_exists = self::where('long_url', $long_url)->exists();
        return $url_exists;
    }
}
