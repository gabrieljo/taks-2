<?php
namespace Traits;
//Generic functionality to validate input parameters for a PUT or POST request
trait Validation{
    //defined column to get from user
    protected $filters = ['email', 'name'];
    protected $input;

    /**
     * validate method
     * @param $data
     * @return array
     */
    function isValide($data) :array{
        //check each of parameter is it assigned or not
        foreach($this->filters as $filter => $value){
            if(!isset($data[$value])){
                return $this->transform(false, $value.' is required');
            }
        }
        return $this->transform(true);
    }

    /**
     * to return unified data format;
     * @param $isSuccess
     * @param null $message
     * @return array
     */
    function transform($isSuccess, $message=null) :array {
        return [
            'isSuccess' => $isSuccess,
            'message' => $message
        ];
    }
}