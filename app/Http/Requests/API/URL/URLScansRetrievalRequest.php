<?php

namespace App\Http\Requests\API\URL;

use App\Enum\UserRole;
use Illuminate\Foundation\Http\FormRequest;

final class URLScansRetrievalRequest extends FormRequest {

    public function authorize(): bool {

        return $this->user()?->userRole->enumCase == UserRole::User;
    }

    public function rules(): array {

        return [

            'urls'      => 'array',
            'urls.*'    => 'url',
            
            'from_date' => 'date_format:Y-m-d',
            'to_date'   => 'date_format:Y-m-d',
        ];
    }
}
