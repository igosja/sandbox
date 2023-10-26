<?php

declare(strict_types=1);

namespace App\Http\Requests\Lunch\Dish;

use App\Models\Lunch\Category;
use App\Models\Lunch\Dish;
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
            'category_id' => ['required', 'int', 'exists:' . Category::class . ',id'],
            'is_active' => ['required', 'boolean'],
            'is_favorite' => ['required', 'boolean'],
            'is_ordered' => ['required', 'boolean'],
            'name' => ['required', 'string', 'max:255', Rule::unique(Dish::class)->ignore($this->id)],
        ];
    }
}
