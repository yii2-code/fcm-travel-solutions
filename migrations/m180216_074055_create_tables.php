<?php

use yii\db\Migration;

/**
 * Class m180216_074055_create_tables
 */
class m180216_074055_create_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $sql1 = file_get_contents(__DIR__ . '/data/cbt.sql');
        $sql2 = file_get_contents(__DIR__ . '/data/nemo_guide_etalon.sql');

        $this->execute($sql1);
        $this->execute($sql2);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180216_074055_create_tables cannot be reverted.\n";

        return false;
    }
    */
}
