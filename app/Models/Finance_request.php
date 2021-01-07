<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finance_request extends Model
{
    use HasFactory;
    protected $table    = 'finance_requests';
    protected $fillable=[
        'self_employed',
        'salary_through_bank',
        'monthly_salary',
        "paid_loan",
        'existing_loans',
        'provide_amount',
        'existing_credit',
        "status",
        "user_id"
    ];
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }

}