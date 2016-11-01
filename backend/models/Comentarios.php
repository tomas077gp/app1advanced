<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "comentarios".
 *
 * @property integer $id
 * @property string $comentario
 * @property integer $id_usuario
 * @property integer $id_noticia
 * @property string $estado
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $idUsuario
 * @property Noticia $idNoticia
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comentario', 'id_usuario', 'id_noticia', 'created_at', 'updated_at'], 'required'],
            [['id_usuario', 'id_noticia'], 'integer'],
            [['estado'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['comentario'], 'string', 'max' => 255],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_noticia'], 'exist', 'skipOnError' => true, 'targetClass' => Noticia::className(), 'targetAttribute' => ['id_noticia' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comentario' => 'Comentario',
            'id_usuario' => 'Id Usuario',
            'id_noticia' => 'Id Noticia',
            'estado' => 'Estado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdNoticia()
    {
        return $this->hasOne(Noticia::className(), ['id' => 'id_noticia']);
    }
}
