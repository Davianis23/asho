<?php

namespace app\models;

use Yii;
use app\utiles\sensibleMayuscMinuscValidator;

/**
 * This is the model class for table "roles".
 *
 * @property int $id_roles Se archiva el id 
 * @property string|null $descripcion Se archiva el nombre 
 * @property string|null $guard_name Se guarda el nombre 
 * @property int|null $id_estatus
 * @property string|null $created_at Se archiva cuando fue creado 
 * @property string|null $updated_at Se archiva cuando fue modificado 
 *
 * @property Estatus $estatus
 * @property Usuarios[] $usuarios
 */
class Roles extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'guard_name'], 'string'],
            [['descripcion', 'guard_name'], 'required'],
            [['id_estatus'], 'default', 'value' => null],
            [['id_estatus'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['descripcion', 'guard_name'], 'unique', 'targetAttribute' => ['descripcion', 'guard_name']],
            [['id_estatus'], 'exist', 'skipOnError' => true, 'targetClass' => Estatus::class, 'targetAttribute' => ['id_estatus' => 'id_estatus']],
            ['descripcion', 'match', 'pattern' => '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{4,255}$/', 'message' => 'Solo se admiten letras.'],
            [['descripcion'], sensibleMayuscMinuscValidator::className(), 'on' => self::SCENARIO_CREATE],   
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_roles' => 'Roles',
            'descripcion' => 'Descripcion',
            'guard_name' => 'Guard Name',
            'id_estatus' => 'Estatus',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Estatus]].
     *
     * @return \yii\db\ActiveQuery|EstatusQuery
     */
    public function getEstatus()
    {
        return $this->hasOne(Estatus::class, ['id_estatus' => 'id_estatus'])->inverseOf('roles');
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery|UsuariosQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::class, ['id_roles' => 'id_roles'])->inverseOf('roles');
    }

    /**
     * {@inheritdoc}
     * @return RolesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RolesQuery(get_called_class());
    }
}
