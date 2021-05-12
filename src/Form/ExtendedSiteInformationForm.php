<?php

namespace Drupal\eere_app_module\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;


class ExtendedSiteInformationForm extends SiteInformationForm {

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $site_config = $this->config('system.site');
        $form =  parent::buildForm($form, $form_state);
        $form['site_information']['site_office'] = [
            '#type' => 'textfield',
            '#title' => t('Site Office'),
            '#default_value' => $site_config->get('site_office') ?: '',
            '#description' => t("Enter the Office under which this site is a resource."),
            '#required' => TRUE,
        ];
        $form['site_information']['site_office_url'] = [
            '#type' => 'textfield',
            '#title' => t('Site Office URL'),
            '#default_value' => $site_config->get('site_office_url') ?: '',
            '#description' => t("Enter the URL for the Office under which this site is a resource."),
            '#required' => TRUE,
        ];
        $form['site_information']['contact_url'] = [
            '#type' => 'textfield',
            '#title' => t('Contact Us URL'),
            '#default_value' => $site_config->get('contact_url') ?: '',
            '#description' => t("Enter the URL for the Contact Us link."),
            '#required' => TRUE,
        ];

        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $this->config('system.site')
            ->set('site_office', $form_state->getValue('site_office'))
            ->save();
        $this->config('system.site')
            ->set('site_office_url', $form_state->getValue('site_office_url'))
            ->save();
        $this->config('system.site')
            ->set('contact_url', $form_state->getValue('contact_url'))
            ->save();
        parent::submitForm($form, $form_state);
    }
}
