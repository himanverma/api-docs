<?php 
namespace Himanverma\Apidocs;
/**
 * Main Class to provide API Documentation
 * @author Himanshu Verma <himan.verma@live.com>
 */
class ApiDocs{
    private function getClassDetails($class){
        $refClass = new \ReflectionClass($class);
        $classDocs = new \zpt\anno\Annotations($refClass);
        $classDocs = $classDocs->asArray();
        $methods = $refClass->getMethods();
        $methodRefs = [];
        foreach ($methods as $method){
            if($method->class != $class || $method->name == "__construct"){
                continue;
            }
            $methodRefs[] = (new \zpt\anno\Annotations($method))->asArray();
        }
        return [
            "methods" => $methodRefs,
            "classDoc" => $classDocs,
            "class" => $refClass->name
          ];
    }
    public function index(){
        $classes = $this->getClassList();
        $classesInfo = [];
        foreach($classes as $docClass){
            $classDetails = $this->getClassDetails($docClass['class']);
            $classesInfo[] = $classDetails;
        }
        return view("docs::doc")->with("data", $classesInfo);
    }
    public function getExport(){
        $classes = $this->getClassList();
            $appName = "WellChat";
            $postmanCollection = [
                "variables" => [],
                "info" => [
                    "name" => $appName . " API",
                    "_postman_id" => "1025a806-5910-0ebf-36f9-c768a95c730b",
                    "description" => "",
                    "schema" => "https://schema.getpostman.com/json/collection/v2.0.0/collection.json",
                ],
                "item" => []
            ];
            $headers = [
                [
                    "key" => "Accept",
                    "value" => "application/json",
                    "description" => ""
                ],[
                    "key" => "token",
                    "value" => "9f93e50b74d7e71fb781e880ccc77160",
                    "description" => ""
                ],[
                    "key" => "Content-Type",
                    "value" => "application/json",
                    "description" => ""
                ]
            ];
            $base_url = "http://localhost:8000/";
            foreach($classes as $docClass){
                $methods = [];
                $classDetails = $this->getClassDetails($docClass['class']);
                foreach($classDetails['methods'] as $method){
                   $url = $base_url . @$method['url'];
                   $mode = "raw";
                    $methods[] = [
                        "name" => isset($method["description"]) ? $method["description"] : $url,
                        "request" => [
                            "url" => $url,
                            "method" => isset($method['method']) ? strtoupper($method['method']) : "GET",
                            "header" => $headers,
                            "body" => [
                                "mode" => $mode,
                                $mode => json_encode(json_decode(@$method["request"]),JSON_PRETTY_PRINT)
                            ],
                            "description" => @$method["description"]
                        ],
                        "response" => []
                    ];
                }
                $postmanCollection["item"][] = [
                    "name" => isset($classDetails['classDoc']['apimodule']) ? $classDetails['classDoc']['apimodule'] : $classDetails['class'],
                    "description" => @$classDetails['classDoc']['description'],
                    "item" => $methods
                ];
            }
            $postmanCollection = json_encode($postmanCollection, JSON_PRETTY_PRINT);
            return response($postmanCollection)
                    ->header("Content-Type", "application/json")
                    ->header("Content-Disposition", " attachment; filename=" . $appName . ".postman_collection")
                    ->header("Pragma", "no-cache");
    }
 
}