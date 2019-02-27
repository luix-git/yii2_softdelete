<?php

namespace app\models;

use \yii\db\ActiveRecord;

/**
 * Class SoftDeleteModel
 * @package app\models
 */
abstract class SoftDeleteModel extends ActiveRecord
{
    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return isset($this->deleted_at);
    }

    protected function deleteInternal()
    {
        if (!$this->beforeDelete()) {
            return false;
        }

        if ($this->isDeleted()) {
            //Здесь спорный момент: считать ли результат попытки удаления "удалённой" записи успешной.
            return false;
        }

        $this->deleted_at = (new \DateTime())->format('Y-m-d H:i:s');
        $result = $this->save();

        $this->setOldAttributes(null);
        $this->afterDelete();

        return $result;
    }

    /**
     * @return bool
     */
    public function restore(): bool
    {
        if ($this->isDeleted()) {
            $this->deleted_at = null;
            return $this->save();
        }

        return false;
    }
}
