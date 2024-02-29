<?php

declare(strict_types=1);

namespace App\Http\Requests\VfLeague\Review;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateRequest
 * @package App\Http\Requests\VfLeague\Review
 */
class CreateRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'champ_id' => ['required', 'int'],
            'tour_id' => ['required', 'int'],
        ];
    }
}
