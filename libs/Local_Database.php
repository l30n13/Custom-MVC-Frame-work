<?php

/**
 * Class Local_Database Its for storing local data under
 */
class Local_Database {

    private $xmlData;
    private $xmlFilePath;
    private $xmlFileName;

    /**
     * @param string $file_name Defines XML file name
     * @param string $file_path Defines XML file's path name
     */
    function __construct($file_name, $file_path) {
        $this->xmlFileName = $file_name;
        $this->xmlFilePath = $file_path;
        $this->xmlData = new DOMDocument();
        $this->xmlData->load($file_path . "/" . $file_name . ".xml");
    }

    /**
     * @param string $elementName It defines for the XML element name to finding value
     * @return string returns nodeValue of XML element
     */
    public function getData($elementName) {
        return $this->xmlData->getElementsByTagName($elementName)->item(0)->nodeValue;
    }


    /**
     * @param string $elementName It defines for the XML element name to finding value
     * @param string $newValue New value for replacing old one
     */
    public function setData($elementName, $newValue) {
        $this->xmlData->getElementsByTagName($elementName)->item(0)->nodeValue = $newValue;
        $this->xmlData->save($this->xmlFilePath . "/" . $this->xmlFileName . ".xml");
    }
}