<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Registry\Response;

use Ixocreate\Admin\Response\ApiSuccessResponse;
use Ixocreate\Contract\Registry\RegistryEntryInterface;

class RegistryDetailResponse extends ApiSuccessResponse
{

    private $registryEntry;

    /**
     * @var array
     */
    private $item;

    /**
     * @var array
     */
    private $meta;

    public function __construct(RegistryEntryInterface $registryEntry, $item, $meta)
    {
        $data = [
            'label' => $registryEntry::serviceName(),
            'item' => (object)$item, // make sure an empty array here is an empty object in json
            'meta' => $meta,
        ];
        parent::__construct($data);
        $this->registryEntry = $registryEntry;
        $this->item = $item;
        $this->meta = $meta;
    }

    public function registryEntry(): RegistryEntryInterface
    {
        return $this->registryEntry;
    }

    public function item(): array
    {
        return $this->item;
    }

    public function meta(): array
    {
        return $this->meta;
    }
}