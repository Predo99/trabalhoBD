<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_quest
 * @property string $tipo
 * @property int $nivel
 * @property string $informacao
 * @property Npc $npc
 * @property Perguntum[] $perguntas
 * @property Realiza[] $realizas
 */
class Quest extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'quest';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_quest';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['tipo', 'nivel', 'informacao'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function npc()
    {
        return $this->belongsTo('App\Npc', 'tipo', 'tipo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function perguntas()
    {
        return $this->hasMany('App\Perguntum', 'id_quest', 'id_quest');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function realizas()
    {
        return $this->hasMany('App\Realiza', 'id_quest', 'id_quest');
    }
}
