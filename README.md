```
$node1 = new Node('foo');
$node2 = new Node('bar', $node1);
$graph = new Graph();
$graph->addNode($node1);
$graph->addNode($node2);
$graph->sort();
```