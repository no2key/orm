<?php
namespace Bravo3\Orm\Mappers;

use Bravo3\Orm\Mappers\Metadata\Entity;

interface MapperInterface
{
    /**
     * Get the metadata for an entity, including column information
     *
     * @param string $entity Class name of the entity
     * @return Entity
     */
    public function getEntityMetadata($entity);
}
