<?php

declare(strict_types=1);

namespace App\Http\Controllers\Lunch;

use App\Http\Controllers\AbstractController;
use App\Services\Lunch\RandomMenuService;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class LunchController
 * @package App\Http\Controllers\Lunch
 */
class LunchController extends AbstractController
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $menu = (new RandomMenuService())->getRandomMenu();
        return JsonResource::collection($menu);
    }
}
