<?php namespace GlobeCode\LaravelMultiTenant;

use Illuminate\Database\Eloquent\Model;

class TenantObserver {

    /**
     * Sets the tenant id automatically when creating models
     *
     * @param Model|ScopedByTenant $model
     */
    public function creating(Model $model)
    {
        // If global scope removed from model, silently return
        if ( ! $model->hasGlobalScope(new TenantScope)) return;

        // If there is no Tenant set, silently return
        if (is_null(TenantScope::getTenantId())) return;

        // Otherwise, scope the new model
        $model->{$model->getTenantColumn()} = TenantScope::getTenantId();
    }
}
