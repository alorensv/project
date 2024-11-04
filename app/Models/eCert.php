<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eCert extends Model
{
    use HasFactory;

    //prueba
    private $_UserName = 'USUAPI_772934246';
    private $_Password = '7dTG3y6tCgj29eZ4t';
    //productiva
    //private $_UserName = 'USUAPI_772934246';
    //private $_Password = '3341Swap';

    private $_orden; 
    private $_Token;
    public $_IdUsuarioECert;
    public $_DocumentoId;

    private $_url;


    private $_UrlCallback = "https://www.swap-lex.cl/docu/callback.php"; // 
    public $_UrlWebHook = "https://web.segurosncs.cl/recibeDocumento";
    private $_RutUsuario = '17342911-8'; //15170621-5
    public $_Nombre = 'Alejandro Guillermo';
    public $_ApellidoPaterno = 'Lorens';
    public $_ApellidoMaterno = 'Villa';
    private $_Email = 'alorensv@gmail.com';
    private $_RutEmpresa = "77293424-6";
    private $_CantidadDoctos = 1;
    private $_CaducaEnHoras = 0;
    private $_TipoFirma = 3;//FAO
    private $_CorreoEnvioDocumentoFirmado = 'alorensv@gmail.com';

    private $_NombreDocumento = 'Documento.pdf';
    private $_RequiereCustodia = false;
    private $_PosicionFirmaX = 0;
    private $_PosicionFirmaY = 0;
    private $_PosicionFirmaPagina = 0;
    public $_DocumentoBase64; 

    public $_UrlLoginECert;

    private $_documento;

    function __construct($orden, $tipo){
        
        //$this->setOrden($orden, $tipo);
        $this->Authenticate();        
        //$this->_documento=new Documentos();        
    }

    public function Authenticate(){
        //test
        $this->_url = 'https://certificacion.ecertchile.cl/PortalEmpresas/API/ApiGestor/Login/Authenticate'; 
        //productiva
        //$this->_url = 'https://portalempresa.ecertchile.cl/API/ApiGestor/Login/Authenticate'; 

        $data = [
            'UserName' => $this->_UserName,
            'Password' => $this->_Password
        ];
        $obj = $this->myCurl($data, "Authenticate");
        if(!is_null($obj)){
            if($obj->Exito == true){
                $this->_Token = $obj->ObjetoGenerico->Token;
                return $obj;
            }
        }
        return $obj;        
    }

    function setUrlCallback($url){
        $this->_UrlCallback = $url;
    }

    function set_UrlWebHook($url){
        $this->_UrlWebHook = $url;
    }

    function setCorreos($correos){
        $this->_CorreoEnvioDocumentoFirmado = $correos;
    }   

    function getToken(){
        return $this->_Token;
    }
    function getIdUsuarioECert(){
        return $this->_IdUsuarioECert;
    }

    function getDocumentoId(){
        return $this->_DocumentoId;
    }

    function setRutUsuario($rut){
        $this->_RutUsuario = $rut;
    }

    function set_Email($correo){
        $this->_Email = $correo; 
    }

    function set_Nombre($nombre){
        $this->_Nombre = $nombre;
    }

    function set_ApellidoPaterno($apellido){
        $this->_ApellidoPaterno = $apellido;
    }

    function set_ApellidoMaterno($apellido){
        $this->_ApellidoMaterno = $apellido;
    }

    function setPosicionFirmaY($y){
        $this->_PosicionFirmaY = $y;
    }

    function setPosicionFirmaX($x){
        $this->_PosicionFirmaX = $x;
    }

    function setPosicionFirmaPagina ($v) {
        $this->_PosicionFirmaPagina = $v;
    }

    function setNombreDocumento($docto){
        $this->_NombreDocumento = $docto;
    }

    function setPDF($pdf){
        $this->_DocumentoBase64 = $pdf;
    }
  
    function setOrden($orden, $tipo){
        $this->_orden = $orden;
        $this->_UrlCallback .= '?tipo=' . $tipo . '&orden=' . $orden;
    }


    function myCurl($data=array(), $call=''){

        //echo "<br>myCurl:$call<br><br>";
        $jsonData = json_encode($data);
        //curl 
        $ch = curl_init($this->_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        
        if ($this->_Token == '' or is_null($this->_Token)):
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData)
            ]);
        else:
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: ' . $this->_Token,
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData)
            ]);
        endif;        
        $response = curl_exec($ch); 

        //recupera
        if (curl_errno($ch)) {
            // Hubo un error en la conexión
            echo 'Error en cURL: ' . curl_error($ch);
            exit;
        } else {
            // Procesar la respuesta
            /* $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Código de estado HTTP
            echo "<br><br>$call:Código de respuesta: $httpCode\n";
            echo "<br>Respuesta ($call): $response\n"; */

            //echo "<br><br>" . print_r(json_encode($data), true);

            //echo "<br><br>" . $this->$_Token;
        }

        //cierra
        curl_close($ch);
        //decode respuesta
        $decode = json_decode($response);

        if (isset($decode->UrlLoginECert)) {
            $this->_UrlLoginECert = $decode->UrlLoginECert;
        }        
        if (isset($decode->DocumentoId)) {
            $this->_DocumentoId = $decode->DocumentoId;
        }
        return $decode;
    }

    

    function setNombreCompleto($nombre_completo){
        //echo $nombre_completo;        
        //quitar espacio 
        for ($i = 1; $i <= 10; $i++) {
            $nombre_completo = str_replace('  ', ' ', $nombre_completo);
        }

        $nombre = explode(' ', $nombre_completo);

        $this->_ApellidoMaterno = $nombre[count($nombre)-1];
        $this->_ApellidoPaterno = $nombre[count($nombre)-2];

        $nombre_completo = str_replace($this->_ApellidoMaterno, '', $nombre_completo);
        $nombre_completo = str_replace($this->_ApellidoPaterno, '', $nombre_completo);

        $this->_Nombre = trim($nombre_completo );

    }

    function Preinscripcion(){
        //$this->_url = 'https://portalempresa.ecertchile.cl/API/ApiGestor/integracion/Preinscripcion';
        $this->_url = 'https://certificacion.ecertchile.cl/PortalEmpresas/API/ApiGestor/Integracion/PreInscripcion'; 

        $data = [
            "RutUsuario" => $this->_RutUsuario,
            "Nombre" => $this->_Nombre,
            "ApellidoPaterno" => $this->_ApellidoPaterno,
            "ApellidoMaterno" => $this->_ApellidoMaterno,
            "Email" => $this->_Email,
            "RutEmpresa" => $this->_RutEmpresa,
            "CantidadDoctos" => $this->_CantidadDoctos,
            "UrlCallback" => $this->_UrlCallback,
            "UrlWebHook" => $this->_UrlWebHook,//recibe aca viene el documento
            "CaducaEnHoras" => $this->_CaducaEnHoras, 
            "TipoFirma" => $this->_TipoFirma, //FAO  --> 
            "CorreoEnvioDocumentoFirmado" => $this->_CorreoEnvioDocumentoFirmado
        ];
        $obj = $this->myCurl($data, "Preinscripcion");
        //dd($obj);
        $this->_IdUsuarioECert = $obj->IdUsuarioECert;

    }

    function SubirDocumento(){

        $this->_url = 'https://certificacion.ecertchile.cl/PortalEmpresas/API/ApiGestor/integracion/SubirDocumento';
        //$this->_url = 'https://portalempresa.ecertchile.cl/API/ApiGestor/integracion/SubirDocumento';


        $data = [
            "RutUsuario" => $this->_RutUsuario,
            "IdUsuarioECert" => $this->_IdUsuarioECert,
            "NombreDocumento" => $this->_NombreDocumento,
            "RequiereCustodia" => $this->_RequiereCustodia,
            "PosicionFirmaX" => $this->_PosicionFirmaX,
            "PosicionFirmaY" => $this->_PosicionFirmaY,
            "PosicionFirmaPagina" => $this->_PosicionFirmaPagina,
            "LineasFirma" => [
                "12345678901234567890123456789012", //?
                "Ubicacion: 12341341, 1234123421" //?
            ],
            "DocumentoBase64" => $this->_DocumentoBase64 
            
        ];
        //curl
        $obj = $this->myCurl($data, "SubirDocumento");
        $this->_DocumentoId = $obj->DocumentoId;

        //guarda el documento en la base 
        //$this->_documento->insertarDocumento($this->_orden, $this->_DocumentoId);

       
        return $obj->DocumentoId;

    }

    function NotificarUsuario() {

        $this->_url = 'https://portalempresa.ecertchile.cl/API/ApiGestor/integracion/NotificarUsuario';

        $data = [
            "RutUsuario" => $this->_RutUsuario,
            "IdUsuarioECert" => $this->_IdUsuarioECert,
        ];

        //echo print_r($data, true);
        //curl
        $obj = $this->myCurl($data, "NotificarUsuario");
        

    }


}
