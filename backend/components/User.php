<?php

namespace backend\components;

use Yii;

/**
 * Extended yii\web\User
 *
 * This allows us to do "Yii::$app->user->something" by adding getters
 * like "public function getSomething()"
 *
 * So we can use variables and functions directly in `Yii::$app->user`
 */
class User extends \yii\web\User
{
    public function getUsername()
    {
        return \Yii::$app->user->identity->username;
    }

    public function getUpdatedAt()
    {
        return \Yii::$app->user->identity->updated_at;
    }

    public static function getRole($id = null)
    {
        if ($id == null) {
            $id = Yii::$app->getUser()->identity->getId();
        }
        $roleModel = Yii::$app->db
            ->createCommand("Select * from auth_assignment where user_id=" . $id)
            ->queryOne();

        return $roleModel['item_name'];
    }

    public function getRoleName($id = null)
    {
        if ($id == null) {
            $id = Yii::$app->getUser()->identity->getId();
        }
        $roleModel = Yii::$app->db
            ->createCommand("Select * from auth_assignment  INNER JOIN auth_item ON auth_item.name = auth_assignment.item_name where user_id = " . $id)
            ->queryOne();

        return $roleModel['description'];
    }
    public static function getRoleList($id = null)
    {
        if ($id == null) {
            $id = Yii::$app->getUser()->identity->getId();
        }
        $roleModel = Yii::$app->db
            ->createCommand("Select * from auth_assignment  INNER JOIN auth_item ON auth_item.type = 1 where user_id = " . $id)
            ->queryOne();

        return $roleModel['description'];
    }

    //  Получать только список авторов
    public static function getAuthors()
    {
        $courier = Yii::$app->db
            ->createCommand("Select * from user INNER JOIN auth_assignment
    ON user.id = auth_assignment.user_id and user.status = 10 where auth_assignment.item_name = 'author' ORDER BY id DESC")
            ->queryAll();
        return $courier;
    }

    public static function getUsers()
    {
        $courier = Yii::$app->db
            ->createCommand("Select * from user INNER JOIN auth_assignment
    ON user.id = auth_assignment.user_id  where auth_assignment.item_name = 'user'")
            ->queryAll();
        return $courier;
    }

    public function getGuidesByCity($city)
    {
        $city_id = $city ? $city : null;
        if ($city_id) {
            $courier = Yii::$app->db
                ->createCommand("Select * from user INNER JOIN auth_assignment
    ON user.id = auth_assignment.user_id  where auth_assignment.item_name = 'guide' and  user.city_id = ".$city_id)
                ->queryAll();
            return $courier;
        } else {
            return [];
        }

    }

    public static function getAdminsIds()
    {
        $users = \Yii::$app->authManager->getUserIdsByRole('admin');
        return $users;
    }

    public static function getAuthorsIds()
    {
        $users = \Yii::$app->authManager->getUserIdsByRole('authors');
        return $users;
    }

}
