<?php

namespace Levav\Resource;

class ResourceContainer implements \Iterator, \ArrayAccess 
{
    protected $resources;

    /**
     * Constructor 
     */
    public function __construct()
    {
        $this->registerResources();
    }

    private function registerResources()
    {
        $this->resources = [
            new \Levav\Resource\Person(),
            new \Levav\Resource\Place()
        ];
    }

    public function addResource(Resource $resource)
    {
        $this->resources[] = $collection;
    }

    public function offsetExists($offset)
    {
        $filtered = array_filter($this->resources, function($r) use ($offset) {
            return (new \ReflectionClass($r))->getShortName() == ucfirst($offset);
        });

        return !empty($filtered);
    }

    public function offsetGet($offset)
    {
        $filtered = array_filter($this->resources, function($r) use ($offset) {
            return (new \ReflectionClass($r))->getShortName() == ucfirst($offset);
        });

        return reset($filtered);
    }

    public function offsetSet($offset, $value)
    {
        
    }

    public function offsetUnset($offset)
    {
        
    }

    public function rewind()
    {
        return reset($this->resources);
    }

    public function current()
    {
        return current($this->resources);
    }

    public function key()
    {
        return key($this->resources);
    }

    public function next()
    {
        return next($this->resources);
    }

    public function valid()
    {
        return key($this->resources) !== null;
    }
}
