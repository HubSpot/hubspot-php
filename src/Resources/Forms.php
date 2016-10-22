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
     * @return \SevenShores\Hubspot\Http\Response
     */
    function submit($portal_id, $form_guid, $form)
    {
        $endpoint = "https://forms.hubspot.com/uploads/form/v2/{$portal_id}/{$form_guid}";

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
    function all()
    {
        $endpoint = "https://api.hubapi.com/forms/v2/forms";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Return a single form based on the unique ID of that form.
     *
     * @see http://developers.hubspot.com/docs/methods/forms/v2/get_form
     *
     * @param string $form_guid
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getById($form_guid)
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
     * @return \SevenShores\Hubspot\Http\Response
     */
    function create($form)
    {
        $endpoint = "https://api.hubapi.com/forms/v2/forms";

        $options['json'] = $form;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Update an existing form.
     *
     * @see http://developers.hubspot.com/docs/methods/forms/v2/update_form
     *
     * @param string $form_guid
     * @param array  $form
     * @return \SevenShores\Hubspot\Http\Response
     */
    function update($form_guid, $form)
    {
        $endpoint = "https://api.hubapi.com/forms/v2/forms/{$form_guid}";

        $options['json'] = $form;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Delete an existing form.
     *
     * @see http://developers.hubspot.com/docs/methods/forms/v2/delete_form
     *
     * @param string $form_guid
     * @return \SevenShores\Hubspot\Http\Response
     */
    function delete($form_guid)
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
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getFields($form_guid)
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
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getFieldByName($form_guid, $name)
    {
        $endpoint = "https://api.hubapi.com/forms/v2/fields/{$form_guid}/{$name}";

        return $this->client->request('get', $endpoint);
    }
}
