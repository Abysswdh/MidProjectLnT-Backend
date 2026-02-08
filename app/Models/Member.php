<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    protected $fillable = [
        'member_code',
        'name',
        'email',
        'phone',
        'address',
        'join_date',
    ];

    protected $casts = [
        'join_date' => 'date',
    ];

    /**
     * Get all borrowings by this member.
     */
    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Generate a unique member code.
     */
    public static function generateMemberCode(): string
    {
        $lastMember = self::orderBy('id', 'desc')->first();
        $nextNumber = $lastMember ? $lastMember->id + 1 : 1;
        return 'MBR' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }
}
