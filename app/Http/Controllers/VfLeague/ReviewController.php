<?php
declare(strict_types=1);

namespace App\Http\Controllers\VfLeague;

use App\Http\Controllers\AbstractController;
use App\Http\Requests\VfLeague\Review\CreateRequest;
use App\Services\VfLeague\ReviewService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ReviewController
 * @package App\Http\Controllers\VfLeague
 */
class ReviewController extends AbstractController
{
    /**
     * @param CreateRequest $request
     * @return AnonymousResourceCollection
     */
    public function create(CreateRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();
        $service = new ReviewService((int)$validated['champ_id'], (int)$validated['tour_id']);
        $data = $service->getData();
        return JsonResource::collection([$data]);
    }
}
