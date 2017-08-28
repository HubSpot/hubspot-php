<?php

namespace SevenShores\Hubspot\Resources;

class HubDB extends Resource
{
    /**
     * Get all tables
     *
     * @param int $portalId Hub/Portal ID
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function tables($portalId) {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables';

        $queryString = build_query_string(['portalId' => $portalId]);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get details about a table
     *
     * @param int $portalId Hub ID
     * @param int $tableId Table ID
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function tableInfo($portalId, $tableId) {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables/'.$tableId;

        $queryString = build_query_string(['portalId' => $portalId]);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Delete a table
     *
     * @param int $tableId Table ID
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function deleteTable($tableId) {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables/'.$tableId;

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Delete a row
     *
     * @param int $tableId Table ID
     * @param int $rowId Row ID
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function deleteRow($tableId, $rowId) {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables/'.$tableId.'/rows/'.$rowId;

        return $this->client->request('delete', $endpoint);
    }

    /**
     * @param string $name table name
     * @param array $columns column name and type should be represented as associative array, e.g. ["name" => "Name", "type" => "TEXT"], @see https://developers.hubspot.com/docs/methods/hubdb/create_table
     * @param bool $published whether to publish table
     * @param bool $useForPages use table for dynamic pages, see https://designers.hubspot.com/docs/tutorials/how-to-build-dynamic-pages-with-hubdb
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function createTable($name, array $columns, $published = true, $useForPages = false) {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables';
        $options['json'] = ['name' => $name, 'columns' => $columns];
        if($published) {
            $options['json']['publishedAt'] = round(microtime(true) * 1000);
        }
        $options['json']['useForPages'] = $useForPages;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Get table rows
     *
     * @param int $portalId Hub/Portal ID
     * @param int $tableId table ID
     * @param array $params key-value array to filter and sort rows
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function rows($portalId, $tableId, array $params)
    {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables/'.$tableId.'/rows';

        $queryString = build_query_string(array_merge(['portalId' => $portalId], $params));

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @param int $tableId table ID
     * @param array $values
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function addRow($tableId, array $values) {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables/'.$tableId.'/rows';
        $options['json'] = ['values' => $values];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @param int $tableId table ID
     * @param array $values
     * @param string $title page title for dynamic page
     * @param string $path path to access page (appended to domain to form page URL)
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function addRowForPage($tableId, array $values, $title = '', $path = '') {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables/'.$tableId.'/rows';
        $options['json'] = ['values' => $values, 'name' => $title, 'path' => $path];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * update database table row
     *
     * @param int   $tableId
     * @param int $rowId
     * @param array $values
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function updateRow($tableId, $rowId, array $values) {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables/'.$tableId.'/rows/'.$rowId;
        $options['json'] = ['values' => $values];

        return $this->client->request('post', $endpoint, $options);
    }
}