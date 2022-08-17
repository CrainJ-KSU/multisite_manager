<?php

namespace Drupal\multisite_manager\Form;

use \Drupal\Core\Form\FormBase;
use \Drupal\Core\Form\FormStateInterface;
use \Drupal\Core\Database\Connection;
use \Drupal\Core\Datetime\DateFormatterInterface;
use \Symfony\Component\DependencyInjection\ContainerInterface;
use \Drupal\Core\Datetime\DrupalDateTime;

class siteEditForm extends FormBase {

    /**
     * @var \Drupal\Core\Database\Connection
     */
    private $connection;

    /**
     * @var \Drupal\Core\Datetime\DateFormatterInterface
     */
    private $dateFormatter;

    function __construct(Connection $connection, DateFormatterInterface $dateFormatter){
        $this->connection = $connection;
        $this->dateFormatter = $dateFormatter;
    }
    
    public static function create (ContainerInterface $container){
        return new static(
            $container->get('database'),
            $container->get('date.formatter')
        );
    }

    public function getFormId() {
        // Unique ID of the form
        return 'multisite_manager_site_edit_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state, $site_id = NULL){
        $site = NULL;
        if (!empty($site_id)) {
            $site = $this->connection->select('drupal_site', 'ds')
              ->fields('ds')
              ->condition('ds.site_id', $site_id)
              ->execute()
              ->fetch();
        }

        $form['site_id'] = [
            '#type' => 'value',
            '#value' => !empty($site) ? $site_id : NULL,
        ];

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Name'),
            '#required' => TRUE,
            '#default_value' => !empty($site) ? $site->name : NULL,
        ];

        $form['site_url'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Site URL'),
            '#field_suffix' => '.engg.ksu.edu',
            '#required' => TRUE,
            '#default_value' => !empty($site) ? $site->subdomain : NULL,
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Save Site'),
        ];
        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $site = [
            'name' => $form_state->getValue('name'),
            'subdomain' => $form_state->getValue('site_url'),
            'created' => \Drupal::time()->getCurrentTime(),
        ];
        $site_id = $form_state->getValue('site_id');
        if (!empty($site_id)) {
            $site['site_id'] = $site_id;
            $this->connection->update('drupal_site')
                ->fields($site)
                ->condition('site_id', $form_state->getValue('site_id'))
                ->execute();
        } else {
            $site_id = $this->connection->insert('drupal_site')
            ->fields($site)
            ->execute();
        }

        \Drupal::messenger()->addMessage($this->t('Site saved.'));

        $form_state->setRedirect(
        'multisite_manager.site_list',
        );

    }
}