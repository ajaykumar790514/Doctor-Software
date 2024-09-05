<?php

namespace PhpOffice\PhpSpreadsheet\Collection;

use Psr\SimpleCache\CacheInterface;

/**
 * This is the default implementation for in-memory cell collection.
 *
 * Alternatives implementation should leverage off-memory, non-volatile storage
 * to reduce overall memory usage.
 */
class Memory implements CacheInterface
{
    private $cache = [];

    public function clear(): bool
    {
        $this->cache = [];
    
        return true;
    }

    public function delete(string $key): bool
    {
        unset($this->cache[$key]);
    
        return true;
    }

    public function deleteMultiple($keys): bool
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }
    
        return true;
    }
    

    public function get(string $key, mixed $default = null): mixed
    {
        if ($this->has($key)) {
            return $this->cache[$key];
        }

        return $default;
    }

    public function getMultiple($keys, $default = null): iterable
    {
        $results = [];
        foreach ($keys as $key) {
            $results[$key] = $this->get($key, $default);
        }
    
        return $results;
    }
    

    public function has($key): bool
    {
        return array_key_exists($key, $this->cache);
    }
    

    public function set(string $key, $value, \DateInterval|int|null $ttl = null): bool
    {
        $this->cache[$key] = $value;
    
        return true;
    }
    

    public function setMultiple($values, $ttl = null): bool
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value, $ttl);
        }
    
        return true;
    
    }
}
