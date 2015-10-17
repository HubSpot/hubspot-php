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

        $options['body'] = $form;

        return $this->requestUrl('post', $url, $options);
    }

    /**
     * Get all forms.
     *
     * @return \Fungku\HubSpot\Http\Response
     */
    public function all()
    {
        $endpoint = "/contacts/v1/forms";

        return $this->request('get', $endpoint);
    }

    /**
     * Get a single form.
     *
     * @param string $form_guid
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getById($form_guid)
    {
        $endpoint = "/contacts/v1/forms/{$form_guid}";

        return $this->request('get', $endpoint);
    }

    /**
     * Create a new form.
     *
     * @param array $form
     * @return \Fungku\HubSpot\Http\Response
     */
    public function create($form)
    {
        $endpoint = "/contacts/v1/forms";

        $options['json'] = $form;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Update a form.
     *
     * @param string $form_guid
     * @param array  $form
     * @return \Fungku\HubSpot\Http\Response
     */
    public function update($form_guid, $form)
    {
        $endpoint = "/contacts/v1/forms/{$form_guid}";

        $options['json'] = $form;

        return $this->request('post', $endpoint, $options);
    }

    /**
     * Delete a form.
     *
     * @param string $form_guid
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($form_guid)
    {
        $endpoint = "/contacts/v1/forms/{$form_guid}";

        return $this->request('delete', $endpoint);
    }

    /**
     * Get all fields from a form.
     *
     * @param string $form_guid
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getFields($form_guid)
    {
        $endpoint = "/contacts/v1/fields/{$form_guid}";

        return $this->request('get', $endpoint);
    }

    /**
     * Get a single field from a form.
     *
     * @param string $form_guid
     * @param string $name
     * @return \Fungku\HubSpot\Http\Response
     */
    public function getFieldByName($form_guid, $name)
    {
        $endpoint = "/contacts/v1/fields/{$form_guid}/{$name}";

        return $this->request('get', $endpoint);
    }
}
