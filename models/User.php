<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $isAdmin
 * @property string $photo
 *
 * @property UserCategory[] $userCategories
 * @property Category[] $category
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isAdmin'], 'integer'],
            [['isAdmin'], 'default', 'value' => 0],
            [['name', 'password', 'photo'], 'string', 'max' => 255],
            ['email', 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'isAdmin' => 'Is Admin',
            'photo' => 'Photo',
            'status' => 'Status'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserCategories()
    {
        return $this->hasMany(UserCategory::className(), ['user_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('user_category', ['user_id' => 'id']);
    }

    // IdentityInterface implementation
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    // only useful when session disabled
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    //end of implementation

    //find by email
    public static function findByEmail($email)
    {
        return static::findOne([
            'email' => $email
        ]);
    }

    /**
     * Генерирует хеш из введенного пароля и присваивает (при записи) полученное значение полю password_hash таблицы user для
     * нового пользователя.
     * Вызываеться из модели RegForm.
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    /**
     * Генерирует случайную строку из 32 шестнадцатеричных символов и присваивает (при записи) полученное значение полю auth_key
     * таблицы user для нового пользователя.
     * Вызываеться из модели RegForm.
     */
    public function generateAuthKey(){
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    /**
     * Сравнивает полученный пароль с паролем в поле password_hash, для текущего пользователя, в таблице user.
     * Вызываеться из модели LoginForm.
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function isBanned($categories)
    {
        $banlist = $this->getBannedCategory();
        if (is_array($categories)) {
            foreach ($categories as $category) {
                if (in_array($category, $banlist))
                    return true;
            }
        } else {
            if (in_array($categories, $banlist))
                return true;
        }

        return false;
    }

    /**
     * @param int[] $category Массив идентификаторов
     */
    public function banCategory($category)
    {
        if (is_array($category)) {

            UserCategory::deleteAll(['user_id' => $this->id]);

            foreach ($category as $id) {
                $this->link('category', Category::findOne($id));
            }
        }
    }

    public function getBannedCategory()
    {
        return ArrayHelper::getColumn($this->getCategory()->select('id')->asArray()->all(), 'id');
    }
}
