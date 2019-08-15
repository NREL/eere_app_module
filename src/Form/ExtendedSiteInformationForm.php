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

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('system.site')
      ->set('site_office', $form_state->getValue('site_office'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}