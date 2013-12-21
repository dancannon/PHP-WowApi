<?php
namespace WowApi\Request;

use WowApi\Exception\Exception;
use WowApi\Exception\RequestException;
use WowApi\ParameterBag;
use WowApi\Utilities;

if (!function_exists('curl_init')) {
    throw new Exception('This API client needs the cURL PHP extension.');
}

class Curl extends AbstractRequest
{
    protected $curl_opts = array(
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_ENCODING       => "gzip",
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_VERBOSE        => false,
    );

    /**
     * Send a request to the server, receive a response
     *
     * @param  string $url Request url
     * @param string $method HTTP method to use
     * @param array $parameters Parameters
     *
     * @return array HTTP response
     */
    public function makeRequest($url, $method='GET', array $parameters=array())
    {
        //Set cURL options
        $this->curl_opts[CURLOPT_URL]        = $url;
        $this->curl_opts[CURLOPT_HTTPHEADER] = $this->headers->getHeaders();

	// Prepare Data
        if (!empty($parameters)) {
            switch($method) {
                case 'POST':
                    $this->curl_opts[CURLOPT_POST] = true;
                    $this->curl_opts[CURLOPT_POSTFIELDS] = Utilities::encodeUrlParam($parameters);
                    break;
                case 'PUT':
                    $file_handle = fopen($parameters, 'r');
                    $this->curl_opts[CURLOPT_PUT] = true;
                    $this->curl_opts[CURLOPT_INFILE] = $file_handle;
                    break;
                case 'DELETE':
                    $this->curl_opts[CURLOPT_CUSTOMREQUEST] = 'delete';
                    break;
            }
        }

        $response = $this->doCurlCall();

		if ($response['response'] === false) {
			throw new RequestException($response['errorMessage'], $response['errorNumber']);
		}

        return $response;
    }

    /**
     * Execute the query
     *
     * @return array Curl Response
     */
    protected function doCurlCall()
    {
        $curl = curl_init();

        curl_setopt_array($curl, $this->curl_opts);

        $response = curl_exec($curl);
        $headers = curl_getinfo($curl);
        $errorNumber = curl_errno($curl);
        $errorMessage = curl_error($curl);

        curl_close($curl);

        return compact('response', 'headers', 'errorNumber', 'errorMessage');
    }

	/**
	* Sets an option to a cURL session
	* @param $option constant, cURL option
	* @param $value mixed, value of option
	*/
	public function setOpt($option, $value)
	{
		$this->curl_opts[$option] = $value;
	}
}
