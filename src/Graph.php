<?php

namespace Squinones\TopSort;

/**
 * Class Graph
 * @package Squinones\TopSort
 */
class Graph
{
	/**
	 * @var array
	 */
	private $nodes;

	/**
	 * @param array $nodes
	 * @return Graph
	 */
	public static function create(array $nodes = []) {
		return new self($nodes);
	}

	/**
	 * @param array $nodes
	 */
	public function __construct(array $nodes = [])
	{
		$this->nodes = $nodes;
	}

	/**
	 * @param $node
	 * @param null $edge
	 */
	public function addNode($node, $edge = null)
	{
		$this->nodes[] = is_null($edge) ? $node : [$edge, $node];
	}

	/**
	 * @param array $nodes
	 */
	public function setNodes(array $nodes)
	{
		$this->nodes = $nodes;
	}

	/**
	 * @return array
	 */
	public function getNodes()
	{
		return $this->nodes;
	}

	/**
	 * @return array
	 */
	public function sort()
	{
		$unsorted = $sorted = [];
		$nodes = $this->getNodes();

		// Remove any non-edged nodes to the unsorted list. If there are no nodes without edges, please check your
		// local reality for cracks.
		for ($i=count($this->nodes)-1; $i>=0; $i--) {
			if (!is_array($this->nodes[$i])) {
				array_push($unsorted, array_splice($this->nodes, $i, 1)[0]);
			}
		}

		// While there are unsorted elements
		while(count($unsorted)) {

			// pull the first and push it on to the sorted list
			$n = array_shift($unsorted);
			array_push($sorted, $n);

			// loop backwards through remaining contexts
			for ($i=count($this->nodes)-1; $i>=0; $i--) {
				// move elements whose incoming edge nodes have been moved to sorted to the unsorted list
				if(is_array($this->nodes[$i]) && $this->nodes[$i][0] === $n) {
					array_push($unsorted, array_splice($this->nodes, $i, 1)[0][1]);
				}
			}
		}
		return array_keys(array_flip($sorted));
	}

}