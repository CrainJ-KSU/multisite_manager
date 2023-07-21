<?php

namespace Drupal\multisite_sites\Entity;

use Drupal\multisite\Entity\MultisiteContentEntityBase;
use Drupal\multisite\EntityOwnerTrait;
use Drupal\multisite_sites\Event\SiteDefaultVariationEvent;

/**
 * Defines the Sites entity class.
 *
 * @ContentEntityType(
 *   id = "multisite_sites",
 *   label = @Translation("Sites"),
 *   label_collection = @Translation("Sites"),
 *   label_singular = @Translation("site"),
 *   label_plural = @Translation("sites"),
 *   label_count = @PluralTranslation(
 *     singular = "@count site",
 *     plural = "@count sites",
 *   ),
 *   bundle_label = @Translation("Site Settings"),
 *   handlers = {
 *     "event" = "Drupal\multisite_sites\Event\SiteEvent",
 *     "storage" = "Drupal\multisite\MultisiteContentEntityStorage",
 *     "access" = "Drupal\entity\EntityAccessControlHandler",
 *     "query_access" = "Drupal\entity\QueryAccess\QueryAccessHandler",
 *     "permission_provider" = "Drupal\entity\EntityPermissionProvider",
 *     "view_builder" = "Drupal\commerce_product\ProductViewBuilder",
 *     "list_builder" = "Drupal\commerce_product\ProductListBuilder",
 *     "views_data" = "Drupal\commerce\CommerceEntityViewsData",
 *     "form" = {
 *       "default" = "Drupal\commerce_product\Form\ProductForm",
 *       "add" = "Drupal\commerce_product\Form\ProductForm",
 *       "edit" = "Drupal\commerce_product\Form\ProductForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "local_task_provider" = {
 *       "default" = "Drupal\entity\Menu\DefaultEntityLocalTaskProvider",
 *     },
 *     "route_provider" = {
 *       "default" = "Drupal\entity\Routing\AdminHtmlRouteProvider",
 *       "delete-multiple" = "Drupal\entity\Routing\DeleteMultipleRouteProvider",
 *     },
 *     "translation" = "Drupal\commerce_product\ProductTranslationHandler"
 *   },
 *   admin_permission = "administer commerce_product",
 *   permission_granularity = "bundle",
 *   translatable = TRUE,
 *   base_table = "commerce_product",
 *   data_table = "commerce_product_field_data",
 *   entity_keys = {
 *     "id" = "product_id",
 *     "bundle" = "type",
 *     "label" = "title",
 *     "langcode" = "langcode",
 *     "uuid" = "uuid",
 *     "published" = "status",
 *     "owner" = "uid",
 *     "uid" = "uid",
 *   },
 *   links = {
 *     "canonical" = "/product/{commerce_product}",
 *     "add-page" = "/product/add",
 *     "add-form" = "/product/add/{commerce_product_type}",
 *     "edit-form" = "/product/{commerce_product}/edit",
 *     "delete-form" = "/product/{commerce_product}/delete",
 *     "delete-multiple-form" = "/admin/commerce/products/delete",
 *     "collection" = "/admin/commerce/products"
 *   },
 *   bundle_entity_type = "commerce_product_type",
 *   field_ui_base_route = "entity.commerce_product_type.edit_form",
 * )
 */

class Sites {

}
