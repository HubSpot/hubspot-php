<?php

namespace SevenShores\Hubspot\Endpoints;

/**
 * @see https://developers.hubspot.com/docs/methods/hubdb/hubdb_overview
 */
class HubDB extends Endpoint
{
    /**
     * Get all tables.
     *
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/get_tables
     *
     * @param array $params You can set some specific params (E.g. Hub/Portal ID).
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
     * @param int   $tableId  Table ID
     * @param int   $portalId
     * @param array $params   You can set some specific params (E.g. Hub/Portal ID).
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function getTable($tableId, $portalId = null, bool $draft = false, array $params = [])
    {
        $endpoint = $this->getEndpoint("https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}", $draft);
        if (!empty($portalId)) {
            $params['portalId'] = $portalId;
        }

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params),
            boolval($draft)
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
    public function createTable($name, array $columns, bool $published = true, bool $useForPages = false)
    {
        $endpoint = 'https://api.hubapi.com/hubdb/api/v2/tables';
        $options = ['json' => [
            'name' => $name,
            'columns' => $columns,
            'useForPages' => $useForPages,
        ],
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
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function cloneTable($tableId, string $newName, bool $draft = false, array $params = [])
    {
        $endpoint = $this->getEndpoint(
            "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}/clone",
            $draft
        );

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
     * @param int    $tableId
     * @param string $name        table name
     * @param array  $columns     column name and type should be represented as associative array, e.g. ["name" => "Name", "type" => "TEXT"]
     * @param bool   $published   whether to publish table
     * @param bool   $useForPages use table for dynamic pages, see https://designers.hubspot.com/docs/tutorials/how-to-build-dynamic-pages-with-hubdb
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function updateTable($tableId, string $name, array $columns = [], bool $draft = false, bool $published = true, bool $useForPages = false)
    {
        $endpoint = $this->getEndpoint(
            "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}",
            $draft
        );
        $options = ['json' => [
            'name' => $name,
            'columns' => $columns,
            'useForPages' => $useForPages,
        ],
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
     * @param int   $tableId  table ID
     * @param int   $portalId
     * @param array $params   You can set some specific params (E.g. Hub/Portal ID).
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function getRows($tableId, $portalId = null, bool $draft = false, array $params = [])
    {
        $endpoint = $this->getEndpoint(
            "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}/rows",
            $draft
        );
        if (!empty($portalId)) {
            $params['portalId'] = $portalId;
        }

        return $this->client->request(
            'get',
            $endpoint,
            [],
            build_query_string($params),
            boolval($draft)
        );
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
    public function addRow($tableId, array $values, bool $draft = false, string $name = null, string $path = null)
    {
        $endpoint = $this->getEndpoint(
            "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}/rows",
            $draft
        );

        return $this->client->request(
            'post',
            $endpoint,
            $this->getBody($values, $name, $path)
        );
    }

    /**
     * Clone a Row.
     *
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/clone_row
     *
     * @param int $tableId table ID
     * @param int $rowId   row ID
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function cloneRow($tableId, $rowId, bool $draft = false)
    {
        $endpoint = $this->getEndpoint(
            "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}/rows/{$rowId}/clone",
            $draft
        );

        return $this->client->request(
            'post',
            $endpoint
        );
    }

    /**
     * Update a row.
     *
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/update_row
     *
     * @param int $tableId
     * @param int $rowId
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function updateRow($tableId, $rowId, array $values, string $name = null, string $path = null)
    {
        $endpoint = "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}/rows/{$rowId}";

        return $this->client->request(
            'put',
            $endpoint,
            $this->getBody($values, $name, $path)
        );
    }

    /**
     * Delete a row.
     *
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/delete_row
     *
     * @param int $tableId Table ID
     * @param int $rowId   Row ID
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function deleteRow($tableId, $rowId, bool $draft = false)
    {
        $endpoint = $this->getEndpoint(
            "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}/rows/{$rowId}",
            $draft
        );

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Update a specific cell.
     *
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/update_row
     *
     * @param int $tableId
     * @param int $rowId
     * @param int $cellId
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function updateCell($tableId, $rowId, $cellId, array $values, bool $draft = false)
    {
        $endpoint = $this->getEndpoint(
            "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}/rows/{$rowId}/cells/{$cellId}",
            $draft
        );

        return $this->client->request(
            'put',
            $endpoint,
            ['json' => $values]
        );
    }

    /**
     * Delete a row.
     *
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/delete_cell
     *
     * @param int   $tableId Table ID
     * @param int   $rowId   Row ID
     * @param mixed $cellId
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function deleteCell($tableId, $rowId, $cellId, bool $draft = false)
    {
        $endpoint = $this->getEndpoint(
            "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}/rows/{$rowId}/cells/{$cellId}",
            $draft
        );

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Publish the draft data for a table.
     *
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/publish-draft-table
     *
     * @param int $tableId
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function publishDraftTable($tableId)
    {
        $endpoint = "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}/publish";

        return $this->client->request('put', $endpoint);
    }

    /**
     * Revert the draft data for a table.
     *
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/revert-draft-data-for-table
     *
     * @param int $tableId
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function revertDraftTable($tableId)
    {
        $endpoint = "https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}/revert";

        return $this->client->request('put', $endpoint);
    }

    /**
     * Import a CSV.
     *
     * @see https://developers.hubspot.com/docs/methods/hubdb/v2/import_csv
     *
     * @param int $tableId
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function import($tableId, string $file, array $cofig = [], bool $draft = false)
    {
        $endpoint = $this->getEndpoint("https://api.hubapi.com/hubdb/api/v2/tables/{$tableId}/import", $draft);

        return $this->client->request('post', $endpoint, [
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => file_get_contents($file),
                ],
                [
                    'name' => 'config',
                    'contents' => json_encode($cofig).';type=application/json',
                ],
            ],
        ]);
    }

    /**
     * Get body.
     */
    protected function getBody(array $values, string $name = null, string $path = null): array
    {
        return [
            'json' => array_filter([
                'values' => $values,
                'name' => $name,
                'path' => $path,
            ], function ($value) {
                return !empty($value);
            }),
        ];
    }

    /**
     * Get Endpoint.
     */
    protected function getEndpoint(string $endpoint, bool $draft = false): string
    {
        if ($draft) {
            return $endpoint.'/draft';
        }

        return $endpoint;
    }
}
