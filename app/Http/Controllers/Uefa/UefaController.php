<?php
declare(strict_types=1);

namespace App\Http\Controllers\Uefa;

use App\Http\Controllers\AbstractController;
use App\Services\Uefa\UefaService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class IndexController
 * @package App\Http\Controllers\Uefa
 */
class UefaController extends AbstractController
{
    /**
     * @param UefaService $service
     * @return AnonymousResourceCollection
     */
    public function index(UefaService $service): AnonymousResourceCollection
    {
        $data = $service->getData();
        return JsonResource::collection($data);
    }
}
