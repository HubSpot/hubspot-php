<?php

namespace SevenShores\Hubspot\Resources;

class Forms extends Resource
{
    /**
     * Submit data to a form.
     *
     * @see http://developers.hubspot.com/docs/methods/forms/submit_form
     *
     * Send form submission data to HubSpot. Form submissions from external sources can be made to any registered
     * HubSpot form. You can see a list of forms on your portal by going to the Contacts > Forms page
     *
     * @param int    $portal_id
     * @param string $form_guid
     * @param array  $form
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function submit($portal_id, $form_guid, array $form)
    {
        $endpoint = "https://forms.hubspot.com/uploads/form/v2/{$portal_id}/{$form_guid}";

        if (!empty($form['hs_context']) && !is_string($form['hs_context'])) {
            $form['hs_context'] = json_encode($form['hs_context']);
        }

        $options['form_params'] = $form;

        return $this->client->request('post', $endpoint, $options, null, false);
    }

    /**
     * Return all forms that have been created in the portal.
     *
     * @see http://developers.hubspot.com/docs/methods/forms/v2/get_forms
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all()
    {
        $endpoint = 'https://api.hubapi.com/forms/v2/forms';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Return a single form based on the unique ID of that form.
     *
     * @see http://developers.hubspot.com/docs/methods/forms/v2/get_form
     *
     * @param string $form_guid
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($form_guid)
    {
        $endpoint = "https://api.hubapi.com/forms/v2/forms/{$form_guid}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a new form.
     *
     * @see http://developers.hubspot.com/docs/methods/forms/v2/create_form
     *
     * @param array $form
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create(array $form)
    {
        $endpoint = 'https://api.hubapi.com/forms/v2/forms';

        return $this->client->request('post', $endpoint, ['json' => $form]);
    }

    /**
     * Update an existing form.
     *
     * @see http://developers.hubspot.com/docs/methods/forms/v2/update_form
     *
     * @param string $form_guid
     * @param array  $form
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($form_guid, array $form)
    {
        $endpoint = "https://api.hubapi.com/forms/v2/forms/{$form_guid}";

        return $this->client->request('post', $endpoint, ['json' => $form]);
    }

    /**
     * Delete an existing form.
     *
     * @see http://developers.hubspot.com/docs/methods/forms/v2/delete_form
     *
     * @param string $form_guid
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($form_guid)
    {
        $endpoint = "https://api.hubapi.com/forms/v2/forms/{$form_guid}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * Get all fields from a form.
     *
     * @see http://developers.hubspot.com/docs/methods/forms/v2/get_fields
     *
     * @param string $form_guid
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getFields($form_guid)
    {
        $endpoint = "https://api.hubapi.com/forms/v2/fields/{$form_guid}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get a single field from a form.
     *
     * @see http://developers.hubspot.com/docs/methods/forms/v2/get_field
     *
     * @param string $form_guid
     * @param string $name
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getFieldByName($form_guid, $name)
    {
        $endpoint = "https://api.hubapi.com/forms/v2/fields/{$form_guid}/{$name}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get all submissions from a form.
     *
     * @see https://developers.hubspot.com/docs/methods/forms/get-submissions-for-a-form
     *
     * @param string $form_guid
     * @param mixed  $params
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getSubmissions($form_guid, $params = [])
    {
        $endpoint = "https://api.hubapi.com/form-integrations/v1/submissions/forms/{$form_guid}";

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * Get a file uploaded via form by url.
     *
     * @param string $url
     *
     * @see https://developers.hubspot.com/docs/methods/form-integrations/v1/uploaded-files/signed-url-redirect
     */
    public function getUploadedFileByUrl($url)
    {
        $endpoint = $url;
        $query_string = null;
        $parsed = explode('?', $url);

        if (2 == count($parsed)) {
            $endpoint = $parsed[0];
            $query_string = $parsed[1];
        }

        return $this->client->request(
            'get',
            $endpoint,
            ['allow_redirects' => true],
            $query_string
        );
    }

    /**
     * Get a file uploaded via form by id.
     *
     * @param int|string $id
     * @param string     $sign
     * @param mixed      $params
     *
     * @see https://developers.hubspot.com/docs/methods/form-integrations/v1/uploaded-files/signed-url-redirect
     */
    public function getUploadedFileById($id, $sign, $params = [])
    {
        $endpoint = "https://api.hubspot.com/form-integrations/v1/uploaded-files/signed-url-redirect/{$id}";
        $params['sign'] = $sign;

        return $this->client->request(
            'get',
            $endpoint,
            ['allow_redirects' => true],
            http_build_query($params)
        );
    }
}
