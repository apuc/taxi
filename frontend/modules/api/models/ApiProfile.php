<?php

namespace frontend\modules\api\models;

use common\models\Profile;
use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string $avatar
 * @property int $created_at
 * @property int $updated_at
 */
class ApiProfile extends Profile
{

}
