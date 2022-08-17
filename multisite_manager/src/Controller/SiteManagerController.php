<?php 

namespace Drupal\multisite_manager\Controller;

use \Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use \Drupal\Core\Datetime\DateFormatterInterface;
use \Symfony\Component\DependencyInjection\ContainerInterface;
use \Drupal\Core\Datetime\DrupalDateTime;
use \Drupal\Core\Link;
use \Drupal\Core\Url;

class SiteManagerController extends ControllerBase {
    
    /**
     * @var \Drupal\Core\Database\Connection
     */
    private $connection;

    /**
     * @var \Drupal\Core\Datetime\DateFormatterInterface
     */
    private $dateFormatter;

    function __construct(Connection $connection){
        $this->connection = $connection;
    }

    public static function create (ContainerInterface $container) {
        return new static (
          $container->get('database'),
          $container->get('date.formatter'),
        );
    }

    public function siteList() {
        $header = [
            $this-> t('Site Name'),
            $this-> t('Site URLs'),
            $this->t('Added'),
            $this-> t('Settings'),
        ];
        $rows = [];

        $query = $this->connection->select('drupal_site', 'ds')
            ->fields('ds')
            ->orderBy('name', 'ASC')
            ->extend('Drupal\Core\Database\Query\PagerSelectExtender')
            ->limit(10);
        $results = $query->execute();
        foreach ($results as $record) {
            
            $row = [
                $record->name,
                $this->t('@url.engg.ksu.edu', ['@url' => $record->subdomain]),
                $record->created,
                Link::fromTextAndUrl('Edit Site', Url::fromRoute('multisite_manager.site_edit', ['site_id' => $record->site_id])),
            ];
            $rows[] = $row;
        }

        return [
            'data' => [
                '#theme' => 'table',
                '#responsive' => TRUE,
                '#header' => $header,
                '#rows' => $rows,
            ],
            'pager' => [
                '#type' => 'pager',
            ],
            '#attached'=> [
                'library'=> [
                    'multisite_manager/site-list',
                ]
            ],
        ];
    }

}