<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property string $department_id
 * @property string $branches_branch_id
 * @property string $department_name
 * @property string $companies_company_id
 * @property string $department_status
 * @property string $created_at
 *
 * @property Companies $companiesCompany
 * @property Branches $branchesBranch
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['branches_branch_id', 'department_name', 'companies_company_id'], 'required'],
            [['branches_branch_id', 'companies_company_id'], 'integer'],
            [['department_status'], 'string'],
            [['created_at'], 'safe'],
            [['department_name'], 'string', 'max' => 100],
            [['companies_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['companies_company_id' => 'company_id']],
            [['branches_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branches_branch_id' => 'branch_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'branches_branch_id' => 'Branch Name',
            'department_name' => 'Department Name',
            'companies_company_id' => 'Company Name',
            'department_status' => 'Department Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompaniesCompany()
    {
        return $this->hasOne(Companies::className(), ['company_id' => 'companies_company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranchesBranch()
    {
        return $this->hasOne(Branches::className(), ['branch_id' => 'branches_branch_id']);
    }
}
