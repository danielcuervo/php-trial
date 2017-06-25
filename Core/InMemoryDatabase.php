<?php

namespace Trial\Core;

class InMemoryDatabase implements Database
{
    const DEFAULT_NAME = 'database';
    const DATABASE_FILE = '/../%s.json';
    const LOCK_FILE = '/../%s.lock';
    private $filename;
    private $lock;

    public function __construct($filename = null)
    {
        $this->filename = $filename ?
            sprintf(self::DATABASE_FILE, $filename): sprintf(self::DATABASE_FILE, self::DEFAULT_NAME);
        $this->lock = $filename ?
            sprintf(self::LOCK_FILE, $filename): sprintf(self::LOCK_FILE, self::DEFAULT_NAME);
    }

    public function lock()
    {
        file_put_contents(__DIR__ . $this->lock, "lock");
    }
    public function unlock()
    {
        unlink(__DIR__ . $this->lock);
    }

    public function load()
    {
        if (file_exists(__DIR__ . $this->filename)) {
            return json_decode(file_get_contents(__DIR__ . $this->filename), true);
        }
        return [];
    }

    public function record(array $records)
    {
        file_put_contents(__DIR__ . $this->filename, json_encode($records));
    }

}
