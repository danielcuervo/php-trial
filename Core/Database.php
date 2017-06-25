<?php


namespace Trial\Core;


interface Database
{

    public function lock();

    public function unlock();

    public function load();

    public function record(array $records);

}