<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $nomeu
 * @property int $gold
 * @property int $nivel
 * @property string $senha
 * @property Badge[] $badges
 * @property Realiza[] $realizas
 */
class Usuario extends Authenticatable
{
    use Notifiable;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $guard = 'usuario';

    protected $table = 'usuario';
    

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'nomeu';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['gold', 'nivel', 'senha'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function badges()
    {
        return $this->belongsToMany('App\Badge', 'ganha', 'nomeu', 'nomeb');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function realizas()
    {
        return $this->hasMany('App\Realiza', 'nomeu', 'nomeu');
    }
}
