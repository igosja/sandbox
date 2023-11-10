<?php

declare(strict_types=1);

namespace App\Http\Requests\Lunch\Category;

use App\Models\Lunch\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateRequest
 * @package App\Http\Requests\Lunch\Category
 */
class UpdateRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'is_active' => ['required', 'boolean'],
            'name' => ['required', 'string', 'max:255', Rule::unique(Category::class)->ignore($this->id)],
        ];
    }
}
