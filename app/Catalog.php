<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Catalog
 *
 * @property int $id
 * @property string $active
 * @property string $section1
 * @property string|null $vendor_code
 * @property string $name
 * @property string|null $description
 * @property string|null $weight
 * @property string|null $volume
 * @property string|null $diameter
 * @property string|null $size
 * @property string|null $color
 * @property string $price
 * @property string|null $img
 * @property string|null $url
 * @property int $shop_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereDiameter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereSection1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereVendorCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Catalog whereWeight($value)
 * @mixin \Eloquent
 */
class Catalog extends Model
{
  	protected $guarded = [];
}
