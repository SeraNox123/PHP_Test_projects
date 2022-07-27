<?php
require_once "Node.php";

class BinarySearchTree
{
    /**
     * @var Node|null
     */
    public ?Node $root;

    public function __construct($number)
    {
        $this->root = new Node();
        $this->root->number = $number;
    }

    /**
     * @param Node|null $tree
     * @param int $number
     * @return void
     */
    public function add(?Node $tree, int $number): void
    {
        $temp = new Node();
        $temp->number = $number;

        if ($tree->left == null && $temp->number < $tree->number) {
            $tree->left = $temp;
            return;
        } elseif ($tree->right == null && $temp->number > $tree->number) {
            $tree->right = $temp;
            return;
        }

        if ($temp->number < $tree->number) {
            $this->add($tree->left, $temp->number);
        } elseif ($temp->number > $tree->number) {
            $this->add($tree->right, $temp->number);
        }
    }

    /**
     * @param Node|null $tree
     * @param int $number
     * @return bool
     */
    public function search(?Node $tree, int $number): bool
    {
        if ($tree == null) {
            return false;
        } elseif ($number < $tree->number) {
            return $this->search($tree->left, $number);
        } elseif ($number > $tree->number) {
            return $this->search($tree->right, $number);
        } else {
            return true;
        }
    }

    /**
     * @param Node|null $node
     * @return Generator
     */
    public function walk(Node $node = null): Generator
    {
        if ($node == null) {
            $node = $this->root;
        }

        if ($node == null) {
            return false;
        }

        if ($node->left) {
            yield from $this->walk($node->left);
        }

        yield $node;
        if ($node->right) {
            yield from $this->walk($node->right);
        }
    }
}