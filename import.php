<?php

$a = $_GET;
unset($a['id']);
unset($a['lat']);
unset($a['lon']);

$generator = 'http://osm.cupivan.ru/validator/';

$tags = '';
foreach ($a as $k => $v)
	$tags .= "\t".'<tag k="'.$k.'" v="'.str_replace('"', '&quot;', $v).'"/>'."\n";

if (!isset($_GET['id']))
{
	$xml = '<?xml version="1.0" encoding="UTF-8"?>
	<osm version="0.6" generator="'.$generator.'">
	';
	$xml .= '<node id="-1" action="modify" visible="true" lat="'.$_GET['lat'].'" lon="'.$_GET['lon'].'">';
	$xml .= $tags;
	$xml .= "</node>\n</osm>\n";
} else
// задан id - сперва скачиваем инфу с сервера
{
	$id = $_GET['id'];
	$id = str_replace('n', 'node/',     $id);
	$id = str_replace('w', 'way/',      $id); if (strpos($id, 'way') === 0) $id .= '/full';
	$id = str_replace('r', 'relation/', $id);

	$xml = @file_get_contents('http://api.openstreetmap.org/api/0.6/'.$id) or die('API error!');
	$id  = preg_replace('/\D/', '', $id);
	$xml = preg_replace("#(id=.$id..+?)(</node>|</way>)#s", "action='modify' $1$tags$2", $xml);
	$xml = preg_replace('#(<osm ver[^ ]+).+?>#', '$1 generator="'.$generator.'">', $xml);
}

header('Content-Type:text/xml; charset=utf-8');
echo $xml;
