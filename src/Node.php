<?php
declare(strict_types = 1);

namespace Squinones\TopSort;

/**
 * Class Node
 *
 * A node
 *
 * @package Squinones\TopSort
 */
class Node
{
	/** @var bool */
	private $visited = false;

	/** @var bool */
	private $marked = false;

	/** @var string */
	private $name;

	/** @var Node[] */
	private $parents = [];

	/**
	 * Node constructor.
	 * @param string $name
	 * @param Node[] $parents
	 */
	public function __construct(string $name, array $parents = [])
	{
		$this->name    = $name;
		$this->parents = $this->parents + $parents;
	}

	/**
	 * @return boolean
	 */
	public function isVisited()
	{
		return $this->visited;
	}

	/**
	 * @param bool $visited
	 */
	public function setVisited(bool $visited)
	{
		$this->visited = $visited;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name)
	{
		$this->name = $name;
	}

	/**
	 * @return Node[]
	 */
	public function getParents(): array
	{
		return $this->parents;
	}

	/**
	 * @param Node[] $parents
	 */
	public function setParents(array $parents)
	{
		$this->parents = $parents;
	}

	/**
	 * @return bool
	 */
	public function isMarked(): bool
	{
		return $this->marked;
	}

	/**
	 * @param bool $marked
	 */
	public function setMarked(bool $marked)
	{
		$this->marked = $marked;
	}

	/**
	 * Returns true if this node is a child of $node
	 *
	 * @param Node $node
	 * @return bool
	 */
	public function isChildOf(Node $node): bool
	{
		foreach ($this->parents as $edge) {
			if ($node->getName() === $edge->getName()) {
				return true;
			}
			return false;
		}
	}

	public function __toString()
	{
		return $this->getName();
	}


}
