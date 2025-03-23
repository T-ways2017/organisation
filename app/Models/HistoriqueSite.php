<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueSite extends Model
{
    use HasFactory;
    protected $fillable = [ 'employe_id','last_site_id', 'new_site_id', 'date_changement'];

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }

    public function lastSite()
    {
        return $this->belongsTo(Site::class, 'last_site_id');
    }

    public function newSite()
    {
        return $this->belongsTo(Site::class, 'new_site_id');
    }

}
