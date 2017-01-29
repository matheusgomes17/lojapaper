<?php

namespace Snaketec\Models\Catalog\Product\Traits\Attribute;

/**
 * Trait ProductAttribute.
 */
trait ProductAttribute
{

    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        if ($this->isActive()) {
            return "<label class='label label-success'>".trans('labels.general.active').'</label>';
        }

        return "<label class='label label-danger'>".trans('labels.general.inactive').'</label>';
    }

    /**
     * @return mixed
     */
    public function getImageAttribute()
    {
        return $this->getImage();
    }

    /**
     * @param bool $size
     *
     * @return mixed
     */
    public function getImage($size = false)
    {
        return '';
    }

    /**
     * @param $provider
     *
     * @return bool
     */
    public function hasProvider($provider)
    {
        foreach ($this->providers as $p) {
            if ($p->provider == $provider) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 1;
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.catalog.product.show', $this).'" class="btn btn-xs btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.view').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.catalog.product.edit', $this).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getStatusButtonAttribute()
    {
        switch ($this->status) {
            case 0:
                return '<a href="'.route('admin.catalog.product.mark', [
                    $this,
                    1,
                ]).'" class="btn btn-xs btn-success"><i class="fa fa-play" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.catalog.products.activate').'"></i></a> ';
            // No break

            case 1:
                return '<a href="'.route('admin.catalog.product.mark', [
                    $this,
                    0,
                ]).'" class="btn btn-xs btn-warning"><i class="fa fa-pause" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.catalog.products.deactivate').'"></i></a> ';
            // No break

            default:
                return '';
            // No break
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        return '<a href="'.route('admin.catalog.product.destroy', $this).'"
             data-method="delete"
             data-trans-button-cancel="'.trans('buttons.general.cancel').'"
             data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
             data-trans-title="'.trans('strings.backend.general.are_you_sure').'"
             class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute()
    {
        return '<a href="'.route('admin.catalog.product.restore', $this).'" name="restore_product" class="btn btn-xs btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.catalog.products.restore_product').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getDeletePermanentlyButtonAttribute()
    {
        return '<a href="'.route('admin.catalog.product.delete-permanently', $this).'" name="delete_product_perm" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.catalog.products.delete_permanently').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if ($this->trashed()) {
            return $this->getRestoreButtonAttribute().
                $this->getDeletePermanentlyButtonAttribute();
        }

        return
            $this->getShowButtonAttribute().
            $this->getEditButtonAttribute().
            $this->getStatusButtonAttribute().
            $this->getDeleteButtonAttribute();
    }
}
