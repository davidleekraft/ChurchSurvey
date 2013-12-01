<?php
/**
 * Member model
 * Linked to Members in the DB
 *
 * See model documentation at http://book.cakephp.org/2.0/en/models.html
 *
 * Associations:
 *     belongsTo Status
 *     hasMany SuveyAnswer 
 */
class Member extends AppModel {
	public $name = 'Member';
	public $useTable = 'Members';
	public $primaryKey = 'MemberID';

	public $belongsTo = array(
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'StatusID'
		)
	);

	public $hasMany = array(
		'SurveyAnswer' => array(
			'className' => 'SurveyAnswer',
			'foreignKey' => 'MemberID'
		)
	);
}