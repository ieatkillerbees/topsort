<?php

namespace Squinones\TopSort\Tests;
use Squinones\TopSort\Graph;

/**
 * Class ContextResolverTest
 * @group actions
 */
class GraphTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @dataProvider dagProvider
	 * @param $data
	 */
	public function testTopSortWithStaticConstruction($data)
	{
		list($input, $expected) = $data;
		$sort = Graph::create($input);
		$this->assertEquals($expected, $sort->sort());
	}

	/**
	 * @dataProvider dagProvider
	 * @param $data
	 */
	public function testTopoSort($data)
	{
		list($input, $expected) = $data;
		$sort = new Graph($input);
		$this->assertEquals($expected, $sort->sort());
	}

	/**
	 * @return array
	 */
	public function dagProvider()
	{
		return [
			[[
				['apple', ['apple', 'banana'], ['apple', 'grape'], ['grape', 'tomato'], 'onion', 'pear', ['onion', 'shallot'], ['onion', 'eggplant'], ['eggplant', 'tomato'], 'tomato'],
				['tomato', 'pear', 'onion', 'apple', 'eggplant', 'shallot', 'grape', 'banana']
			]],
			[[
				['apple', ['apple', 'banana'], ['banana', 'grape'], ['grape', 'tomato'], 'onion', 'pear', ['onion', 'shallot'], ['shallot', 'eggplant'], ['eggplant', 'tomato'], 'tomato'],
				['tomato', 'pear', 'onion', 'apple', 'shallot', 'banana', 'eggplant', 'grape']
			]],
			[[
				[
					['PrepareCookieSheet', 'BakeCookies'],
					['PreheatOven', 'BakeCookies'],
					['MixIngredients', 'BakeCookies'],
					['PrepareUtensils', 'PrepareCookieSheet'],
					['PrepareUtensils', 'PreheatOven'],
					['PrepareUtensils', 'MixIngredients'],
					['BuyIngredients', 'MixIngredients'],
					'PrepareUtensils',
					'BuyIngredients'
				],
				['BuyIngredients', 'PrepareUtensils', 'MixIngredients', 'PreheatOven', 'PrepareCookieSheet', 'BakeCookies']
			]]

		];
	}
}
 