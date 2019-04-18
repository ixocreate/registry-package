<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Package\Registry\Response;

use Ixocreate\Package\Admin\Response\ApiSuccessResponse;
use Ixocreate\Package\Schema\SchemaInterface;

final class RegistryDetailResponse extends ApiSuccessResponse
{
    /**
     * @var SchemaInterface
     */
    private $schema;

    /**
     * @var array
     */
    private $item;

    /**
     * @var array
     */
    private $meta;

    public function __construct(SchemaInterface $schema, array $item, array $meta)
    {
        $data = [
            'schema' => $schema,
            'item' => (object)$item, // make sure an empty array here is an empty object in json
            'meta' => $meta,
        ];
        parent::__construct($data);
        $this->schema = $schema;
        $this->item = $item;
        $this->meta = $meta;
    }

    public function schema(): SchemaInterface
    {
        return $this->schema;
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
