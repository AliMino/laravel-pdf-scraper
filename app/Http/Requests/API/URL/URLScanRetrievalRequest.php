<?php

namespace App\Http\Requests\API\URL;

use App\Enum\UserRole;
use Illuminate\Foundation\Http\FormRequest;

final class URLScanRetrievalRequest extends FormRequest {

    public function authorize(): bool {

        return $this->user()?->userRole->enumCase == UserRole::User;
    }

    public function rules(): array {

        return [];
    }
}
