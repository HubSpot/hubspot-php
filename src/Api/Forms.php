<?php

namespace Fungku\HubSpot\Api;

class Forms extends Api
{
    /**
     * Submit data to a form.
     *
     * @link http://developers.hubspot.com/docs/methods/forms/submit_form
     *
     * Send form submission data to HubSpot. Form submissions from external sources can be made to any registered
     * HubSpot form. You can see a list of forms on your portal by going to the Contacts > Forms page
     *
     * @param int    $portal_id
     * @param string $form_guid
     * @param array  $form
     * @return \Fungku\HubSpot\Http\Response
     */
    public function submit($portal_id, $form_guid, $form)
    {
        $url = "https://forms.hubspot.com/uploads/form/v2/{$portal_id}/{$form_guid}";

        $options['form_params'] = $form;

        return $this->requestUrl('post', $url, $options);
    }

    /**
     * Return all forms that have been created in the portal.
     *
     * @link http://developers.hubspot.com/docs/methods/forms/v2/get_forms
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function all()
    {
        $endpoint = "/forms/v2/forms";

        return $this->request('get', $endpoint);
    }

    /**
     * Return a single form based on the unique ID of that form.
     *
     * @link http://developers.hubspot.com/docs/methods/forms/v2/get_form
     *
     * @param string $form_guid
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getById($form_guid)
    {
        $endpoint = "/forms/v2/forms/{$form_guid}";

        return $this->request('get', $endpoint);
    }

    /**
     * Create a new form.
     *
     * @link http://developers.hubspot.com/docs/methods/forms/v2/create_form
     *
     * @param array $form
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($form)
    {
        $endpoint = "/forms/v2/forms";

        $options['json'] = $form;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Update an existing form.
     *
     * @link http://developers.hubspot.com/docs/methods/forms/v2/update_form
     *
     * @param string $form_guid
     * @param array  $form
     * @return \Fungku\HubSpot\Http\Response
     */
    public function update($form_guid, $form)
    {
        $endpoint = "/forms/v2/forms/{$form_guid}";

        $options['json'] = $form;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Delete an existing form.
     *
     * @link http://developers.hubspot.com/docs/methods/forms/v2/delete_form
     *
     * @param string $form_guid
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($form_guid)
    {
        $endpoint = "/forms/v2/forms/{$form_guid}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Get all fields from a form.
     *
     * @link http://developers.hubspot.com/docs/methods/forms/v2/get_fields
     *
     * @param string $form_guid
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getFields($form_guid)
    {
        $endpoint = "/forms/v2/fields/{$form_guid}";

        return $this->request('get', $endpoint);
    }

    /**
     * Get a single field from a form.
     *
     * @link http://developers.hubspot.com/docs/methods/forms/v2/get_field
     *
     * @param string $form_guid
     * @param string $name
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getFieldByName($form_guid, $name)
    {
        $endpoint = "/forms/v2/fields/{$form_guid}/{$name}";

        return $this->request('get', $endpoint);
    }
}
