<?php

namespace Fungku\HubSpot\Api;

class Files extends Api
{
    /**
     * Upload a new file.
     *
     * @param string $file   File path
     * @param array  $params Optional parameters
     *
     * @return mixed
     */
    public function upload($file, $params)
    {
        $endpoint = "/filemanager/api/v2/files";

        $options['query'] = isset($params['overwrite']) ? $params['overwrite'] : false;

        $options['body'] = array(
            'files'        => fopen($file, 'rb'),
            'file_names'   => isset($params['file_names']) ? $params['file_names'] : null,
            'folder_paths' => isset($params['folder_paths']) ? $params['folder_paths'] : null,
        );

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Get meta data for all files.
     *
     * @param array $params Optional parameters
     *
     * @return mixed
     */
    public function allFiles($params)
    {
        $endpoint = "/filemanager/api/v2/files";

        $options['json'] = $params;

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Upload a replacement file.
     *
     * @param int    $file_id The file ID
     * @param string $file    The file path
     *
     * @return mixed
     */
    public function replace($file_id, $file)
    {
        $endpoint = "/filemanager/api/v2/files/{$file_id}";

        $options['body'] = array(
            'files' => fopen($file, 'rb'),
        );

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Get file metadata.
     *
     * @param string $file_id File ID
     *
     * @return mixed
     */
    public function meta($file_id)
    {
        $endpoint = "/filemanager/api/v2/files/{$file_id}";

        return $this->request('get', $endpoint);
    }

    /**
     * Archive a file.
     *
     * @param int $file_id The file ID
     *
     * @return mixed
     */
    public function archive($file_id)
    {
        $endpoint = "/filemanager/api/v2/files/{$file_id}/archive";

        return $this->request('post', $endpoint);
    }

    /**
     * Delete a file.
     *
     * @param int $file_id The file ID
     *
     * @return mixed
     */
    public function delete($file_id)
    {
        $endpoint = "/filemanager/api/v2/files/{$file_id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Move a file to a new folder.
     *
     * Parameters:
     * Folder_path  string  The path of the folder to move the file into. Use this OR folder_id - not both.
     * Folder_id    string  The id of the folder to move the file into. Use this OR folder_path - not both.
     * Name         string  The new name of the file
     *
     * @param int   $file_id File ID
     * @param array $params  Parameters
     *
     * @return mixed
     */
    public function move($file_id, array $params)
    {
        $endpoint = "/filemanager/api/v2/files/{$file_id}/move-file";

        $options['json'] = $params;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Create a new folder.
     *
     * @param string $folder_name      Folder name
     * @param int    $parent_folder_id Parent folder ID
     *
     * @return mixed
     */
    public function createFolder($folder_name, $parent_folder_id)
    {
        $endpoint = "/filemanager/api/v2/folders";

        $options['json'] = array(
            'folder_name'      => $folder_name,
            'parent_folder_id' => $parent_folder_id,
        );

        return $this->request('post', $endpoint, $options);
    }

    /**
     * List folders metadata.
     *
     * @param array $params Parameters
     *
     * @return mixed
     */
    public function folders($params)
    {
        $endpoint = "/filemanager/api/v2/folders";

        $options['json'] = $params;

        return $this->request('get', $endpoint, $options);
    }

    /**
     * Update a folder.
     *
     * @param int   $folder_id Folder ID
     * @param array $params    Parameters
     *
     * @return mixed
     */
    public function updateFolder($folder_id, array $params)
    {
        $endpoint = "/filemanager/api/v2/folders/{$folder_id}";

        $options['json'] = $params;

        return $this->request('put', $endpoint, $options);
    }

    /**
     * Delete a folder.
     *
     * @param int $folder_id Folder ID
     *
     * @return mixed
     */
    public function deleteFolder($folder_id)
    {
        $endpoint = "/filemanager/api/v2/folders/{$folder_id}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Get the folder by ID.
     *
     * @param int $folder_id Folder ID
     *
     * @return mixed
     */
    public function getFolderById($folder_id)
    {
        $endpoint = "/filemanager/api/v2/folders/{$folder_id}";

        return $this->request('get', $endpoint);
    }

    /**
     * Move a folder.
     *
     * @param int   $folder_id Folder ID
     * @param array $params    Params
     *
     * @return mixed
     */
    public function moveFolder($folder_id, array $params)
    {
        $endpoint = "/filemanager/api/v2/folders/{$folder_id}/move-folder";

        $options['json'] = $params;

        return $this->request('post', $endpoint, $options);
    }
}
