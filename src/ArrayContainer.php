<?php

namespace Technically\ArrayContainer;

use Psr\Container\ContainerInterface;
use Technically\ArrayContainer\Exceptions\ServiceNotFound;

final class ArrayContainer implements ContainerInterface
{
    /**
     * @var mixed[]
     */
    private $services;

    /**
     * @param mixed[] $services
     */
    public function __construct(array $services = [])
    {
        $this->services = $services;
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id)
    {
        return array_key_exists($id, $this->services);
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws ServiceNotFound  No entry was found for **this** identifier.
     *
     * @return mixed Entry.
     */
    public function get($id)
    {
        if (array_key_exists($id, $this->services)) {
            return $this->services[$id];
        }

        throw new ServiceNotFound($id);
    }

    /**
     * Sets a container entry for the given identifier.
     *
     * @param string $id Identifier of the entry to set.
     * @param mixed $entry Entry.
     *
     * @return void
     */
    public function set($id, $entry)
    {
        $this->services[$id] = $entry;
    }

    /**
     * Return an associative array of all container entries.
     *
     * @return mixed[]
     */
    public function toArray(): array
    {
        return $this->services;
    }
}
