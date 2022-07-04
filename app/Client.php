<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;

/**
 * App\Client
 *
 * @property int $id
 * @property string $telegram_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $username
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $delivery
 * @property int $shop_id
 * @property string|null $session_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Cart[] $cart
 * @property-read int|null $cart_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereTelegramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUsername($value)
 * @mixin \Eloquent
 */
class Client extends Model
{
   protected $guarded = [];

   public function cart() {
        return $this->hasMany(Cart::class);
   }
}
