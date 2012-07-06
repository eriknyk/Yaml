<?php

#
#    S P Y C
#      a simple php yaml class
#
# license: [MIT License, http://www.opensource.org/licenses/mit-license.php]
#

include '../../Yaml.php';
$yaml = new Yaml();

$array = $yaml->load('../Fixtures/sample.yaml');

echo '<pre><a href="../Fixtures/sample.yaml">sample.yaml</a> loaded into PHP:<br/>';
print_r($array);
echo '</pre>';


echo '<pre>YAML Data dumped back:<br/>';
echo $yaml->dump($array);
echo '</pre>';

