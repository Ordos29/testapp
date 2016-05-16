<?php

/**
 * Created by PhpStorm.
 * User: anton
 * Date: 14.05.16
 * Time: 16:20
 */
class XmlToPdfConverter
{
    protected $_xml;

    const PDF_CONVERTER_URL = "http://tomcat-bystrobank.rhcloud.com/fopservlet/fopservlet";

    public function __construct($xml)
    {
        $this->_xml = $xml;
    }

    public function getPdf()
    {
        $xmldom = new DOMDocument();
        $xmldom->loadXML($this->_xml);
        $xsldom = new DomDocument();
        $xsldom->load("stylesheets/TestApp/Pdf.xsl");
        $proc = new XSLTProcessor();
        $proc->importStyleSheet($xsldom);
        $res = $proc->transformToXML($xmldom);

        $url = self::PDF_CONVERTER_URL;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/xml"));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $res);
        $res = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($code != 200) {
            throw new Exception($res . PHP_EOL . $url . " " . curl_error($ch), 450);
        }

        return $res;
    }

}
