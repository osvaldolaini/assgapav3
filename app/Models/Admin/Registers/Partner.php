<?php

namespace App\Models\Admin\Registers;

use App\Models\Admin\Configs\PartnerCategory;
use App\Models\Admin\Financial\Bill;
use App\Models\Admin\Financial\Received;
use App\Models\Admin\Locations\Location;
use App\Models\Admin\Monthly\MonthlyPayment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Partner extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'partners';

    // protected $casts = [
    //     'validity_of_card'  => 'date:Y-m-d',
    //     'grace_period'      => 'date:Y-m-d',
    //     'registration_at'   => 'date:Y-m-d',
    //     'date_of_birth'     => 'date:Y-m-d',
    //     'access_pool'       => 'date:Y-m-d',
    //     'print_date'        => 'date:Y-m-d',
    // ];

    protected $fillable = [
        'id',
        'active',
        'slug',
        'name',
        'responsible',
        'kinship',
        'image',
        'date_of_birth',
        'deceased',
        'obs',
        'pf_pj',
        'cpf',
        'cnpj',
        'rg',
        'saram',
        'saram_novo',
        'phone_first',
        'phone_second',
        'address',
        'city',
        'district',
        'state',
        'postalCode',
        'number',
        'email',
        'email_birthday',
        'send_email_barthday',
        'needs',
        'access_pool',
        'print_date',
        'validity_of_card',
        'version_card',
        'grace_period',
        'registration_at',
        'discount',
        'partner_category',
        'partner_category_master',
        'company',
        'updated_by',
        'created_by'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = mb_strtoupper($value);
        $this->attributes['slug'] = Str::slug($value);
    }
    public function setKinshipAttribute($value)
    {
        $this->attributes['kinship'] = mb_strtoupper($value);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(PartnerCategory::class, 'partner_category', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Partner::class, 'responsible', 'id');
    }
    public function dependents(): HasMany
    {
        return $this->hasMany(Partner::class, 'responsible', 'id');
    }
    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
    public function receiveds(): HasMany
    {
        return $this->hasMany(Received::class);
    }
    public function bills()
    {
        return $this->hasMany(Bill::class, 'creditor_id', 'id');
    }

    //Mensalidades
    public function monthlys(): HasMany
    {
        return $this->hasMany(MonthlyPayment::class);
    }
    public function lateMonthly()
    {
        $late = false;
        foreach ($this->monthlys as $monthly) {
            if ($monthly->status == 0) {
                $late = true;
                break;
            }
        }
        return $late;
    }
    /*Setar a categoria master */
    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = $value;
        if ($value == 0) {
            $master = PartnerCategory::where('parent_category', 'Não sócio')->first();
            $this->attributes['partner_category'] = $master->id;
            $this->attributes['partner_category_master'] = $master->parent_category;
        }
    }
    /*Setar a e pegar datas */
    public function setPrintDateAttribute($value)
    {
        if ($value != "") {
            $this->attributes['print_date'] = implode("-", array_reverse(explode("/", $value)));
        } else {
            $this->attributes['print_date'] = NULL;
        }
    }
    public function getPrintDateAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d', $value)
                ->format('d/m/Y');
        }
    }

    public function setDateOfBirthAttribute($value)
    {
        if ($value != "") {
            $this->attributes['date_of_birth'] = implode("-", array_reverse(explode("/", $value)));
        } else {
            $this->attributes['date_of_birth'] = NULL;
        }
    }
    public function getDateOfBirthAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d', $value)
                ->format('d/m/Y');
        }
    }
    public function convertDate($value)
    {
        if ($value != "") {
            return implode("-", array_reverse(explode("/", $value)));
        }
    }
    public function getAgeAttribute()
    {
        if ($this->date_of_birth) {
            $c = strtotime(date('Y-m-d')) - strtotime($this->convertDate($this->date_of_birth));
            $age = floor($c / (60 * 60 * 24) / 365.25);
        } else {
            $age = '';
        }
        return $age;
    }
    public function setAccessPoolAttribute($value)
    {
        if ($value != "") {
            $this->attributes['access_pool'] = implode("-", array_reverse(explode("/", $value)));
        } else {
            $this->attributes['access_pool'] = NULL;
        }
    }
    public function getAccessPoolAttribute($value)
    {
        if ($value != "") {
            if ($value != "") {
                return Carbon::createFromFormat('Y-m-d', $value)
                    ->format('d/m/Y');
            }
        }
    }
    public function setValidityOfCardAttribute($value)
    {
        if ($value != "") {
            $this->attributes['validity_of_card'] = implode("-", array_reverse(explode("/", $value)));
        } else {
            $this->attributes['validity_of_card'] = NULL;
        }
    }
    public function getValidityOfCardAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d', $value)
                ->format('d/m/Y');
        }
    }
    public function setGracePeriodAttribute($value)
    {
        if ($value != "") {
            $this->attributes['grace_period'] = implode("-", array_reverse(explode("/", $value)));
        } else {
            $this->attributes['grace_period'] = NULL;
        }
    }
    public function getGracePeriodAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d', $value)
                ->format('d/m/Y');
        }
    }
    public function setRegistrationAtAttribute($value)
    {
        if ($value != "") {
            $this->attributes['registration_at'] = implode("-", array_reverse(explode("/", $value)));
        } else {
            $this->attributes['registration_at'] = NULL;
        }
    }
    public function getRegistrationAtAttribute($value)
    {
        if ($value != "") {
            return Carbon::createFromFormat('Y-m-d', $value)
                ->format('d/m/Y');
        }
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->fillable);
        // Chain fluent methods for configuration options
    }

    public function getImageTitleAttribute()
    {
        if ($this->image) {
            $img = explode('.', $this->image);
            return $img[0];
        } else {
            return null;
        }
    }
}
