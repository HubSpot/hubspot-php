<?php

namespace SevenShores\Hubspot\Endpoints;

class Files extends Endpoint
{
    /**
     * Upload a new file.
     *
     * @param resource|string $file
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     *@see https://legacydocs.hubspot.com/docs/methods/files/v3/upload_new_file
     */
    public function upload(
        $file,
        array $options = [],
        string $folderPath = '/',
        string $fileName = null,
        string $folderId = null,
        string $charsetHunch = null
    ) {
        $endpoint = 'https://api.hubapi.com/filemanager/api/v3/files/upload';

        $multipart = [
            [
                'name' => 'file',
                'contents' => $this->getResource($file),
            ], [
                'name' => 'options',
                'contents' => json_encode(array_merge($this->getDefaultOptions(), $options)),
            ], [
                'name' => 'folderPath',
                'contents' => $folderPath,
            ],
        ];

        return $this->client->request(
            'post',
            $endpoint,
            [
                'multipart' => array_merge($multipart, $this->getAdditionalParams([
                    'fileName' => $fileName,
                    'folderId' => $folderId,
                    'charsetHunch' => $charsetHunch,
                ])),
            ]
        );
    }

    /**
     * @param resource|string $file
     *
     * @return resource
     */
    public function getResource($file)
    {
        if (is_resource($file)) {
            return $file;
        }

        return fopen($file, 'rb');
    }

    /**
     * Get meta data for all files.
     *
     * @param array $params Optional parameters
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/filemanager/api/v2/files';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Upload a replacement file.
     *
     * @param int             $file_id The file ID
     * @param resource|string $file    The file path
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function replace($file_id, $file)
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/files/{$file_id}";

        $options['multipart'] = [
            [
                'name' => 'files',
                'contents' => $this->getResource($file),
            ],
        ];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Get file metadata.
     *
     * @param $file_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function meta($file_id)
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/files/{$file_id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Archive a file.
     *
     * @param int $file_id The file ID
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function archive($file_id)
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/files/{$file_id}/archive";

        return $this->client->request('post', $endpoint);
    }

    /**
     * Delete a file.
     *
     * @param int $file_id The file ID
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($file_id)
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
     * @param int $file_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function move($file_id, array $params = [])
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
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function createFolder($folder_name, $parent_folder_id)
    {
        $endpoint = 'https://api.hubapi.com/filemanager/api/v2/folders';

        $options['json'] = [
            'name' => $folder_name,
            'parent_folder_id' => $parent_folder_id,
        ];

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * List folders metadata.
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function folders(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/filemanager/api/v2/folders';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Update a folder.
     *
     * @param int $folder_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateFolder($folder_id, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/folders/{$folder_id}";

        $options['json'] = $params;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a folder.
     *
     * @param int $folder_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function deleteFolder($folder_id)
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/folders/{$folder_id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get the folder by ID.
     *
     * @param int $folder_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getFolderById($folder_id)
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/folders/{$folder_id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Move a folder.
     *
     * @param int $folder_id
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function moveFolder($folder_id, array $params = [])
    {
        $endpoint = "https://api.hubapi.com/filemanager/api/v2/folders/{$folder_id}/move-folder";

        $options['json'] = $params;

        return $this->client->request('post', $endpoint, $options);
    }

    protected function getAdditionalParams(array $params): array
    {
        $results = [];

        foreach ($params as $name => $contents) {
            if (!empty($contents)) {
                $results[] = [
                    'name' => $name,
                    'contents' => $contents,
                ];
            }
        }

        return $results;
    }

    protected function getDefaultOptions(): array
    {
        return [
            'access' => 'PUBLIC_INDEXABLE',
        ];
    }
}
