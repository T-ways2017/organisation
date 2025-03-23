<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [

        'name', 'lastname', 'matricule', 'email', 'phone',
        'adresse', 'birth', 'cv', 'picture', 'rib', 'site_id', 'grade_id'
    ];

    //On employe belong to on site
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

     //On employe belong to on grade
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

     //On employe belong to on work
     public function work()
     {
         return $this->belongsTo(Work::class);
     }

    //On employe can have more training
     public function trainings()
    {
        return $this->belongsToMany(Training::class)->withTimestamps();
    }

   //On employe can change  more sites (history)
   public function historySite()
   {
       return $this->hasMany(HistorySite::class);
   }

   //On employe can have more training (history)
   public function historyTrainings()
   {
       return $this->hasMany(HistoryTraining::class);
   }
}
