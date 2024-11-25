<?php

namespace app\models;

use Yii;
use app\utiles\sensibleMayuscMinuscValidator;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tipo_contacto".
 *
 * @property int $id_tipo_contacto Contiene el id de clave primaria e incremental
 * @property string|null $descripcion Contiene la descripcion del id
 * @property string|null $created_at Hora y Fecha de la creacion del registro
 * @property string|null $updated_at Hora y Fecha de la modificacion del registro
 * @property int|null $id_estatus Estatus del registro clave foranea
 *
 * @property Estatus $estatus
 */
class TipoContacto extends \yii\db\ActiveRecord
{

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipo_contacto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['id_estatus'], 'default', 'value' => null],
            [['id_estatus'], 'integer'],
            [['id_estatus'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::class, 'targetAttribute' => ['id_estatus' => 'id_estatus']],
            ['descripcion', 'match', 'pattern' => '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{2,255}$/', 'message' => 'Solo se admiten letras.'],
            [['descripcion'], sensibleMayuscMinuscValidator::class, 'on' => self::SCENARIO_CREATE], 
            ['descripcion', 'match', 'pattern' => '/^\S+(?: \S+)*$/', 'message' => 'No se permiten espacios al principio o al final.'],

        ];
    }

    //Para utilizar los campos created_at y updated_at
    public function behaviors() 
    {
         return [ TimestampBehavior::class => [
             'class' => TimestampBehavior::class, 
             'attributes' => [ 
                ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'], 
                ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'], 
            ], 
            'value' => function() { return date('Y-m-d H:i:s'); }, // Formato para datetime 
            ], 
        ]; 
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_contacto' => 'Id Tipo Contacto',
            'descripcion' => 'Descripcion',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'id_estatus' => 'Estatus',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->descripcion = mb_strtoupper($this->descripcion);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Gets query for [[Estatus]].
     *
     * @return \yii\db\ActiveQuery|EstatusQuery
     */
    public function getEstatus()
    {
        return $this->hasOne(Estatus::class, ['id_estatus' => 'id_estatus']);
    }

    /**
     * {@inheritdoc}
     * @return TipocontactoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TipocontactoQuery(get_called_class());
    }
}
