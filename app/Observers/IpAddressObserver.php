<?php

namespace App\Observers;

use App\Models\AuditLog;
use App\Models\IpAddress;
use Illuminate\Support\Facades\Auth;

class IpAddressObserver
{
    public function created(IpAddress $model)
    {
        $this->logChange('Added IP Address', $model, ['ip_address' => $model->ip_address]);
    }

    public function updated(IpAddress $model)
    {
        $original = $model->getOriginal();
        $current = $model->getAttributes();
        $changes = array_diff_assoc($current, $original);

        $changes['ip_address'] = $current['ip_address'] ?? null;

        $changes = !empty($changes) ? $changes : ['label' => $model->label];

        $this->logChange('Updated IP Address Label', $model, $changes);
    }

    protected function logChange($event, IpAddress $model, $changes)
    {
        AuditLog::create([
            'event' => $event,
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'changes' => json_encode($changes),
            'user_id' => Auth::id(),
        ]);
    }
}
