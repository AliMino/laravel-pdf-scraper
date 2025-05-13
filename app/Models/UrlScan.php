<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $url
 * @property ?string $filename
 * @property-read UrlScanStatus $urlScanStatus
 * @property-read User $user
 * @property-read \Carbon\Carbon $updated_at
 */
final class UrlScan extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'url',
        'user_id',
        'url_scan_status_id'
    ];

    public final function urlScanStatus() {

        return $this->belongsTo(UrlScanStatus::class);
    }

    public final function user() {

        return $this->belongsTo(User::class);
    }
}
