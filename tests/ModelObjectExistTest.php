<?php
use PHPUnit\Framework\TestCase;

if (!class_exists('CI_Model')) {
    class CI_Model {}
}

require_once __DIR__ . '/../application/models/Model_object.php';

class ModelObjectExistTest extends TestCase
{
    private function getModelWithNumRows($num)
    {
        $query = $this->getMockBuilder(stdClass::class)
            ->addMethods(['num_rows'])
            ->getMock();
        $query->method('num_rows')->willReturn($num);

        $db = $this->getMockBuilder(stdClass::class)
            ->addMethods(['get_where'])
            ->getMock();
        $db->method('get_where')->willReturn($query);

        $ref = new ReflectionClass('model_object');
        $model = $ref->newInstanceWithoutConstructor();
        $model->db = $db;
        return $model;
    }

    public function testExistReturnsTrueWhenRecordPresent()
    {
        $model = $this->getModelWithNumRows(1);
        $this->assertTrue($model->exist('field', 'table', 'value'));
    }

    public function testExistReturnsFalseWhenRecordAbsent()
    {
        $model = $this->getModelWithNumRows(0);
        $this->assertFalse($model->exist('field', 'table', 'value'));
    }
}
