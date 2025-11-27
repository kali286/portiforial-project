<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    // contact_messages table fillable fields model
   protected $table = 'contact_messages';
   protected $primaryKey = 'id'; 
   protected $fillable = [
       'name',
       'email',
       'subject',
       'message',
       'status',
       'admin_note',
   ];
}
