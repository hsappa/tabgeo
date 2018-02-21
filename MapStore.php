<?php
namespace TabGeo;

class MapStore
{
    private $maps;
    private $allMaps;

    public function __construct($pDataFile)
    {
        $lMapsJson = file_get_contents($pDataFile);
        $this->maps = json_decode($lMapsJson, true);
        $this->allMaps = json_decode($lMapsJson, true);
    }

    public function getAll()
    {
        return $this->allMaps;
    }

    public function getFilteredResults()
    {
        return $this->maps;
    }

    public function filterByRegion($pRegion)
    {
        $lResults = [];
        foreach ($this->maps as $mapName => $map) {
            if (isset($map['regions'])) {
                if (in_array(strtolower($pRegion), array_map('strtolower', $map['regions']))) {
                    $lResults[$mapName] = $map;
                }
            }
        }
        $this->maps = $lResults;
    }

    public function filterByMapType(&$pMapType)
    {
        $lResults = [];
        foreach ($this->maps as $mapName => $map) {
            if (isset($map['type'])) {
                if (is_array($map['type']) and is_array($pMapType)) {
                    if (
                        array_intersect(
                            array_map('strtolower', $map['type']),
                            array_map('strtolower', $pMapType)
                        )
                    )
                    {
                        $lResults[$mapName] = $map;
                    }
                } else if (!is_array($map['type']) and is_array($pMapType)) {
                    if (in_array(strtolower($map['type']), array_map('strtolower', $pMapType))) {
                        $lResults[$mapName] = $map;
                    }
                } else if (is_array($map['type']) and !is_array($pMapType)) {
                    if (in_array(strtolower($pMapType), array_map('strtolower', $map['type']))) {
                        $lResults[$mapName] = $map;
                    }
                } else if (!is_array($map['type']) and !is_array($pMapType)) {
                    if (strtolower($map['type']) == strtolower($pMapType)) {
                        $lResults[$mapName] = $map;
                    }
                }
            }
        }
        $this->maps = $lResults;
    }

    public function filterByLowerRange(&$pLowerRange)
    {
        $lResults = [];
        foreach ($this->maps as $mapName => $map) {
            if (isset($map['year_create_int'])) {
                if ($map['year_create_int'] >= $pLowerRange) {
                    $lResults[$mapName] = $map;
                }
            }
        }
        $this->maps = $lResults;
    }

    public function filterByUpperRange(&$pUpperRange)
    {
        $lResults = [];
        foreach ($this->maps as $mapName => $map) {
            if (isset($map['year_create_int'])) {
                if ($map['year_create_int'] <= $pUpperRange) {
                    $lResults[$mapName] = $map;
                }
            }
        }
        $this->maps = $lResults;
    }
}