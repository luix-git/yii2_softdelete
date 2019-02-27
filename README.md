# Добавление функционала "soft delete" для yii2

## Способ реализации
Добавлен абстрактный класс SoftDeleteModel, переопределяющий метод deleteInternal() класса ActiveRecord.

## Требования
- Для использования функционала модели должны наследоваться от класса SoftDeleteModel.
- Таблицы моделей унаследованных от SoftDeleteModel должны иметь столбец deleted_at с типом DATETIME.
В миграции следует использовать значение: Schema::TYPE_DATETIME.