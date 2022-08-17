<?php

namespace Drupal\multisite_manager\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use \Drupal\Core\Datetime\DateFormatterInterface;
use \Symfony\Component\DependencyInjection\ContainerInterface;
use \Drupal\Core\Datetime\DrupalDateTime;

class SiteViewController extends ControllerBase {

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
        $this->dateFormatter = $dateFormatter;
    }

    public static function create (ContainerInterface $container) {
        return new static (
          $container->get('database')
        );
    }

    
}