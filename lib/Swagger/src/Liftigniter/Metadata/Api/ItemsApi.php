<?php
/**
 * ItemsApi
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * liftigniter-metadata
 *
 * No descripton provided (generated by Swagger Codegen https://github.com/swagger-api/swagger-codegen)
 *
 * OpenAPI spec version: 0.1.0-SNAPSHOT
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Swagger\Client\Liftigniter\Metadata\Api;

use \Swagger\Client\Configuration;
use \Swagger\Client\ApiClient;
use \Swagger\Client\ApiException;
use \Swagger\Client\ObjectSerializer;

/**
 * ItemsApi Class Doc Comment
 *
 * @category Class
 * @package  Swagger\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ItemsApi
{

    /**
     * API Client
     *
     * @var \Swagger\Client\ApiClient instance of the ApiClient
     */
    protected $apiClient;

    /**
     * Constructor
     *
     * @param \Swagger\Client\ApiClient|null $apiClient The api client to use
     */
    public function __construct(\Swagger\Client\ApiClient $apiClient = null)
    {
        if ($apiClient == null) {
            $apiClient = new ApiClient();
            $apiClient->getConfig()->setHost('https://localhost/liftigniter-metadata');
        }

        $this->apiClient = $apiClient;
    }

    /**
     * Get API client
     *
     * @return \Swagger\Client\ApiClient get the API client
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }

    /**
     * Set the API client
     *
     * @param \Swagger\Client\ApiClient $apiClient set the API client
     *
     * @return ItemsApi
     */
    public function setApiClient(\Swagger\Client\ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * Operation createItem
     *
     * 
     *
     * @param \Swagger\Client\Liftigniter\Metadata\Models\ItemDto $body  (optional)
     * @return void
     * @throws \Swagger\Client\ApiException on non-2xx response
     */
    public function createItem($body = null)
    {
        list($response) = $this->createItemWithHttpInfo($body);
        return $response;
    }

    /**
     * Operation createItemWithHttpInfo
     *
     * 
     *
     * @param \Swagger\Client\Liftigniter\Metadata\Models\ItemDto $body  (optional)
     * @return Array of null, HTTP status code, HTTP response headers (array of strings)
     * @throws \Swagger\Client\ApiException on non-2xx response
     */
    public function createItemWithHttpInfo($body = null)
    {
        // parse inputs
        $resourcePath = "/items";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = $this->apiClient->selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(array());

        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('X-Wikia-AccessToken');
        if (strlen($apiKey) !== 0) {
            $headerParams['X-Wikia-AccessToken'] = $apiKey;
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('X-Wikia-UserId');
        if (strlen($apiKey) !== 0) {
            $headerParams['X-Wikia-UserId'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'POST',
                $queryParams,
                $httpBody,
                $headerParams,
                null,
                '/items'
            );

            return array(null, $statusCode, $httpHeader);
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }

            throw $e;
        }
    }

    /**
     * Operation deleteItem
     *
     * 
     *
     * @param string $product  (required)
     * @param string $id  (required)
     * @return void
     * @throws \Swagger\Client\ApiException on non-2xx response
     */
    public function deleteItem($product, $id)
    {
        list($response) = $this->deleteItemWithHttpInfo($product, $id);
        return $response;
    }

    /**
     * Operation deleteItemWithHttpInfo
     *
     * 
     *
     * @param string $product  (required)
     * @param string $id  (required)
     * @return Array of null, HTTP status code, HTTP response headers (array of strings)
     * @throws \Swagger\Client\ApiException on non-2xx response
     */
    public function deleteItemWithHttpInfo($product, $id)
    {
        // verify the required parameter 'product' is set
        if ($product === null) {
            throw new \InvalidArgumentException('Missing the required parameter $product when calling deleteItem');
        }
        // verify the required parameter 'id' is set
        if ($id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $id when calling deleteItem');
        }
        // parse inputs
        $resourcePath = "/items/{product}/{id}";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = $this->apiClient->selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(array());

        // path params
        if ($product !== null) {
            $resourcePath = str_replace(
                "{" . "product" . "}",
                $this->apiClient->getSerializer()->toPathValue($product),
                $resourcePath
            );
        }
        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                "{" . "id" . "}",
                $this->apiClient->getSerializer()->toPathValue($id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('X-Wikia-AccessToken');
        if (strlen($apiKey) !== 0) {
            $headerParams['X-Wikia-AccessToken'] = $apiKey;
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('X-Wikia-UserId');
        if (strlen($apiKey) !== 0) {
            $headerParams['X-Wikia-UserId'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'DELETE',
                $queryParams,
                $httpBody,
                $headerParams,
                null,
                '/items/{product}/{id}'
            );

            return array(null, $statusCode, $httpHeader);
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }

            throw $e;
        }
    }

    /**
     * Operation getItem
     *
     * 
     *
     * @param string $product  (required)
     * @param string $id  (required)
     * @return \Swagger\Client\Liftigniter\Metadata\Models\Item
     * @throws \Swagger\Client\ApiException on non-2xx response
     */
    public function getItem($product, $id)
    {
        list($response) = $this->getItemWithHttpInfo($product, $id);
        return $response;
    }

    /**
     * Operation getItemWithHttpInfo
     *
     * 
     *
     * @param string $product  (required)
     * @param string $id  (required)
     * @return Array of \Swagger\Client\Liftigniter\Metadata\Models\Item, HTTP status code, HTTP response headers (array of strings)
     * @throws \Swagger\Client\ApiException on non-2xx response
     */
    public function getItemWithHttpInfo($product, $id)
    {
        // verify the required parameter 'product' is set
        if ($product === null) {
            throw new \InvalidArgumentException('Missing the required parameter $product when calling getItem');
        }
        // verify the required parameter 'id' is set
        if ($id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $id when calling getItem');
        }
        // parse inputs
        $resourcePath = "/items/{product}/{id}";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = $this->apiClient->selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(array());

        // path params
        if ($product !== null) {
            $resourcePath = str_replace(
                "{" . "product" . "}",
                $this->apiClient->getSerializer()->toPathValue($product),
                $resourcePath
            );
        }
        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                "{" . "id" . "}",
                $this->apiClient->getSerializer()->toPathValue($id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('X-Wikia-AccessToken');
        if (strlen($apiKey) !== 0) {
            $headerParams['X-Wikia-AccessToken'] = $apiKey;
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('X-Wikia-UserId');
        if (strlen($apiKey) !== 0) {
            $headerParams['X-Wikia-UserId'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Swagger\Client\Liftigniter\Metadata\Models\Item',
                '/items/{product}/{id}'
            );

            return array($this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Liftigniter\Metadata\Models\Item', $httpHeader), $statusCode, $httpHeader);
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Liftigniter\Metadata\Models\Item', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getItems
     *
     * 
     *
     * @return \Swagger\Client\Liftigniter\Metadata\Models\Item[]
     * @throws \Swagger\Client\ApiException on non-2xx response
     */
    public function getItems()
    {
        list($response) = $this->getItemsWithHttpInfo();
        return $response;
    }

    /**
     * Operation getItemsWithHttpInfo
     *
     * 
     *
     * @return Array of \Swagger\Client\Liftigniter\Metadata\Models\Item[], HTTP status code, HTTP response headers (array of strings)
     * @throws \Swagger\Client\ApiException on non-2xx response
     */
    public function getItemsWithHttpInfo()
    {
        // parse inputs
        $resourcePath = "/items";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = $this->apiClient->selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(array());

        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('X-Wikia-AccessToken');
        if (strlen($apiKey) !== 0) {
            $headerParams['X-Wikia-AccessToken'] = $apiKey;
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('X-Wikia-UserId');
        if (strlen($apiKey) !== 0) {
            $headerParams['X-Wikia-UserId'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Swagger\Client\Liftigniter\Metadata\Models\Item[]',
                '/items'
            );

            return array($this->apiClient->getSerializer()->deserialize($response, '\Swagger\Client\Liftigniter\Metadata\Models\Item[]', $httpHeader), $statusCode, $httpHeader);
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Swagger\Client\Liftigniter\Metadata\Models\Item[]', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation updateItem
     *
     * 
     *
     * @param string $product  (required)
     * @param string $id  (required)
     * @param \Swagger\Client\Liftigniter\Metadata\Models\ItemDto $body  (optional)
     * @return void
     * @throws \Swagger\Client\ApiException on non-2xx response
     */
    public function updateItem($product, $id, $body = null)
    {
        list($response) = $this->updateItemWithHttpInfo($product, $id, $body);
        return $response;
    }

    /**
     * Operation updateItemWithHttpInfo
     *
     * 
     *
     * @param string $product  (required)
     * @param string $id  (required)
     * @param \Swagger\Client\Liftigniter\Metadata\Models\ItemDto $body  (optional)
     * @return Array of null, HTTP status code, HTTP response headers (array of strings)
     * @throws \Swagger\Client\ApiException on non-2xx response
     */
    public function updateItemWithHttpInfo($product, $id, $body = null)
    {
        // verify the required parameter 'product' is set
        if ($product === null) {
            throw new \InvalidArgumentException('Missing the required parameter $product when calling updateItem');
        }
        // verify the required parameter 'id' is set
        if ($id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $id when calling updateItem');
        }
        // parse inputs
        $resourcePath = "/items/{product}/{id}";
        $httpBody = '';
        $queryParams = array();
        $headerParams = array();
        $formParams = array();
        $_header_accept = $this->apiClient->selectHeaderAccept(array('application/json'));
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(array());

        // path params
        if ($product !== null) {
            $resourcePath = str_replace(
                "{" . "product" . "}",
                $this->apiClient->getSerializer()->toPathValue($product),
                $resourcePath
            );
        }
        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                "{" . "id" . "}",
                $this->apiClient->getSerializer()->toPathValue($id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('X-Wikia-AccessToken');
        if (strlen($apiKey) !== 0) {
            $headerParams['X-Wikia-AccessToken'] = $apiKey;
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('X-Wikia-UserId');
        if (strlen($apiKey) !== 0) {
            $headerParams['X-Wikia-UserId'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'PUT',
                $queryParams,
                $httpBody,
                $headerParams,
                null,
                '/items/{product}/{id}'
            );

            return array(null, $statusCode, $httpHeader);
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }

            throw $e;
        }
    }

}
