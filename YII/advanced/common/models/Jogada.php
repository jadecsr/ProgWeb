<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jogada".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property integer $pontuacao
 * @property string $data_hora
 *
 * @property User $idUsuario
 */
class Jogada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jogada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'pontuacao'], 'required'],
            [['id_usuario', 'pontuacao'], 'integer'],
	    ['pontuacao', 'integer'],
	   // ['id_usuario', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_usuario' => 'username']],
            [['data_hora'], 'safe'],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
           // 'id' => 'Número da Jogada:',
            'id_usuario' => 'Usuário:',
            'pontuacao' => 'Pontuação:',
            'data_hora' => 'Dia da Jogada:',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario']);
    }

    public function getUsername()
    {
        return $this->hasOne(User::className(), ['nome' => 'username']);
    }
}
