<?php

class Node
{
    /**
     * @var int
     */
    public int $number;
    /**
     * @var Node|null
     */
    public ?Node $left = null;
    /**
     * @var Node|null
     */
    public ?Node $right = null;
}