<?php

namespace SevenShores\Hubspot\Resources;

class Files extends Resource
{
    /**
     * Upload a new file.
     *
     * @param string $file   File path
     * @param array  $params Optional parameters
     * @return \SevenShores\Hubspot\Http\Response
     */
    function upload($file, $params = [])
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/files";

        $queryString = build_query_string([
            'overwrite' => isset($params['overwrite']) ? $params['overwrite'] : false,
        ]);

        $options['multipart'] = [
            [
                'name' => 'files',
                'contents' => fopen($file, 'rb')
            ],
            [
                'name' => 'file_names',
                'contents' => isset($params['file_names']) ? $params['file_names'] : null
            ],[
                'name' => 'folder_paths',
                'contents' => isset($params['folder_paths']) ? $params['folder_paths'] : null
            ]
        ];

        return $this->client->request('post', $endpoint, $options, $queryString);
    }

    /**
     * Get meta data for all files.
     *
     * @param array $params Optional parameters
     * @return \SevenShores\Hubspot\Http\Response
     */
    function all($params = [])
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/files";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }


    /**
     * Upload a replacement file.
     *
     * @param int    $file_id The file ID
     * @param string $file    The file path
     * @return \SevenShores\Hubspot\Http\Response
     */
    function replace($file_id, $file)
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/files/{$file_id}";

        $options['body'] = [
            'files' => fopen($file, 'rb'),
        ];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Get file metadata.
     *
     * @param $file_id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function meta($file_id)
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/files/{$file_id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Archive a file.
     *
     * @param int $file_id The file ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function archive($file_id)
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/files/{$file_id}/archive";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Delete a file.
     *
     * @param int $file_id The file ID
     * @return \SevenShores\Hubspot\Http\Response
     */
    function delete($file_id)
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/files/{$file_id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Move a file to a new folder.
     *
     * Parameters:
     * folder_path  string    The path of the folder to move the file into. Use this OR folder_id - not both.
     * folder_id    string    The id of the folder to move the file into. Use this OR folder_path - not both.
     * name            string    The new name of the file.
     *
     * @param int   $file_id
     * @param array $params
     * @return \SevenShores\Hubspot\Http\Response
     */
    function move($file_id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/files/{$file_id}/move-file";

        $options['json'] = $params;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Create a new folder.
     *
     * @param string $folder_name
     * @param int    $parent_folder_id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function createFolder($folder_name, $parent_folder_id)
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/folders";

        $options['json'] = [
            'folder_name'      => $folder_name,
            'parent_folder_id' => $parent_folder_id,
        ];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * List folders metadata.
     *
     * @param array $params
     * @return \SevenShores\Hubspot\Http\Response
     */
    function folders($params = [])
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/folders";

        $options['json'] = $params;

        return $this->client->request('get', $endpoint, $options);
    }

    /**
     * Update a folder.
     *
     * @param int   $folder_id
     * @param array $params
     * @return \SevenShores\Hubspot\Http\Response
     */
    function updateFolder($folder_id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/folders/{$folder_id}";

        $options['json'] = $params;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a folder.
     *
     * @param int $folder_id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function deleteFolder($folder_id)
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/folders/{$folder_id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get the folder by ID.
     *
     * @param int $folder_id
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getFolderById($folder_id)
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/folders/{$folder_id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Move a folder.
     *
     * @param int   $folder_id
     * @param array $params
     * @return \SevenShores\Hubspot\Http\Response
     */
    function moveFolder($folder_id, $params = [])
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/folders/{$folder_id}/move-folder";

        $options['json'] = $params;

        return $this->client->request('post', $endpoint, $options);
    }

}
