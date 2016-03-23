<?php


namespace Squinones\TopSort\Tests;


use Squinones\TopSort\Graph;
use Squinones\TopSort\Node;

class GraphTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider graphProvider
	 * @param Node[] $nodes
	 */
	public function testSort($nodes, $expectedSort)
	{
		$graph  = new Graph();
		foreach ($nodes as $node) {
			$graph->addNode($node);
		}
		$this->assertEquals($expectedSort, $graph->sort());
	}

	public function graphProvider()
	{
		$root = new Node('root');
		$child1 = new Node('child1', [$root]);
		$child2 = new Node('child2', [$root]);
		$childA = new Node('childA', [$child1]);
		$extern = new Node('extern');
		$childB = new Node('childB', [$childA, $child2, $extern]);
		return [
			[
				[ $childB, $extern, $root, $childA, $child2, $child1 ],
				[ $root, $child1, $childA, $child2, $extern, $childB ],
			],
		];
	}
}
