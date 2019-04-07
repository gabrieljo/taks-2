<?php
namespace Controller;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Traits\Validation;

class HomeController {
    //Generic functionality to validate input parameters for a PUT or POST request.
    use Validation;

    //The controller execute method expects request and response objects as parameters.
    function execute(Request $request, Response $response) :Response{
        switch($request->getMethod()){
            case 'GET' :
                return $this->getAction($response);
            case 'POST' :
            case 'PUT':
                return $this->postAction($request, $response);
            default :
                return $this->otherAction($response);
        }
    }

    function getAction($response){
        $data = '<h1>Hello, world</h1><p>This is get request</p>';
        $status = 200;
        return $this->toHtml($response, $status, $data);
    }

    function postAction($request, $response){
        $postData = $request->getParsedBody();
//        Generic functionality to validate input parameters for a PUT or POST request.
        $rtnValide = $this->isValide($postData);

        if($rtnValide['isSuccess']){
            $data = [
                "name" => $postData['name'],
                "email" => $postData['email']
            ];
        }else{
            $data = $rtnValide;
        }
        $statusCode = $rtnValide['isSuccess'] ? 200 : 400;
        return $this->toJson($response, $statusCode, $data);
    }

    function otherAction($response){
        return $response->withStatus(200)->withHeader('Content-Type', 'text/html')->write("Not Prepared yet");
    }

    /**
     * Functionality to return an HTML response body along with any valid HTTP response codes and/or response headers
     * transform to return html data
     * @param $response
     * @param $status
     * @param $data
     * @return mixed
     */
    function toHtml($response, $status, $data){
        return $response->withStatus($status)->withHeader('Content-Type', 'text/html')->write($data);
    }

    /**
     * Functionality to return a JSON response body along with any valid HTTP response codes and/or response headers
     * transform to return json data
     * @param $response
     * @param $status
     * @param $data
     * @return mixed
     */
    function toJson($response, $status, $data){
        return $response->withStatus($status)->withHeader('Content-Type', 'application/json')->withJson($data);
    }
}