<?php

namespace SevenShores\Hubspot\Resources;

class Files extends Resource
{
    /**
     * Upload a new file.
     *
     * @param resource|string $file
     * @param array           $params Optional parameters
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function upload($file, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/filemanager/api/v2/files';

        $queryString = build_query_string([
            'overwrite' => isset($params['overwrite']) ? $params['overwrite'] : false,
            'hidden' => isset($params['hidden']) ? $params['hidden'] : false,
        ]);

        $options['multipart'] = [
            [
                'name' => 'files',
                'contents' => $this->getResource($file),
            ],
            [
                'name' => 'file_names',
                'contents' => isset($params['file_names']) ? $params['file_names'] : null,
            ], [
                'name' => 'folder_paths',
                'contents' => isset($params['folder_paths']) ? $params['folder_paths'] : null,
            ],
        ];

        return $this->client->request('post', $endpoint, $options, $queryString);
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
     * Upload new files.
     *
     * @param array $params Optional parameters
     *
     * @return \SevenShores\Hubspot\Http\Response
     *
     * @see https://developers.hubspot.com/docs/methods/files/post_files
     */
    public function batchUpload(array $files, array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/filemanager/api/v2/files';

        $queryString = build_query_string([
            'overwrite' => isset($params['overwrite']) ? $params['overwrite'] : false,
            'hidden' => isset($params['hidden']) ? $params['hidden'] : false,
        ]);

        return $this->client->request(
            'post',
            $endpoint,
            ['multipart' => $this->getMultipart($files, $params)],
            $queryString
        );
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

    /**
     * @param array $files array of Resoures or filenames
     *
     * @return string
     */
    protected function getMultipart(array $files, array $params)
    {
        $multipart = [];

        foreach ($files as $key => $file) {
            $multipart[] = [
                'name' => 'files',
                'contents' => $this->getResource($file),
            ];

            $multipart[] = [
                'name' => 'file_names',
                'contents' => $this->getOptionValue($key, 'file_names', $params),
            ];

            $multipart[] = [
                'name' => 'folder_paths',
                'contents' => $this->getOptionValue($key, 'folder_paths', $params),
            ];
        }

        return $multipart;
    }

    protected function getOptionValue($key, $option, array $params)
    {
        if (isset($params[$option]) && array_key_exists($key, $params[$option])) {
            return $params[$option][$key];
        }

        return null;
    }
}
