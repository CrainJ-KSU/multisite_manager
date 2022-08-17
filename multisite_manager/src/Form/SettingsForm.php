<?php

namespace Drupal\multisite_manager\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

class SettingsForm extends ConfigFormBase {

  protected function getEditableConfigNames() {
    return [
      'multisite_manager.api',
    ];
  }

  public function getFormID(){
    return 'multisite_manager_api_settings_form';
  }

  public function buildForm (array $form, FormStateInterface $form_state){

    $form = parent::buildForm($form, $form_state);

    $api_config = $this->config('multisite_manager.api');

    $form['username']=[
      '#type' => 'url',
      '#title' => $this->t('Database Admin Username'),
      '#required' => TRUE,
      '#default_value' => $api_config->get('dbCred'),
    ];
    $form['password'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Database Admin Password'),
      '#required' => TRUE,
      '#default_value' => $api_config->get('key'),
    ];
    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state){
    parent::submitForm($form, $form_state);
    $username = array_map('trim', explode(',',$form_state->getValue('username')));
    $api_config = $this->config('multisite_manager.api');

    $api_config->set('username', $form_state->getValue('username'))
        ->set('password', $form_state->getValue('password'))
        ->save();
  }
}
