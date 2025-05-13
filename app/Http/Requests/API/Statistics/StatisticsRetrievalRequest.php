<?php

namespace App\Http\Requests\API\Statistics;

use App\Enum\UserRole;
use Illuminate\Foundation\Http\FormRequest;

final class StatisticsRetrievalRequest extends FormRequest {

    public function authorize(): bool {

        return $this->user()?->userRole->enumCase == UserRole::Admin;
    }

    public function rules(): array {

        return [];
    }
}
