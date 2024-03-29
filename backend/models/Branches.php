<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "branches".
 *
 * @property string $branch_id
 * @property string $companies_company_id
 * @property string $branch_name
 * @property string $branch_adress
 * @property string $branch_status
 * @property string $created_at
 *
 * @property Companies $companiesCompany
 * @property Departments[] $departments
 */
class Branches extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'branches';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['companies_company_id', 'branch_name', 'branch_adress'], 'required'],
            [['companies_company_id'], 'integer'],
            [['branch_status'], 'string'],
            [['created_at'], 'safe'],
            [['branch_name', 'branch_adress'], 'string', 'max' => 100],
            [['companies_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['companies_company_id' => 'company_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'branch_id' => 'Branch ID',
            'companies_company_id' => 'Companies Name',
            'branch_name' => 'Branch Name',
            'branch_adress' => 'Branch Adress',
            'branch_status' => 'Branch Status',
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
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['branches_branch_id' => 'branch_id']);
    }
}
