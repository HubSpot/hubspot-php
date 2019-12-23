<?php

namespace SevenShores\Hubspot\Resources;

/**
 * @see https://developers.hubspot.com/docs/methods/hubdb/hubdb_overview
 */
class HubDB extends Resource
{
    /**
     * Get all tables.
     *
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/get_tables
     * 
     * @param array $params You can set some specific params (E.g. Hub/Portal ID)
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function tables(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v2/tables';

        return $this->client->request(
                'get',
                $endpoint,
                [],
                build_query_string($params)
            );
    }

    /**
     * Get details for a specific table.
     * 
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/get_table
     *
     * @param int $portalId Hub ID
     * @param int $tableId  Table ID
     * @param bool $draft Description
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function getTable($portalId, $tableId, $draft = false, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}";
        if ($draft) {
            $endpoint .= '/draft';
        }

        $params['portalId'] = $portalId;

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params)
        );
    }
    

    /**
     * Create a new Table.
     * 
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/create_table
     * 
     * @param string $name        table name
     * @param array  $columns     column name and type should be represented as associative array, e.g. ["name" => "Name", "type" => "TEXT"], @see https://developers.hubspot.com/docs/methods/hubdb/create_table
     * @param bool   $published   whether to publish table
     * @param bool   $useForPages use table for dynamic pages, see https://designers.hubspot.com/docs/tutorials/how-to-build-dynamic-pages-with-hubdb
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function createTable($name, array $columns, $published = true, $useForPages = false)
    {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v2/tables';
        $options = ['json' => 
            [
                'name' => $name,
                'columns' => $columns,
                'useForPages' => $useForPages
            ]
        ];
        
        if ($published) {
            $options['json']['publishedAt'] = round(microtime(true) * 1000);
        }

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Clone a Table.
     * 
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/clone_table
     *
     * @param int $tableId
     * @param string $newName 
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function cloneTable($tableId, $newName, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}/clone";

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => ['newName' => $newName]],
            build_query_string($params)
        );
    }
    

    /**
     * Update a table.
     * 
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/update_table
     * 
     * @param int $tableId
     * @param string $name        table name
     * @param array  $columns     column name and type should be represented as associative array, e.g. ["name" => "Name", "type" => "TEXT"], @see https://developers.hubspot.com/docs/methods/hubdb/create_table
     * @param bool   $published   whether to publish table
     * @param bool   $useForPages use table for dynamic pages, see https://designers.hubspot.com/docs/tutorials/how-to-build-dynamic-pages-with-hubdb
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function updateTable($tableId, $name, array $columns = [], $published = true, $useForPages = false)
    {
        $endpoint = "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}";
        $options = ['json' => 
            [
                'name' => $name,
                'columns' => $columns,
                'useForPages' => $useForPages
            ]
        ];
        
        if ($published) {
            $options['json']['publishedAt'] = round(microtime(true) * 1000);
        }

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a table.
     *
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/delete_table
     * 
     * @param int $tableId Table ID
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function deleteTable($tableId)
    {
        $endpoint = "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get table rows.
     * 
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/get_table_rows
     *
     * @param int   $portalId Hub/Portal ID
     * @param int   $tableId  table ID
     * @param array $params   key-value array to filter and sort rows
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function getRows($portalId, $tableId, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}/rows";

        $params['portalId'] = $portalId;

        return $this->client->request('get', $endpoint, [], build_query_string($params));
    }

    /**
     * Add a new row to a table.
     * 
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/create_row
     * 
     * @param int $tableId table ID
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function addRow($tableId, array $values)
    {
        $endpoint = "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}/rows";

        return $this->client->request(
            'post',
            $endpoint,
            ['json' => ['values' => $values]]
        );
    }

    /**
     * Delete a row.
     *
     * @param int $tableId Table ID
     * @param int $rowId   Row ID
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function deleteRow($tableId, $rowId)
    {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables/'.$tableId.'/rows/'.$rowId;

        return $this->client->request('delete', $endpoint);
    }

    /**
     * @param int    $tableId table ID
     * @param string $title   page title for dynamic page
     * @param string $path    path to access page (appended to domain to form page URL)
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function addRowForPage($tableId, array $values, $title = '', $path = '')
    {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables/'.$tableId.'/rows';
        $options['json'] = ['values' => $values, 'name' => $title, 'path' => $path];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * update database table row.
     *
     * @param int $tableId
     * @param int $rowId
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function updateRow($tableId, $rowId, array $values)
    {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v1/tables/'.$tableId.'/rows/'.$rowId;
        $options['json'] = ['values' => $values];

        return $this->client->request('put', $endpoint, $options);
    }
}
