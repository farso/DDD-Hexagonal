<?php
namespace UicBundle\Infrastructure\Domain\Model;

/**
 * Created by PhpStorm.
 * User: andreu
 * Date: 22/09/16
 * Time: 10:03
 */


/**
 * Class RepositoryMock
 * @package UicBundle\Infrastructure\Domain\Model
 */
abstract class RepositoryMock
{
    protected $entities;

    public function __construct()
    {
        $this->entities = array();
    }

    public function find($id)
    {
        $foundEntity = null;

        foreach ($this->entities as $entity) {
            if ($entity->getId() == $id) {
                $foundEntity = $entity;
                break;
            }
        }

        return $foundEntity;
    }

    public function findAll()
    {
        return $this->entities;
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        // TODO: Implement findBy() method.
    }

    public function findOneBy(array $criteria, array $orderBy = null)
    {
        // TODO: Implement findOneBy() method.
    }

    public function createEntity($entity)
    {
        $this->entities[] = $entity;
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function deleteEntity($entity)
    {
        // TODO: Implement delete() method.
    }

    abstract protected function exists($fieldName, $fieldValue, $id = null);

    abstract protected function fill();

    public function removeAll()
    {
        $this->entities = array();
    }
}
