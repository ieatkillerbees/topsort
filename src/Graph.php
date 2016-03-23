<?php
declare(strict_types = 1);

namespace Squinones\TopSort;

/**
 * Class Graph
 *
 * Implements a sortable directed acyclic graph
 *
 * @package Squinones\TopSort
 */
class Graph
{
	/**
	 * @var Node[]
	 */
	private $nodes;

	/**
	 * @var Node[]
	 */
	private $sorted=[];

	/**
	 * Sorts the graph using recursive depth-first search
	 *
	 * @return array
	 */
	public function sort(): array
	{
		$this->sorted = [];
		$unmarked = $this->getUnmarked();
		while (count($unmarked) > 0) {
			/** @var Node $node */
			$node = array_shift($unmarked);
			$this->visit($node);
		}
		return $this->sorted;
	}

	/**
	 * Add a node to the graph
	 *
	 * @param Node $node
	 */
	public function addNode(Node $node)
	{
		$this->nodes[] = $node;
	}

	/**
	 * Return an array of all unmarked nodes
	 *
	 * @return Node[]
	 */
	private function getUnmarked(): array
	{
		return array_filter($this->nodes, function (Node $node) { return !$node->isMarked(); });
	}

	/**
	 * Visit a node in the graph and sort its parents recursively
	 *
	 * @param Node $n
	 */
	private function visit(Node $n)
	{
		if ($n->isMarked()) {
			throw new CyclicNodeException("Cyclic node found. Not a DAG");
		}

		$n->setMarked(true);
		foreach ($n->getParents() as $m) {
			$this->visit($m);
		}
		$n->setMarked(false);
		$n->setVisited(true);

		if (!in_array($n, $this->sorted)) {
			array_push($this->sorted, $n);
		}
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		$this->sort();
		return array_map(function (Node $node) { return $node->getName(); }, $this->sorted);
	}
}