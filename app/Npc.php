<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $tipo
 * @property string $nomen
 * @property string $senha
 * @property Quest[] $quests
 */
class Npc extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'npc';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'tipo';

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
    protected $fillable = ['nomen', 'senha'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quests()
    {
        return $this->hasMany('App\Quest', 'tipo', 'tipo');
    }
}
