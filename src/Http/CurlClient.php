<?php namespace Fungku\Http;

use Fungku\Hubspot\Contracts\HttpClient;

class CurlClient implements HttpClient
{
    protected $apiKey;
    protected $apiPath;
    protected $apiVersion;
    protected $isTest = false;
    protected $PATH_DIV = '/';
    protected $KEY_PARAM = '?hapikey=';
    protected $PROD_DOMAIN = 'https://api.hubapi.com';
    protected $QA_DOMAIN = 'https://hubapiqa.com';
    protected $userAgent;    // new

    /**
     * The HTTP status of the most recent request.
     *
     * @var integer
     */
    protected $lastStatus;

    /**
     * The HTTP code for a successful request.
     */
    const STATUS_OK = 200;

    /**
     * The HTTP code for bad request.
     */
    const STATUS_BAD_REQUEST = 400;

    /**
     * The HTTP code for unauthorized.
     */
    const STATUS_UNAUTHORIZED = 401;

    /**
     * The HTTP code for resource not found.
     */
    const STATUS_NOT_FOUND = 404;

    /**
     * @param string $apiKey
     * @param string $userAgent
     */
    public function __construct($apiKey, $userAgent = null)
    {
        $this->apiKey = $apiKey;
        $this->userAgent = $userAgent;
    }

    /**
     * Gets the status code from the most recent curl request.
     *
     * @return int
     */
    public function getLastStatus()
    {
        return (int) $this->lastStatus;
    }

    /**
     * Returns apiPath that is set in specific hapi clients.  All
     * clients that extend BaseClient should set $apiPath to the
     * base path for the API (e.g.: the leads api sets the value to
     * 'leads')
     *
     * @throws HubSpotException
     */
    protected function getApi()
    {
        if ( $this->isBlank($this->apiPath) )
            throw new HubSpotException('apiPath must be defined');
        else
            return $this->apiPath;
    }

    /**
     * Returns apiVersion that is set in specific hapi clients. All
     * clients that extend BaseClient should set $apiVersion to the
     * version that the client is developed for (e.g.: the leads v1
     * client sets the value to 'v1')
     *
     * @throws HubSpotException
     */
    protected function apiVersion()
    {
        if ( $this->isBlank($this->apiVersion) )
            throw new HubSpotException('apiVersion must be defined');
        else
            return $this->apiVersion;
    }

    /**
     * Allows developer to set testing flag to true in order to
     * execute api requests against hubapiqa.com
     *
     * @param boolean $testing
     */
    public function set_is_test($testing) {
        if ( $testing == TRUE )
        {
            $this->isTest = TRUE;
        }
    }

    /**
     * Returns the hapi domain to use for requests based on isTesting.
     *
     * @returns string
     */
    protected function get_domain()
    {
        if ( $this->isTest == TRUE )
            return $this->QA_DOMAIN;
        else
            return $this->PROD_DOMAIN;
    }

    /**
     * Creates the url to be used for the api request.
     *
     * @param string $endpoint String value for the endpoint to be used (appears after version in url)
     * @param array  $params   Array containing query parameters and values
     *
     * @returns string
     */
    protected function requestUrl($endpoint, $params)
    {
        $paramString = $this->array_to_params($params);

        return $this->get_domain() . $this->PATH_DIV.$this->getApi() . $this->PATH_DIV . $this->apiVersion() .
        $this->PATH_DIV . $endpoint . $this->KEY_PARAM . $this->apiKey . $paramString;
    }

    /**
     * Creates the url to be used for the api request for Forms API.
     *
     * @param string $urlBase String value for the endpoint to be used (appears after version in url)
     * @param array  $params  Array containing query parameters and values
     *
     * @return String
     */
    protected function formsRequestUrl($urlBase, $params)
    {
        $paramString = $this->array_to_params($params);

        return $urlBase . $this->KEY_PARAM . $this->apiKey . $paramString;
    }

    /**
     * Executes HTTP GET request
     *
     * @param string $url String value for the URL to GET
     *
     * @return Body of request result
     *
     * @throws HubSpotException
     */
    public function get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        $output = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        $this->setLastStatusFromCurl($ch);
        curl_close($ch);

        if ( $errno > 0 )
            throw new HubSpotException('cURL error: ' . $error);
        else
            return $output;
    }

    /**
     * Executes HTTP POST request
     *
     * @param string $url String value for the URL to POST to
     * @param array $body Array containing names and values for fields to post
     * @param bool  $form
     *
     * @throws HubSpotException
     * @return Body of request result
     *
     */
    public function post($url, $body, $form = FALSE)
    {
        // intialize cURL and send POST data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);    // new

        if ($formenc) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        }

        $output = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        $this->setLastStatusFromCurl($ch);
        curl_close($ch);

        if ( $errno > 0 )
            throw new HubSpotException('cURL error: ' . $error);
        else
            return $output;
    }

    /**
     * Executes HTTP POST request with JSON as the POST body
     *
     * @param URL String value for the URL to POST to
     * @param fields Array containing names and values for fields to post
     *
     * @return Body of request result
     *
     * @throws HubSpotException
     */
    protected function execute_JSON_post_request($url, $body)
    {
        // intialize cURL and send POST data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);    // new
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));    // new
        $output = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        $this->setLastStatusFromCurl($ch);
        curl_close($ch);

        if ( $errno > 0 )
            throw new HubSpotException('cURL error: ' . $error);
        else
            return $output;
    }

    /**
     * Executes HTTP POST request with XML as the POST body
     *
     * @param URL String value for the URL to POST to
     * @param fields Array containing names and values for fields to post
     *
     * @return Body of request result
     *
     * @throws HubSpotException
     */
    protected function execute_xml_post_request($url, $body)
    {
        // intialize cURL and send POST data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/atom+xml'));
        $output = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        $this->setLastStatusFromCurl($ch);
        curl_close($ch);

        if ( $errno > 0 )
            throw new HubSpotException('cURL error: ' . $error);
        else
            return $output;
    }

    /**
     * Executes HTTP PUT request
     *
     * @param URL String value for the URL to PUT to
     * @param body String value of the body of the PUT request
     *
     * @return Body of request result
     *
     * @throws HubSpotException
     */
    protected function execute_put_request($url, $body)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($body)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch);
        $apierr = curl_errno($ch);
        $errmsg = curl_error($ch);
        $this->setLastStatusFromCurl($ch);
        curl_close($ch);

        if ( $apierr > 0 )
            throw new HubSpotException('cURL error: ' . $errmsg);
        else
            return $result;
    }

    /**
     * Executes HTTP PUT request with XML as the PUT body
     *
     * @param URL String value for the URL to PUT to
     * @param body String value of the body of the PUT request
     *
     * @return Body of request result
     *
     * @throws HubSpotException
     */
    protected function execute_xml_put_request($url, $body)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/atom+xml','Content-Length: ' . strlen($body)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch);
        $apierr = curl_errno($ch);
        $errmsg = curl_error($ch);
        $this->setLastStatusFromCurl($ch);
        curl_close($ch);

        if ( $apierr > 0 )
            throw new HubSpotException('cURL error: ' . $errmsg);
        else
            return $result;
    }

    /**
     * Executes HTTP DELETE request
     *
     * @param URL String value for the URL to DELETE to
     * @param body String value of the body of the DELETE request
     *
     * @return Body of request result
     *
     * @throws HubSpotException
     */
    protected function execute_delete_request($url, $body)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($body)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch);
        $apierr = curl_errno($ch);
        $errmsg = curl_error($ch);
        $this->setLastStatusFromCurl($ch);
        curl_close($ch);

        if ( $apierr > 0 )
            throw new HubSpotException('cURL error: ' . $errmsg);
        else
            return $result;
    }

    /**
     * Converts an array into url friendly list of parameters
     *
     * @param array params Multidimensional array of parameters (name=>value)
     *
     * @return String of url friendly parameters (&name=value&foo=bar)
     */
    protected function array_to_params($params)
    {
        $paramString = '';

        if ( $params != NULL )
        {
            foreach ( $params as $parameter => $value )
            {
                if ( is_array($value) )
                {
                    foreach ( $value as $subparam )
                    {
                        $paramString = $paramString . '&' . $parameter . '=' . urlencode($subparam);
                    }
                }
                else
                {
                    $paramString = $paramString . '&' . $parameter . '=' . urlencode($value);
                }
            }
        }

        return $paramString;
    }

    /**
     * Utility function used to determine if variable is empty
     *
     * @param s Variable to be evaluated
     *
     * @returns Boolean
     */
    protected function isBlank ($s)
    {
        if ( (trim($s)=='') OR ($s == NULL) )
            return true;
        else
            return false;
    }

    /**
     * Sets the status code from a curl request
     *
     * @param resource $ch
     */
    protected function setLastStatusFromCurl($ch)
    {
        $info = curl_getinfo($ch);
        $this->lastStatus = (isset($info['http_code'])) ? $info['http_code'] : null;
    }

    public function post() {}

    public function get() {}
}