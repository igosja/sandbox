<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AbstractResource
 * @package App\Http\Resources
 */
abstract class AbstractResource extends JsonResource
{
    /**
     * @var array $fields
     */
    protected array $fields = [];

    /**
     * @var array $extraFields
     */
    protected array $extraFields = [];

    /**
     * @var Request $request
     */
    private Request $request;

    /**
     * @var array $requestExtraFields
     */
    private array $requestExtraFields = [];

    /**
     * @var array $requestFields
     */
    private array $requestFields = [];

    /**
     * @var array $result
     */
    private array $result = [];

    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $this->request = $request;
        $this->prepareResult();

        return $this->result;
    }

    private function prepareResult()
    {
        if (!$this->fields && !$this->extraFields) {
            $this->result = parent::toArray($this->request);
            return;
        }

        $this->addFieldsToResult();
        $this->addExtraFieldsToResult();
    }

    /**
     * @return void
     */
    private function addFieldsToResult(): void
    {
        $this->loadRequestFields();
        if (!$this->requestFields) {
            $this->result = parent::toArray($this->request);
            return;
        }

        $fields = array_intersect($this->fields, $this->requestFields);
        foreach ($fields as $field) {
            $this->result[$field] = $this->$field;
        }
    }

    /**
     * @return void
     */
    private function loadRequestFields(): void
    {
        $fields = $this->request->get('fields');
        if (!$fields) {
            return;
        }

        $this->requestFields = explode(',', $fields);
    }

    /**
     * @return void
     */
    private function addExtraFieldsToResult(): void
    {
        $this->loadRequestExtraFields();

        $fields = array_intersect($this->extraFields, $this->requestExtraFields);
        foreach ($fields as $field) {
            $this->result[$field] = $this->$field;
        }
    }

    /**
     * @return void
     */
    private function loadRequestExtraFields(): void
    {
        $extraFields = $this->request->get('expand');
        if (!$extraFields) {
            return;
        }

        $this->requestExtraFields = explode(',', $extraFields);
    }
}
