--TEST--
MongoClient::setReadPreference() should clear existing tags
--SKIPIF--
<?php require_once "tests/utils/standalone.inc"; ?>
--FILE--
<?php require_once "tests/utils/server.inc"; ?>
<?php

$m = new_mongo_standalone(null, true, true, array(
    'connect' => false,
    'readPreference' => Mongo::RP_PRIMARY_PREFERRED,
    'readPreferenceTags' => 'dc:east',
));

$rp = $m->getReadPreference();
var_dump($rp['type'] === Mongo::RP_PRIMARY_PREFERRED);
var_dump($rp['tagsets'] === array(array('dc' => 'east')));

$m->setReadPreference(Mongo::RP_PRIMARY_PREFERRED);

$rp = $m->getReadPreference();
var_dump($rp['type'] === Mongo::RP_PRIMARY_PREFERRED);
var_dump(empty($rp['tagsets']));

echo "---\n";

$m = new_mongo_standalone(null, true, true, array(
    'connect' => false,
    'readPreference' => Mongo::RP_PRIMARY_PREFERRED,
    'readPreferenceTags' => 'dc:east',
));

$rp = $m->getReadPreference();
var_dump($rp['type'] === Mongo::RP_PRIMARY_PREFERRED);
var_dump($rp['tagsets'] === array(array('dc' => 'east')));

$m->setReadPreference(Mongo::RP_PRIMARY_PREFERRED, array());

$rp = $m->getReadPreference();
var_dump($rp['type'] === Mongo::RP_PRIMARY_PREFERRED);
var_dump(empty($rp['tagsets']));

echo "---\n";

$m = new_mongo_standalone(null, true, true, array(
    'connect' => false,
    'readPreference' => Mongo::RP_PRIMARY_PREFERRED,
    'readPreferenceTags' => 'dc:east',
));

$rp = $m->getReadPreference();
var_dump($rp['type'] === Mongo::RP_PRIMARY_PREFERRED);
var_dump($rp['tagsets'] === array(array('dc' => 'east')));

$m->setReadPreference(Mongo::RP_PRIMARY, array());

$rp = $m->getReadPreference();
var_dump($rp['type'] === Mongo::RP_PRIMARY);
var_dump(empty($rp['tagsets']));

?>
--EXPECT--
bool(true)
bool(true)
bool(true)
bool(true)
---
bool(true)
bool(true)
bool(true)
bool(true)
---
bool(true)
bool(true)
bool(true)
bool(true)
