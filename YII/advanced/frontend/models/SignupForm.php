<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $id_curso;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message' => 'Este campo é obrigatório.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este usuário já está em uso!'],
            ['username', 'string', 'min' => 2, 'max' => 255],

	    ['id_curso', 'required', 'message' => 'Este campo é obrigatório'],
	    ['id_curso', 'integer'],

            ['email', 'trim'],
            ['email', 'required','message' => 'Este campo é obrigatório.'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este e-mail já está em uso!'],

            ['password', 'required', 'message' => 'Este campo é obrigatório.'],
            ['password', 'string', 'min' => 6],

	   
        ];
    }

    public function attributeLabels()
    {
        return [
	    'username' => 'Nome de Usuário',
	    'email' => 'E-mail',
	    'id_curso' => 'Curso',
	    'password' => 'Senha',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
	$user->id_curso = $this->id_curso;
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
